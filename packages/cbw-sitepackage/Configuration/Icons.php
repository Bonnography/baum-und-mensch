<?php

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx_examples-archive-page' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cbw_sitepackage/Resources/Public/Images/news.svg',
    ],
    'apps-pagetree-news' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cbw_sitepackage/Resources/Public/images/backend/PageTypes/websiteNews.svg'
    ],
    'apps-pagetree-news-hideinmenu' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cbw_sitepackage/Resources/Public/images/backend/PageTypes/websiteNews-hideinmenu.svg'
    ],
];