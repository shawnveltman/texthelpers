<?php

namespace Shawnveltman\Texthelpers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Shawnveltman\Texthelpers\Commands\TexthelpersCommand;

class TexthelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('texthelpers')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_texthelpers_table')
            ->hasCommand(TexthelpersCommand::class);
    }
}
