<?php

namespace CodebombWebsolutions\CbwSitepackage\Configuration;

/**
 * Custom page types – make sure to add them to packages/cbw_sitepackage/Configuration/TsConfig/User/user.tsconfig
 */
enum CustomPageType: int
{
    case WEBSITE_NEWS = 116;

    public static function values(): array
    {
        return array_map(
            fn($type) => $type->value,
            self::cases()
        );
    }
}