<?php

namespace Abdelrahmanrafaat\SchemaToCode\Provider;

use Illuminate\Support\ServiceProvider;
use Abdelrahmanrafaat\SchemaToCode\Command\SchemaToCodeConverter;

class SchemaToCodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register SchemaToCodeConverter Command.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            SchemaToCodeConverter::class,
        ]);
    }
}
