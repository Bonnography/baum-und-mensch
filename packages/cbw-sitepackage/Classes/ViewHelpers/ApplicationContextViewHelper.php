<?php

namespace CodebombWebsolutions\CbwSitepackage\ViewHelpers;


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class ApplicationContextViewHelper extends AbstractViewHelper
{
    public function render() {
        return \TYPO3\CMS\Core\Core\Environment::getContext();
    }
}