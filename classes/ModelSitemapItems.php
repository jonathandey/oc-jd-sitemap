<?php

namespace JD\Sitemap\Classes;

use JD\Sitemap\Classes\Contracts\AppearsOnSitemap;
use JD\Sitemap\Classes\Exceptions\ModelNotForSitemapException;

class ModelSitemapItems
{
	protected $model;

	public function __construct($modelClass)
	{
		$this->model = app($modelClass);

		if (! $this->model instanceof AppearsOnSitemap) {
			throw new ModelNotForSitemapException(
				"The model [{$modelClass}] must be an instance of \JD\Sitemap\Classes\Contracts\AppearsOnSitemap"
			);
		}
	}

	public function make()
	{
		$items = $this->model->getForSitemap()->map(function($item) {
			return $item->toSitemapArray();
		});

		return $items->toArray();
	}
}