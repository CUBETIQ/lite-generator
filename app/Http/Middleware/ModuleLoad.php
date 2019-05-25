<?php

namespace App\Http\Middleware;

use App\Modules\Generator\Migration\OtherMigrationClass;
use App\Modules\Generator\Migration\SimpleMigrationGenerator;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModuleLoad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        config(["modules.generator.migration"=>]);
//        dd(config("modules.generator.migration"));
        return $next($request);
    }
}
