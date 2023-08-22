<?php

namespace Log1x\BladeFileTypeIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class BladeFileTypeIconsProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-filetype-icons.php', 'blade-filetype-icons');

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-filetype-icons', []);

            $factory->add('filetype-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-filetype-icons'),
            ], 'blade-filetype-icons');

            $this->publishes([
                __DIR__.'/../config/blade-filetype-icons.php' => $this->app->configPath('blade-filetype-icons.php'),
            ], 'blade-filetype-icons-config');
        }
    }
}
