<?php

namespace Webkul\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\Category\Models\CategoryProxy;
use Webkul\Category\Observers\CategoryObserver;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->registerConfig();

        CategoryProxy::observe(CategoryObserver::class);
    }

    /**
     * Register configuration.
     */
    public function registerConfig(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/property_filters.php', 'property_filters');
    }
}
