<?php

namespace App\Http\Controllers;

use App\Modules\Generator\Migration\IMigrationBaseGenerator;
use App\Modules\Generator\Migration\OtherMigrationClass;
use App\Modules\Generator\Migration\SimpleMigrationGenerator;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $migration;
    //
    public function __construct(IMigrationBaseGenerator $mig)
    {
        $this->migration=$mig;
    }


    public function get(){
        dd(config('modules.generator.migration'));
        config(['modules.generator.migration'=>SimpleMigrationGenerator::class]);
        return $this->migration->parse();
    }
}
