<?php


namespace App\Modules\Generator\Migration;


use App\Base\BaseGenerator;
use App\Definitions\MigrationType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SimpleMigrationGenerator extends BaseGenerator implements IMigrationBaseGenerator
{

    private CONST TEMPLATE=[
        MigrationType::VARCHAR=> '$table->string("{name}",{length})',
        MigrationType::DECIMAL=>'$table->decimal("{name}",{length},{scale})',
        MigrationType::DATETIME=>'$table->datetime("{name}")'
    ];

    private CONST DEFAULT=[
        MigrationType::DECIMAL."-length"=>10,
        MigrationType::DECIMAL."-scale"=>2

    ];

    // Must Implement Area
    protected function generate_replacer($table_name,$table_config){
        $columns=$this->process_columns(collect($table_config['columns']));
        $classCase=$this->GenerateClassCase($table_name);
        $result= array_merge([
            "{columns}"=>$columns,
        ],$classCase);

        return collect($result);
    }

    protected function stub_path(){
        return $this->migration_stub_path();
    }

    protected function destination_path($project_name,$table_name){
        return $this->SubprojectPath($project_name)."database/migrations/".Carbon::today()->format('Y_m_d_His')."_create_${table_name}_table.php";
    }

    // Private Area
    private function process_columns(Collection $table_columns){
        $lines=collect();
        foreach ($table_columns as $column=>$column_config){
            $column=$this->process_column($column,$column_config);
            $lines->add($column);
        }
        $columns_template=$lines->join(PHP_EOL);
        return $columns_template;
    }

    private function add_bracket_to_array(array $arr){
        return array_map(function ($element){
            return "{".$element."}";
        },$arr);
    }

    private function process_column($column_name,$config){
        $config['name']=$column_name;

        $temp=$this->get_column_template($config['type']);
        $temp=$temp.($config['unique'] ?? false ? '->unique()':"");
        $temp=$temp.($config['nullable'] ?? false ? '->nullable()':"");

        $this->check_required($temp,$config);

        $temp=$temp.";";
        $result=str_replace($this->add_bracket_to_array(array_keys($config)),array_values($config),$temp);

        return $result;
    }

    private function check_required($template,&$data){
        $required= preg_match_all('#\{(.*?)\}#', $template, $match);
        for($i=0;$i<sizeof($match[0]);$i++){
            $replace=$match[0][$i];
            $key=$match[1][$i];
            if($data[$key] ?? false)
                continue;
            $data[$key]=self::DEFAULT[$data['type']."-$key"] ?? "";
        }
    }

    private function get_column_template($type){
        $template = self::TEMPLATE[$type] ?? null;

        if(!$template){
            throw new \Exception('Not valid type');
        }

        return $template;
    }

    private function migration_stub_path(){
        return base_path("app/Stubs/DummyMigration.stub");
    }


}
