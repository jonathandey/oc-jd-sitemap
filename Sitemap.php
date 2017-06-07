<?php

namespace JD\Sitemap;

use JD\Sitemap\Classes\SitemapGenerator;
use JD\Sitemap\Classes\ModelSitemapItems;

class Sitemap
{
	protected static $generator;

	public static function getGenerator()
	{
		if (is_null(self::$generator)) {
			self::$generator = new SitemapGenerator;
		}

		return self::$generator;
	}

	public static function addModel($modelClass)
	{
		$items = (new ModelSitemapItems($modelClass))->make();

		self::getGenerator()->addItems($items);
	}

	public static function addModels(array $modelClasses)
	{
		foreach($modelClasses as $modelClass) {
			self::addModel($modelClass);
		}
	}

	public static function generate()
	{
		return self::getGenerator()->generate();
	}
}