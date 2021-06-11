<?php


namespace App\service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Security\Core\Security;

class MarkdownHelper
{
    private $cache;
    private $markdown;
    private $logger;
    private $isDebug;

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown,Security $security)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
//        $this->logger = $markdownLogger;
//        $this->isDebug = $isDebug;
    }

    public function parse(string $source): string
    {

//        if (stripos($source, 'bacon') !== false) {
//            $this->logger->info('They are talking about bacon again!');
//        }

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }

}