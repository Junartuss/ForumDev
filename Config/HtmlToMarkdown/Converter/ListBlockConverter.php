<?php

namespace Config\HtmlToMarkdown\Converter;

use Config\HtmlToMarkdown\ElementInterface;

class ListBlockConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return $element->getValue() . "\n";
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('ol', 'ul');
    }
}
