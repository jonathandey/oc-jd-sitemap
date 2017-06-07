<?php

namespace JD\Sitemap\Classes;

use DOMDocument;

class SitemapGenerator
{
	const MAX_URLS = 50000;

	protected $items = [];

	protected $urlCount = 0;

	protected $urlSet;

	protected $xmlObject;

	public function addItems(array $items)
	{
		$this->items = array_merge($this->items, $items);
	}

	public function addItemSet($set, array $items)
	{
		$this->items[$set] = $items;
	}

	public function generate()
	{
		$urlSet = $this->makeUrlSet();
		$xml = $this->makeXmlObject();

		foreach($this->items as $item) {
	        if ($item['mtime'] instanceof \DateTime) {
	            $mtime = $item['mtime']->getTimestamp();
	        }

			$url = array_get($item, 'url');
			$mtime = $mtime = $mtime ? date('c', $mtime) : date('c');
			$frequency = array_get($item, 'changefreq');
			$priority = array_get($item, 'priority');

			$urlElement = $this->makeUrlElement($xml, $url, $mtime, $frequency, $priority);
			$urlSet->appendChild($urlElement);
		}

		$xml->appendChild($urlSet);

		// dd($this->items);
		return $xml->saveXML();
	}

	/**
     * @author RainLab.Sitemap <https://github.com/rainlab/sitemap-plugin>
     */
    protected function makeXmlObject()
    {
        if ($this->xmlObject !== null) {
            return $this->xmlObject;
        }

        $xml = new DOMDocument;
        $xml->encoding = 'UTF-8';

        return $this->xmlObject = $xml;
    }

    /**
     * @author OctoberCMS <https://octobercms.com>
     */
    protected function makeUrlSet()
    {
        if ($this->urlSet !== null) {
            return $this->urlSet;
        }

        $xml = $this->makeXmlObject();
        $urlSet = $xml->createElement('urlset');
        $urlSet->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlSet->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $urlSet->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        return $this->urlSet = $urlSet;
    }

    /**
     * @author RainLab.Sitemap <https://github.com/rainlab/sitemap-plugin>
     */
    protected function addItemToSet($item, $url, $mtime = null)
    {
        if ($mtime instanceof \DateTime) {
            $mtime = $mtime->getTimestamp();
        }

        $xml = $this->makeXmlObject();
        $urlSet = $this->makeUrlSet();
        $mtime = $mtime ? date('c', $mtime) : date('c');

        $urlElement = $this->makeUrlElement(
            $xml,
            $url,
            $mtime,
            $item->changefreq,
            $item->priority
        );

        if ($urlElement) {
            $urlSet->appendChild($urlElement);
        }

        return $urlSet;
    }

    /**
     * @author RainLab.Sitemap <https://github.com/rainlab/sitemap-plugin>
     */
    protected function makeUrlElement($xml, $pageUrl, $lastModified, $frequency, $priority)
    {
        if ($this->urlCount >= self::MAX_URLS) {
            return false;
        }

        $this->urlCount++;

        $url = $xml->createElement('url');
        $url->appendChild($xml->createElement('loc', $pageUrl));
        $url->appendChild($xml->createElement('lastmod', $lastModified));
        $url->appendChild($xml->createElement('changefreq', $frequency));
        $url->appendChild($xml->createElement('priority', $priority));

        return $url;
    }
}