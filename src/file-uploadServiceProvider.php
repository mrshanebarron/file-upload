<?php

namespace MrShaneBarron\file-upload;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\file-upload\Livewire\file-upload;
use MrShaneBarron\file-upload\View\Components\file-upload as Bladefile-upload;
use Livewire\Livewire;

class file-uploadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-file-upload.php', 'ld-file-upload');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-file-upload');

        Livewire::component('ld-file-upload', file-upload::class);

        $this->loadViewComponentsAs('ld', [
            Bladefile-upload::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-file-upload.php' => config_path('ld-file-upload.php'),
            ], 'ld-file-upload-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-file-upload'),
            ], 'ld-file-upload-views');
        }
    }
}
