<?php

namespace Codenetix\StubGenerator;

use Codenetix\StubGenerator\Commands\GenerateAPICrudCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Created by Andrew Sparrow <andrew.sprw@gmail.com>
 */
class StubGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateAPICrudCommand::class,
            ]);
        }
        
        $this->publishes([
            __DIR__.'/../../../config/stub_generator.php' => config_path('stub_generator.php'),
        ]);
    }
}