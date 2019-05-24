<?php

namespace App\Console\Commands;

use App\Base\BaseCommand;
use Illuminate\Console\Command;

class MakeModelset extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cubetiq:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $project_name=$this->argument('name');

        if(!file_exists(storage_path("projects/$project_name"))){
            $this->error("Please Create Project First");
            return 1;
        }



//        $this->sub_artisan($project_name,"make:model",["name"=>"TestignPr"]);

    }
}
