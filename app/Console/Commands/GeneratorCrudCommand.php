<?php

namespace App\Console\Commands;

use Way\Generators\Commands\GeneratorCommand;

abstract class GeneratorCrudCommand extends GeneratorCommand
{

    public $fields;
    public $fks;

    public function getPKField()
    {
        foreach ($this->fields as $fieldName => $attrs) {
            if($attrs['type']=='increments'){
                return $fieldName;
            }
        }
    }

    public function getFillablesFields()
    {
        $fillables = [];
        foreach ($this->fields as $fieldName => $attrs) {
            if(!in_array($fieldName, [$this->pk,'created_at','updated_at','deleted_at'])){
                $fillables[] = $fieldName;
            }
        }
        return $fillables;
    }

    public function getFillablesFieldsString(){
        
        $str = collect($this->fillables)->reduce(function ($carry, $item) {
            return $carry . "'$item',";
        },'');

        return rtrim($str, ',');
    }

}
