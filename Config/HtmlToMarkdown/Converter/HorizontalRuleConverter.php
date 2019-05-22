<?php

namespace Config\HtmlToMarkdown\Converter;

use Config\HtmlToMarkdown\ElementInterface;

class HorizontalRuleConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return "- - - - - -\n\n";
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('hr');
    }
}
