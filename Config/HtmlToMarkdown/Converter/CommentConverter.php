<?php

namespace Config\HtmlToMarkdown\Converter;

use Config\HtmlToMarkdown\ElementInterface;

class CommentConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return '';
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('#comment');
    }
}
