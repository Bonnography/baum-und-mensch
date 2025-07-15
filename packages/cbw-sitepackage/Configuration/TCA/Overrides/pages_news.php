<?php

use CodebombWebsolutions\CbwSitepackage\Configuration\CustomPageType;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(function() {

    $table = &$GLOBALS['TCA']['pages'];

    $dokType = CustomPageType::WEBSITE_NEWS->value;

    // add custom page type as possible select item:
    ExtensionManagementUtility::addTcaSelectItem(
        'pages',
        'doktype',
        [
            'label' => 'News',
            'value' => $dokType,
            'icon' => 'apps-pagetree-news',
            'group' => 'default'
        ]
    );

    // modify pages TCA
    ArrayUtility::mergeRecursiveWithOverrule(
        $table,
        [
            // add icon for new page type:
            'ctrl' => [
                'typeicon_classes' => [
                    $dokType => 'apps-pagetree-news',
                    $dokType . '-hideinmenu' => 'apps-pagetree-news-hideinmenu'
                ],
            ],
            // add all page standard fields and tabs to your new page type
            'types' => [
                $dokType => [
                    // like default, but editorial got moved to first tab
                    'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                            --palette--;;standard,
                            --palette--;;title,
                        --div--;LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.tabs.seo,
                            --palette--;;seo,
                            --palette--;;robots,
                            --palette--;;canonical,
                            --palette--;;sitemap,
                        --div--;LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.tabs.socialmedia,
                            --palette--;;opengraph,
                            --palette--;;twittercards,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.metadata,
                            --palette--;;metatags,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.appearance,
                            --palette--;;layout,
                            --palette--;;replace,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.behaviour,
                            --palette--;;links,
                            --palette--;;caching,
                            --palette--;;miscellaneous,
                            --palette--;;module,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.resources,
                            --palette--;;config,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                            --palette--;;language,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
                            --palette--;;visibility,
                            --palette--;;access,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                            categories,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                            rowDescription,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended
                    ',
                ]
            ]
        ]
    );
});
