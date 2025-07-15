<?php

namespace CodebombWebsolutions\CbwSitepackage\ViewHelpers;


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class RelatedNewsViewHelper extends AbstractViewHelper
{

    public function initializeArguments(): void
    {
        $this->registerArgument('newsArray', 'array', true);
    }

    public function render() {
        $newsArray = $this->arguments['newsArray'];

        $relatedNews = [];

        foreach ($newsArray as $key => $news)
        {
            $timestamps[$key] = $news['data']['starttime'];
        }
        array_multisort($timestamps, SORT_DESC, $newsArray);

        for ($i = 2; $i < count($newsArray); $i++)
        {
            unset($newsArray[$i]);
        }

        return $newsArray;
    }
}