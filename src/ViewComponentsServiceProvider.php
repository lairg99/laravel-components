<?php

namespace Lairg\ViewComponents;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lairg\ViewComponents\Commands\ViewComponentsCommand;

class ViewComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-components')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-components_table')
            ->hasCommand(ViewComponentsCommand::class);
    }
}
