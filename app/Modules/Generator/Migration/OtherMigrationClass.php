<?php


namespace App\Modules\Generator\Migration;


use App\Base\BaseGenerator;
use App\Definitions\MigrationType;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class OtherMigrationClass extends BaseGenerator implements IMigrationBaseGenerator
{
   public function parse(Collection $configs, String $project_name)
   {
       // TODO: Implement parse() method.
   }
}
