<?php

namespace LaravelGems\BladeEscape\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeEscapeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/blade-escape.php' => config_path('blade-escape.php'),
        ], 'config');


        Blade::directive(config('blade-escape.text'), function ($expression) {
            return "<?php echo LaravelGems\\Escape\\HTML::text($expression); ?>";
        });

        Blade::directive(config('blade-escape.attr'), function ($expression) {
            return "<?php echo LaravelGems\\Escape\\HTML::attr($expression); ?>";
        });

        Blade::directive(config('blade-escape.css'), function ($expression) {
            return "<?php echo LaravelGems\\Escape\\HTML::css($expression); ?>";
        });

        Blade::directive(config('blade-escape.js'), function ($expression) {
            return "<?php echo LaravelGems\\Escape\\HTML::js($expression); ?>";
        });

        Blade::directive(config('blade-escape.param'), function ($expression) {
            return "<?php echo LaravelGems\\Escape\\HTML::param($expression); ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/blade-escape.php', 'blade-escape'
        );
    }
}
