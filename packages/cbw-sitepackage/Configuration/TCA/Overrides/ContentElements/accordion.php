<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

defined('TYPO3') or die();

call_user_func(
    function () {

        $table = &$GLOBALS['TCA']['tt_content'];

        // cancel here, if this type is already defined
        if (isset($table['types']['accordion'])) {
            return;
        }


        $GLOBALS['TCA']['tt_content']['palettes']['headline_palette']['showitem'] = '
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                --linebreak--,
                headline,
        ';

        // add the type definition & configuration
        $table['types']['accordion'] = [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;general,
                    --palette--;;space-palette,
                    --palette--;;headers,
                    tx_inline_item,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            'columnsOverrides' => [
                'tx_inline_item' => [
                    'config' => [
                        'overrideChildTca' => [
                            'types' => [
                                'default' => [
                                    'showitem' => '
                                        tt_content,
                                        header,
                                        bodytext,
                                        --palette--;;teaserPalette,
                                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                                        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                                        --palette--;;hiddenLanguagePalette
                                    '
                                ]
                            ],
                            'columns' => [
                                'image' => [
                                    'config' => [
                                        'maxitems' => 1,
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // define the type icon
        $table['ctrl']['typeicon_classes']['accordion'] = 'ce-accordion-icon';

        // add the type as an option to the CType column
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tt_content.accordion.title',
                'value' => 'accordion',
                'icon' => 'ce-accordion-icon',
                'group' => 'default'
            ],
        );
    }
);