<?php

namespace App\Providers;

use App\Modules\Generator\Migration\IMigrationBaseGenerator;
use App\Modules\Generator\Migration\OtherMigrationClass;
use App\Modules\Generator\Migration\SimpleMigrationGenerator;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use PhpOption\Tests\Repository;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(IMigrationBaseGenerator::class,config('modules.generator.migration'));
//        $this->app->singleton(IMigrationGenerator::class,function (Container $app){
//            $class=config('modules.generator.migration');
//            return new $class;
//        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }
}
