<?php


namespace App\Base;


use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface IBaseGenerator
{
    public function GenerateStub(string $stub_path,string $output_path,array $keys,array $values);

    public function parse(Collection $configs,String $project_name);


}
