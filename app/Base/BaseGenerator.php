<?php


namespace App\Base;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use PHPUnit\Util\Filesystem;

class BaseGenerator implements IBaseGenerator
{
    private $files;
    public function __construct(\Illuminate\Filesystem\Filesystem $f)
    {
        $this->files=$f;
    }

    public function parse(Collection $configs, String $project_name)
    {
        foreach ($configs as $table=>$config){
            $replacer=$this->generate_replacer($table,$config);

            $this->GenerateStub(
                $this->stub_path(),
                $this->destination_path($project_name,$table),
                $replacer->keys()->toArray(),
                $replacer->values()->toArray()
            );
        }
    }

    protected function generate_replacer($table_name, $table_config)
    {
        throw  new \Exception('Not Implement Generate Replacer');
    }

    protected function destination_path($project_name, $table_name)
    {
        throw  new \Exception('Not Implement Destination Path');
    }

    protected function stub_path()
    {
        throw  new \Exception('Not Implement Stub Path');
    }

    public function GenerateStub(string $stub_path, string $output_path, array $keys, array $values)
    {
//        if ($this->files->exists($output_path)) {
////            $this->info($output_path . " is existed , Cancel Create !");
//            return;
//        }
        $this->makeDirectory($output_path);
        $stub = $this->files->get($stub_path);

        $content = str_replace($keys, $values, $stub);
        $this->files->put($output_path, $content);
//        $this->info($output_path . " created successful");
    }

    private function makeDirectory(string $path, string $delimiter = "/")
    {
        $dirs = explode($delimiter, $path);
        array_pop($dirs);

        $dir_path = "";
        foreach ($dirs as $dir) {
            $dir_path = $dir_path . $dir . "/";
            if (!$this->files->exists($dir_path)) {
//                $this->info($dir_path . " is not exist , Creating");
                $this->files->makeDirectory($dir_path);
//                $this->info($dir_path . "  Created \n");

            }

        }
    }

    public function SubprojectPath($project_name)
    {
        return storage_path("projects/$project_name"."/");
    }

    protected function GenerateClassCase(String $class_name,String $plural=null){
        $name=Str::plural($class_name,1);
        $plural_name=$plural ?? Str::plural($class_name);
        return [
            "{class}"=>Str::lower($name),
            "{Class}"=>Str::ucfirst($name),
            "{CLASS}"=>Str::upper($name),
            "{classes}"=>Str::lower($plural_name),
            "{Classes}"=>Str::ucfirst($plural_name),
            "{CLASSES}"=>Str::upper($plural_name)
        ];
    }
}
