<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('Access denied.');

call_user_func_array(function($extKey) {
    ExtensionManagementUtility::addStaticFile(
        $extKey,
        'Configuration/TypoScript/',
        'CBW Sitepackage'
    );
}, ['cbw_sitepackage']);
