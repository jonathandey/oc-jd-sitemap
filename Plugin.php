<?php namespace JD\Sitemap;

use Backend;
use System\Classes\PluginBase;

/**
 * Sitemap Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Sitemap',
            'description' => 'No description provided yet...',
            'author'      => 'JD',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'JD\Sitemap\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jd.sitemap.some_permission' => [
                'tab' => 'Sitemap',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'sitemap' => [
                'label'       => 'Sitemap',
                'url'         => Backend::url('jd/sitemap/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jd.sitemap.*'],
                'order'       => 500,
            ],
        ];
    }
}
