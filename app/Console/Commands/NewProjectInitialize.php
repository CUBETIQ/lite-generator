<?php

namespace App\Console\Commands;

use App\Base\BaseCommand;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class NewProjectInitialize extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cubetiq:new {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Laravel Project';

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
        $project_name = $this->argument('name');

        // Check Path Exist
        if(!file_exists(storage_path('projects'))){
            $storage_projects = new Process("mkdir storage/projects");
            $storage_projects->run();
        }

        // Check If Project is Exist
        if(file_exists(storage_path("projects/$project_name"))){
            $this->error("Project Exist");
            return 1;
        }

        $process=$this->processCommand("cd storage/projects && composer create-project --no-install --no-scripts --prefer-dist laravel/laravel $project_name");

        return 0;
    }
//
//    /**
//     * No using , Use Symfony/Process instead
//     *
//     * Method to execute a command in the terminal
//     * Uses :
//     *
//     * 1. system
//     * 2. passthru
//     * 3. exec
//     * 4. shell_exec
//     */
//    function terminal($command)
//    {
//        //system
//        if (function_exists('system')) {
//            ob_start();
//            system($command, $return_var);
//            $output = ob_get_contents();
//            ob_end_clean();
//        } //passthru
//        else if (function_exists('passthru')) {
//            ob_start();
//            passthru($command, $return_var);
//            $output = ob_get_contents();
//            ob_end_clean();
//        } //exec
//        else if (function_exists('exec')) {
//            exec($command, $output, $return_var);
//            $output = implode("n", $output);
//        } //shell_exec
//        else if (function_exists('shell_exec')) {
//            $output = shell_exec($command);
//        } else {
//            $output = 'Command execution not possible on this system';
//            $return_var = 1;
//        }
//
//        return array('output' => $output, 'status' => $return_var);
//    }
}
