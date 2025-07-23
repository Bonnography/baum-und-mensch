<?php
/**
 * Created by PhpStorm.
 * User: bbom
 * Date: 20.05.2021
 * Time: 13:34
 */

$change_space = [
    'change_space_bottom' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/locallang_tca.xlf:tt_content.change_space_bottom',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [ 'Default', 100 ],
                [ 'Halbiert 50%', 50 ],
                [ 'Viertel 25%', 25 ],
                [ 'Kein Abstand', 0 ],
            ],
        ],
    ],
    'change_space_top' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:cbw_sitepackage/Resources/Private/Language/locallang_tca.xlf:tt_content.change_space_top',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [ 'Default', 100 ],
                [ 'Halbiert 50%', 50 ],
                [ 'Viertel 25%', 25 ],
                [ 'Kein Abstand', 0 ],
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $change_space);

$GLOBALS['TCA']['tt_content']['palettes']['space-palette']['showitem'] = '
    change_space_top,change_space_bottom,
';