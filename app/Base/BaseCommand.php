<?php


namespace App\Base;


use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class BaseCommand extends Command
{
    public function getStub(String $filename){
        return base_path("app/Console/stubs/$filename");
    }

    public function processCommand($command){
        $process=new Process($command);
        $process->run(function ($type,$buffer){
           $this->info($buffer);
        });
        return $process;
    }
//
    public function subproject_basedir(String $project_name){
        return storage_path('projects/'.$project_name);
    }
//
    public function sub_artisan(String $project_name,String $command){
        $temp = $this->processCommand("php ".$this->subproject_basedir($project_name).'/artisan '.$command);
        return $temp;
    }
}
