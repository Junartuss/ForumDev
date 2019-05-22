<?php

namespace Config\HtmlToMarkdown\HTMLToMarkdown;

interface ConfigurationAwareInterface
{
    /**
     * @param Configuration $config
     */
    public function setConfig(Configuration $config);
}
