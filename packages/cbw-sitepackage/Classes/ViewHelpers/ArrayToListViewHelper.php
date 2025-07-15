<?php

namespace CodebombWebsolutions\CbwSitepackage\ViewHelpers;


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class ArrayToListViewHelper extends AbstractViewHelper
{

    public function initializeArguments(): void
    {
        $this->registerArgument('array', 'array', true);
    }

    public function render() {
        $newArr = [];
        $array = $this->arguments['array'];

        foreach ($array as $arr)
        {
            $newArr[] = $arr->getTitle();
        }
        return (implode(',', $newArr));
    }
}