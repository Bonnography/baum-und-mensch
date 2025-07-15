<?php
/**
 * Created by PhpStorm.
 * User: BenjaminBomberg
 * Date: 10.03.2020
 * Time: 10:59
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// include misc
//include_once('path-to-file.php');
include_once('misc/remove_bottom_space.php');
include_once('misc/button_style.php');

// include ContentElements
//include_once('path-to-file.php');
include_once('ContentElements/headerImage.php');
include_once('ContentElements/news.php');
include_once('ContentElements/headline.php');
include_once('ContentElements/image.php');
include_once('ContentElements/text.php');
include_once('ContentElements/inlineElements.php');

$GLOBALS['TCA']['tt_content']['ctrl']['label_alt'] = 'headline, bodytext';

call_user_func(
    function () {
        $table = &$GLOBALS['TCA']['tt_content'];

        ExtensionManagementUtility::addTCAcolumns('tt_content', [
            'tx_inline_item' => [
                'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/backend.xlf:tx_inline_item.label',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_inline_item',
                    'foreign_field' => 'tt_content',
                    'appearance' => [
                        'useSortable' => true,
                        'showSynchronizationLink' => true,
                        'showAllLocalizationLink' => true,
                        'showPossibleLocalizationRecords' => true,
                        'expandSingle' => true,
                        'enabledControls' => [
                            'localize' => true,
                        ]
                    ]
                ]
            ],
        ]);
    }
);
