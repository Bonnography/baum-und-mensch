<?php

$tt_content_textmedia_settings = [
    'col_size' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/locallang_tca.xlf:tt_content.col_size',
        'displayCond' => [
            'OR' => [
                'FIELD:imageorient:=:25',
                'FIELD:imageorient:=:26',
            ],
        ],
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Default 50 / 50', '0'],
                ['33 / 66', '1'],
                ['66 / 33', '2'],
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tt_content_textmedia_settings);


$GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
    '--palette--;;headers,',
    '--palette--;;headers,--palette--;;space-palette,bodytext,',
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
);

$GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
    '--palette--;;gallerySettings,',
    '--palette--;;gallerySettings,col_size,',
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
);

$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['imageorient']['onChange'] = 'reload';
