<?php

namespace CodebombWebsolutions\CbwSitepackage\ViewHelpers;


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ArrayUniqueViewHelper extends AbstractViewHelper
{

    public function initializeArguments(): void
    {
        $this->registerArgument('array', 'array', true);
        $this->registerArgument('field', 'string', true);
    }

    public function render()
    {
        $newArr = [];
        $array = $this->arguments['array'];
        $field = $this->arguments['field'];

        foreach ($array as $arr) {
            switch ($field) {
                case 'date':
                    $newArr[] = date('Y', strtotime($arr->getDate()));
                    break;
                case 'categories':
                    foreach ($arr->getCategories() as $category) {
                        $newArr[] = $category->getTitle();
                    }
                    break;
            }

        }
        return array_unique($newArr);
    }
}