<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func_array(function($extKey) {
    $table = &$GLOBALS['TCA']['pages'];

    /**
     * Register PageTSConfig
     */
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extKey,
        'Configuration/TSconfig/Page/BaseConfig.tsconfig',
        'Website configuration');
}, ['cbw_sitepackage'] );



// Configure new fields:
$fields = [
    'newsTeaser' => [
        'exclude' => 1,
        'label' => 'News Teaser',
        'config' => [
            'type' => 'text',
            'rows' => 3,
            'cols' => 30,
            'enableRichtext' => true,
            'richtextConfiguration' => 'teaser'
        ],
    ],
];

// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $fields);
