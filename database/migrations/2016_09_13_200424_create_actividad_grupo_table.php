<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActividadGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actividad_grupo', function(Blueprint $table)
		{
			$table->increments('actividad_grupo_id');
			$table->integer('grupo_id')->unsigned()->index('actividad_grupo_idx');
			$table->integer('usuario_id')->unsigned();
			$table->dateTime('fecha');
			$table->text('actividad', 65535);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('actividad_grupo');
	}

}
