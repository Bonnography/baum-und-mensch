<?php

return [
    'ctrl' => [
        'label' => 'header',
        'label_alt' => 'subheader',
        'label_userFunc' => 'CodebombWebsolutions\CbwSitepackage\UserFunc\Tca->overrideLabel',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.label',
        'type' => 'item_type',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource' => 'l10n_source',
        'hideTable' => false,
        'hideAtCopy' => false,
        'prependAtCopy' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_column' => 'item_type',
        'typeicon_classes' => [
            'default' => 'content-beside-text-img-above-center'
        ],
        'security' => [
            'ignorePageTypeRestriction' => true
        ]
    ],
    'interface' => [
    ],
    'types' => [
        '1' => [
            'showitem' => 'item_type'
        ],
        'default' => [
            'showitem' => '
                --palette--;;general,
                --palette--;;header,
                bodytext,
                image,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePaletteteaserPalette
            '
        ]
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ],
        'access' => [
            'showitem' => '
                hidden,
                starttime,
                endtime,
            '
        ],
        'general' => [
            'showitem' => '
                tt_content,
                item_type,
                size,
            '
        ],
        'header' => [
            'showitem' => '
                header,
                --linebreak--,
                header_layout,
                --linebreak--,
                subheader,
                --linebreak--,
                header_link,
            '
        ],
        'hiddenLanguagePalette' => [
            'showitem' => 'sys_language_uid, l18n_parent',
            'isHiddenPalette' => true,
        ],
        'teaserPalette' => [
          'showitem' => '
          image,image_position,
          --linebreak--,
          cta, cta_text,'
        ],
    ],
    'columns' => [
        'tt_content' => [
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.tt_content',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID###',
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'item_type' => [
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.item_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.item_type.default',
                        'default',
                        'content-beside-text-img-above-center'
                    ]
                ],
                'default' => 'default'
            ]
        ],
        'size' => [
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.size',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [ '25%', '3' ],
                    [ '33%', '4' ],
                    [ '50%', '6' ],
                    [ '66%', '8' ],
                    [ '75%', '9' ]
                ],
                'default' => '4'
            ]
        ],
        'header' => [
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
            ],
        ],
        'subheader' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.subheader',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
            ],
        ],
        'header_layout' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [ 'H1', '1' ],
                    [ 'H2', '2' ],
                    [ 'H3', '3' ],
                    [ 'H4', '4' ],
                ],
                'default' => '2'
            ]
        ],
        'header_link' => [
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.header_link.label',
            'description' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.header_link.description',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 50,
                'max' => 1024,
                'eval' => 'trim',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        ],
                    ],
                ],
                'softref' => 'typolink',
            ]
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'image' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.images',
            'config' =>
            [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                    'showPossibleLocalizationRecords' => true,
                ],
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ]
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0,
                    ],
                ],
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND {#tt_content}.{#pid}=###CURRENT_PID### AND {#tt_content}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'cta' => [
            'exclude' => 1,
            'label' => 'CTA',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
            ],
        ],
        'cta_text' => [
            'exclude' => 1,
            'label' => 'CTA Text',
            'config' => [
                'type' => 'input',
                'max' => 256,
            ],
        ],
        'remove_cta_button' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.remove_cta_button',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        0 => 'Ja',
                        1 => 'Ja',
                    ]
                ],
            ],
        ],
        'image_position' => [
            'exclude' => 1,
            'label' => 'Bildposition',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'eval' => 'required',
                'items' => [
                    ['Top', 0],
                    ['Bottom', 1],
                ],
            ],
        ],
    ],
];