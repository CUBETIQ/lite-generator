<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', "TestController@get");


Route::get('/simple',function (){
   config(['modules.generator.migration'=>\App\Modules\Generator\Migration\SimpleMigrationGenerator::class]) ;
    dd(config("modules.generator.migration"));
});

Route::get('/other',function (){
    config(['modules.generator.migration'=>\App\Modules\Generator\Migration\OtherMigrationClass::class]) ;
    dd(config("modules.generator.migration"));
});
