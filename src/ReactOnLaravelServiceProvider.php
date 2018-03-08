<?php

namespace TektonLabs\ReactOnLaravel;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Console\PresetCommand;
use TektonLabs\ReactOnLaravel\Renderer\ReactRenderExtension;
use TektonLabs\ReactOnLaravel\Renderer\ReactRenderer;
use TektonLabs\ReactOnLaravel\Renderer\ContextProvider;
use TektonLabs\ReactOnLaravel\Preset\ReactOnLaravelPreset;

class ReactOnLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->registerPreset();
        $this->bindReactRenderer();
        $this->registerBladeExtension();
    }

    public function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/react_on_laravel.php' => config_path('react_on_laravel.php'),
        ]);
    }

    public function registerPreset()
    {
        PresetCommand::macro('react-on-laravel', function ($command) {
            ReactOnLaravelPreset::install();
            $command->info('TektonLabs React scaffolding installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }

    public function bindReactRenderer()
    {
        $contextProvider = new ContextProvider(request());
        $renderer = new ReactRenderer($contextProvider);

        $this->app->bind('reactRenderer', function () use ($contextProvider, $renderer){
            return new ReactRenderExtension($renderer, $contextProvider, config('react_on_laravel.default_rendering', 'both'));
        });
    }

    public function registerBladeExtension()
    {
        Blade::directive('reactComponent', function ($expression) {
            return "app('reactRenderer')->reactRenderComponent({$expression})";
        });
    }
}
