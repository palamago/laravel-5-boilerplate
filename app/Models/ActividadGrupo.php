<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadGrupo extends Model {

	protected $fillable = ['grupo_id','usuario_id','fecha','actividad'];
	
	protected $table = 'actividad_grupo';

	protected $primaryKey = 'actividad_grupo_id';

}
