<?php

namespace JD\Sitemap\Classes\Contracts;

interface AppearsOnSitemap
{
	/**
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getForSitemap();

	/**
	 * ['url' , 'mtime', 'changefreq', 'priority']
	 * @return array
	 */
	public function toSitemapArray();
}