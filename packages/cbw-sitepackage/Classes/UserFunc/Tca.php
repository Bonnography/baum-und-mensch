<?php

namespace CodebombWebsolutions\CbwSitepackage\UserFunc;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class Tca {
    public function overrideLabel(&$parameters, $parentObject)
    {
        $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']);

        switch (true) {
            case !empty($record['cta_text']):
                $newTitle = $record['cta_text'];
                break;
            default:
                $newTitle = $record['header'] ?? '';
                break;
        }
        $parameters['title'] = $newTitle;
    }
}