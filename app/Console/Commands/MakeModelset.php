<?php

namespace App\Console\Commands;

use App\Base\BaseCommand;
use App\Definitions\MigrationType;
use App\Modules\Generator\Migration\IMigrationBaseGenerator;
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
     *  Migration Generator
     */
    private $migration;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IMigrationBaseGenerator $mig)
    {
        $this->migration=$mig;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->Generate();
        $project_name=$this->argument('name');

        if(!file_exists(storage_path("projects/$project_name"))){
            $this->error("Please Create Project First");
            return 1;
        }

        $model=$this->sub_artisan($project_name,"make:model Testing");
        dd($model);
        return 0;
    }

    public function Generate(){
        $configs=$this->get_configs();

        $this->migration->parse(collect($configs),"lara");

        $this->info("Success");
    }

    public function generation_migration_row($config){

    }


    public function get_configs(){
        $config=[
            "Invoices"=>[
                "columns"=>[
                    "name"=>[
                        "type"=>MigrationType::VARCHAR,
                        "length"=>50,
                        "nullable"=>true,
                        "unique"=>true
                    ],
                    "date"=>[
                        "type"=>MigrationType::DATETIME
                    ],
                    "price"=>[
                        "type"=>MigrationType::DECIMAL,
                        "nullable"=>2,
                        "unique"=>10
                    ],
                ],
                "relationship"=>[
                    "staff"=>[
                        "type"=>"one_to_one"
                    ],
                    "products"=>[
                        "type"=>"many_to_many"
                    ],
                    "invoice-details"=>[
                        "type"=>"one_to_many"
                    ]
                ],
            ]
        ];
        return $config;
    }
}
