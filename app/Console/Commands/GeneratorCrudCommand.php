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

        $this->fks = array();
        foreach ($this->argument('foreignKeys') as $key => $fk) {
            $this->fks[$fk['field']] = $fk;
        }

        $this->pk = $this->getPKField();
        $this->label = array_keys($this->fields)[1];
        $this->fillables = $this->getFillablesFields();

        return [
            'TABLE' => $this->argument('tableName'),
            'MODEL' => ucwords($this->argument('modelName')),
            'PK' => $this->pk,
            'LABEL' => $this->label,
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
    {{ Form::label("'.$fieldName.'", "'.$this->toTitle($fieldName).'", ["class" => "col-lg-2 control-label"]) }}

    <div class="col-lg-10">';

    if(isset($this->fks[$fieldName])){
        $fk = $this->fks[$fieldName];
        $html .= '{{ Form::select("'.$fieldName.'", $'.$fk['on'].', null, ["class" => "form-control", "placeholder" => " -- '.$this->toTitle($fk['on']).' -- " ]) }}';
    } else {
        var_dump($attrs);
        if($attrs['type']=='text'){

            $html .='{{ Form::textarea("'.$fieldName.'", null, ["class" => "form-control", "placeholder" => "'.$this->toTitle($fieldName).'" ]) }}';
        } else {

            $html .='{{ Form::text("'.$fieldName.'", null, ["class" => "form-control", "placeholder" => "'.$this->toTitle($fieldName).'" ]) }}';
        }

        
    }

    $html .='</div>
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
            $fieldValue = (in_array($fieldName, array('created_at','updated_at')))?$fieldName . '->toDateTimeString()':$fieldName;

            $fields .= '<dt>'.$this->toTitle($fieldName).'</dt><dd>{{$'.$this->argument('tableName').'->'.$fieldValue.'}}</dd>';
        }
        return $fields.'</dl>';
    }

    public function getFillablesFieldsTableHeader()
    {
        $fillables = [];
        foreach ($this->fields as $fieldName => $attrs) {
            if(!in_array($fieldName, [$this->pk,'created_at','updated_at','deleted_at'])){
                $fillables[] = '<th>'.$this->toTitle($fieldName).'</th>';
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
                $fillables[] = "{data: '".$fieldName."', name: '".$fieldName."'},";
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

    public function fksRelations() {
        $relations = '';

        foreach ($this->fks as $key => $value) {
            $relations .="
    public function ".$value['on']."()
    {
        return \$this->hasOne('App\Models\\".ucwords($value['on'])."','".$value['references']."','".$value['field']."');
    }
    ";
        }

        return $relations;

    }

    protected function getGenerationPath()
    {
        return dirname($this->getFileGenerationPath());
    }

    public function toTitle($name){
        return ucwords( str_replace('_', ' ', $name) );
    }
}
