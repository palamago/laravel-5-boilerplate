<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGrupoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupo_usuario', function(Blueprint $table)
		{
			$table->integer('grupo_usuario_id')->unsigned()->primary();
			$table->integer('grupo_id')->unsigned()->index('grupo_usuario1_idx');
			$table->integer('usuario_id')->unsigned();
			$table->enum('rol', array('docente','alumno'))->default('alumno');
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
		Schema::drop('grupo_usuario');
	}

}
