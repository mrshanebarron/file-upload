<?php

namespace MrShaneBarron\FileUpload;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\FileUpload\Livewire\FileUpload;
use MrShaneBarron\FileUpload\View\Components\file-upload as BladeFileUpload;
use Livewire\Livewire;

class FileUploadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-file-upload.php', 'sb-file-upload');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-file-upload');

        Livewire::component('sb-file-upload', file-upload::class);

        $this->loadViewComponentsAs('ld', [
            BladeFileUpload::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-file-upload.php' => config_path('sb-file-upload.php'),
            ], 'sb-file-upload-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-file-upload'),
            ], 'sb-file-upload-views');
        }
    }
}
