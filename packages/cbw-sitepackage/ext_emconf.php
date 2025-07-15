<?php

/**
 * Extension Manager/Repository config file for ext "cbw_sitepackage".
 */
$_EXTKEY = 'cbw_sitepackage';
$EM_CONF[$_EXTKEY] = [
    'title' => 'CB Template',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'CodebombWebsolutions\\CbwSitepackage\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Benjamin Bomberg',
    'author_email' => 'benjamin.bomberg@codebomb-websolutions.de',
    'author_company' => 'Codebomb Websolutions',
    'version' => '13.4.0',
];
