<?php

use JD\Sitemap\Sitemap;

Route::get('sitemap2.xml', function() {
    return Response::make(Sitemap::generate())
        ->header("Content-Type", "application/xml")
	;
});
