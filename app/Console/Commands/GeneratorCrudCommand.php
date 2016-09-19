<?php

namespace App\Console\Commands;

use Way\Generators\Commands\GeneratorCommand;

abstract class GeneratorCrudCommand extends GeneratorCommand
{

    public $fields;
    public $fks;

    public function parseAndGetFields()
    {

        if(!\File::isDirectory($this->getGenerationPath())){
            \File::makeDirectory($this->getGenerationPath());
        }

        $this->fields = $this->argument('fields');
        $this->fks = $this->argument('foreignKeys');
        $this->pk = $this->getPKField();
        $this->fillables = $this->getFillablesFields();

        return [
            'TABLE' => $this->argument('tableName'),
            'MODEL' => ucwords($this->argument('modelName')),
            'PK' => $this->pk,
            'FILLABLES' => $this->getFillablesFieldsString()
        ];
    }

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

    public function getFillablesFieldsForm()
    {
        $html = '';

        foreach ($this->fields as $fieldName => $attrs) {
            if(!in_array($fieldName, [$this->pk,'created_at','updated_at','deleted_at'])){
                $html .= '<div class="form-group">
    {{ Form::label("'.$fieldName.'", "'.ucwords($fieldName).'", ["class" => "col-lg-2 control-label"]) }}

    <div class="col-lg-10">
        {{ Form::text("'.$fieldName.'", null, ["class" => "form-control", "placeholder" => "'.ucwords($fieldName).'" ]) }}
    </div>
</div>

';
            }
        }

        return $html;
    }

    public function getFieldsShow()
    {
        $fields = '<dl>';

        foreach ($this->fields as $fieldName => $attrs) {
            $fields .= '<dt>'.ucwords(str_replace('_', ' ', $fieldName)).'</dt><dd>{{$'.$this->argument('tableName').'->'.$fieldName.'}}</dd>';
        }
        return $fields.'</dl>';
    }

    public function getFillablesFieldsTableHeader()
    {
        $fillables = [];
        foreach ($this->fields as $fieldName => $attrs) {
            if(!in_array($fieldName, [$this->pk,'created_at','updated_at','deleted_at'])){
                $fillables[] = '<th>'.$fieldName.'</th>';
            }
        }
        return implode('', $fillables);
    }

    public function getFillablesFieldsRequired()
    {
        $str = collect($this->fillables)->reduce(function ($carry, $item) {
            return $carry . "'$item' => 'required',";
        },'');

        return rtrim($str, ',');
    }

    public function getFillablesFieldsJsonConfig()
    {
        $fillables = [];
        foreach ($this->fields as $fieldName => $attrs) {
            if(!in_array($fieldName, [$this->pk,'created_at','updated_at','deleted_at'])){
                $fillables[] = "{data: '".$fieldName."', name: '".ucwords($fieldName)."'},";
            }
        }
        return implode('', $fillables);
    }

    public function getFillablesFieldsString(){
        
        $str = collect($this->fillables)->reduce(function ($carry, $item) {
            return $carry . "'$item',";
        },'');

        return rtrim($str, ',');
    }

    protected function getGenerationPath()
    {
        return dirname($this->getFileGenerationPath());
    }

}
