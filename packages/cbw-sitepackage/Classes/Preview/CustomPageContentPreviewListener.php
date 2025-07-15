<?php
declare(strict_types=1);

namespace CodebombWebsolutions\CbwSitepackage\Preview;

use Exception;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Backend\View\PageLayoutContext;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Database\RelationHandler;
use TYPO3\CMS\Core\Domain\RecordFactory;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;

/**
 * With TYPO3 13 they moved the fluid rendering for content element previews from StandardContentPreviewRenderer to
 * FluidBasedContentPreviewRenderer – the latter one being registered as a listener for the PageContentPreviewRenderingEvent.
 * Since the new class is marked as final, this class basically implements the same logic plus additional processing
 * for inline relations (images, media, assets and teaser elements)
 *
 * @see \TYPO3\CMS\Backend\Preview\FluidBasedContentPreviewRenderer
 * @noinspection PhpUnused
 */
#[AsEventListener(identifier: 'cbw_sitepackage/custom-preview-content')]
final readonly class CustomPageContentPreviewListener
{
    private array $referenceFieldNames;

    private array $inlineRelationNames;

    public function __construct(
        private FlexFormService $flexFormService,
        private RecordFactory $recordFactory,
        private LoggerInterface $logger,
        private ViewFactoryInterface $viewFactory,
    )
    {
        $this->referenceFieldNames = [
            'image',
            'media',
            'assets'
        ];
        $this->inlineRelationNames = [
            'tx_inline_item'
        ];
    }

    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        if ($event->getTable() !== 'tt_content') {
            return;
        }
        $previewContent = $this->renderContentElementPreviewFromFluidTemplate(
            $event->getRecord(),
            $event->getTable(),
            $event->getRecordType(),
            $event->getPageLayoutContext()
        );
        if ($previewContent !== null) {
            $event->setPreviewContent($previewContent);
        }
    }

    private function getFluidTemplateFile(
        array $row,
        string $table,
        string $recordType,
    ): string
    {
        $tsConfig = BackendUtility::getPagesTSconfig($row['pid'])['mod.']['web_layout.'][$table . '.']['preview.'] ?? [];
        if (
            $table === 'tt_content'
            && $recordType === 'list'
            && !empty($row['list_type'])
            && !empty($tsConfig['list.'][$row['list_type']])
        ) {
            return $tsConfig['list.'][$row['list_type']];
        } elseif (!empty($tsConfig[$recordType])) {
            return $tsConfig[$recordType];
        }
        return '';
    }

    private function renderContentElementPreviewFromFluidTemplate(
        array $row,
        string $table,
        string $recordType,
        PageLayoutContext $context): ?string
    {
        $fluidTemplateFile = $this->getFluidTemplateFile($row, $table, $recordType);
        if ($fluidTemplateFile === '') {
            return null;
        }

        $fluidTemplateFileAbsolutePath = GeneralUtility::getFileAbsFileName($fluidTemplateFile);
        if ($fluidTemplateFileAbsolutePath === '') {
            return null;
        }

        try {
            $viewFactoryData = new ViewFactoryData(
                templatePathAndFilename: $fluidTemplateFileAbsolutePath,
                request: $context->getCurrentRequest(),
            );

            foreach ($this->referenceFieldNames as $fieldName) {
                $row[$fieldName] = $this->resolveFileReferences($row, $table, $fieldName);
            }

            foreach ($this->inlineRelationNames as $inlineRelationName) {
                $row[$inlineRelationName] = $this->resolveInlineRelations($row, $inlineRelationName, $table);
            }

            if (!empty($row['pages'])) {
                $row['pages'] = $this->resolvePageReferences($row['pages']);
            }

            $view = $this->viewFactory->create($viewFactoryData);
            $view->assignMultiple($row);
            if ($table === 'tt_content' && !empty($row['pi_flexform'])) {
                $view->assign('pi_flexform_transformed', $this->flexFormService->convertFlexFormContentToArray($row['pi_flexform']));
            }
            $view->assign('record', $this->recordFactory->createResolvedRecordFromDatabaseRow($table, $row, null, $context->getRecordIdentityMap()));
            return $view->render();
        } catch (Exception $e) {
            $this->logger->warning('The backend preview for content element {uid} can not be rendered using the Fluid template file "{file}"', [
                'uid' => $row['uid'],
                'file' => $fluidTemplateFileAbsolutePath,
                'exception' => $e,
            ]);
            return null;
        }
    }

    private function resolveFileReferences(array $row, string $table, string $fieldName): array
    {
        if ($row[$fieldName] > 0) {
            $files = BackendUtility::resolveFileReferences(
                $table,
                $fieldName,
                $row
            );
            return array_values($files ?: []);
        }
        return [];
    }

    private function resolvePageReferences(string $pidList): array
    {
        return array_map(function(int $pid) {
            return BackendUtility::getRecord('pages', $pid);
        }, GeneralUtility::intExplode(',', $pidList, true));
    }

    private function resolveInlineRelations(
        array $row,
        string $relationName,
        string $sourceTable
    ): array
    {
        if ($row[$relationName] > 0) {
            $relationHandler = GeneralUtility::makeInstance(RelationHandler::class);
            $relationHandler->start(
                $row[$relationName],
                $relationName,
                '',
                $row['uid'],
                $sourceTable,
                $GLOBALS['TCA']['tt_content']['columns'][$relationName]['config']
            );
            $relationHandler->processDeletePlaceholder();
            $results = $relationHandler->getFromDB()[$relationName] ?? [];

            return array_map(function(array $result) use ($relationName) {
                if (!empty($result['image'])) {
                    $result['image'] = $this->resolveFileReferences($result, $relationName, 'image');
                }
                return $result;
            }, $results);
        }
        return [];
    }
}