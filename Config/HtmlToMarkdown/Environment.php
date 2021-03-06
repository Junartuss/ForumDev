<?php

namespace Config\HtmlToMarkdown\HTMLToMarkdown;

use Config\HtmlToMarkdown\Converter\BlockquoteConverter;
use Config\HtmlToMarkdown\Converter\CodeConverter;
use Config\HtmlToMarkdown\Converter\CommentConverter;
use Config\HtmlToMarkdown\Converter\ConverterInterface;
use Config\HtmlToMarkdown\Converter\DefaultConverter;
use Config\HtmlToMarkdown\Converter\DivConverter;
use Config\HtmlToMarkdown\Converter\EmphasisConverter;
use Config\HtmlToMarkdown\Converter\HardBreakConverter;
use Config\HtmlToMarkdown\Converter\HeaderConverter;
use Config\HtmlToMarkdown\Converter\HorizontalRuleConverter;
use Config\HtmlToMarkdown\Converter\ImageConverter;
use Config\HtmlToMarkdown\Converter\LinkConverter;
use Config\HtmlToMarkdown\Converter\ListBlockConverter;
use Config\HtmlToMarkdown\Converter\ListItemConverter;
use Config\HtmlToMarkdown\Converter\ParagraphConverter;
use Config\HtmlToMarkdown\Converter\PreformattedConverter;
use Config\HtmlToMarkdown\Converter\TextConverter;

final class Environment
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var ConverterInterface[]
     */
    protected $converters = array();

    public function __construct(array $config = array())
    {
        $this->config = new Configuration($config);
        $this->addConverter(new DefaultConverter());
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConverterInterface $converter
     */
    public function addConverter(ConverterInterface $converter)
    {
        if ($converter instanceof ConfigurationAwareInterface) {
            $converter->setConfig($this->config);
        }

        foreach ($converter->getSupportedTags() as $tag) {
            $this->converters[$tag] = $converter;
        }
    }

    /**
     * @param string $tag
     *
     * @return ConverterInterface
     */
    public function getConverterByTag($tag)
    {
        if (isset($this->converters[$tag])) {
            return $this->converters[$tag];
        }

        return $this->converters[DefaultConverter::DEFAULT_CONVERTER];
    }

    /**
     * @param array $config
     *
     * @return Environment
     */
    public static function createDefaultEnvironment(array $config = array())
    {
        $environment = new static($config);

        $environment->addConverter(new BlockquoteConverter());
        $environment->addConverter(new CodeConverter());
        $environment->addConverter(new CommentConverter());
        $environment->addConverter(new DivConverter());
        $environment->addConverter(new EmphasisConverter());
        $environment->addConverter(new HardBreakConverter());
        $environment->addConverter(new HeaderConverter());
        $environment->addConverter(new HorizontalRuleConverter());
        $environment->addConverter(new ImageConverter());
        $environment->addConverter(new LinkConverter());
        $environment->addConverter(new ListBlockConverter());
        $environment->addConverter(new ListItemConverter());
        $environment->addConverter(new ParagraphConverter());
        $environment->addConverter(new PreformattedConverter());
        $environment->addConverter(new TextConverter());

        return $environment;
    }
}
