<?php

namespace Lairg\ViewComponents;

use Illuminate\Support\Facades\Blade;
use Lairg\ViewComponents\Livewire\DatePicker;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ViewComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-veo')
            ->hasConfigFile();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'veo');
    }

    public function packageBooted(): void
    {
        Blade::component('veo::button', 'components.button');
    }
}
