<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensajeGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensaje_grupo', function(Blueprint $table)
		{
			$table->increments('mensaje_grupo_id');
			$table->integer('mensaje_grupo_padre_id')->unsigned()->nullable()->index('muro_padre_idx');
			$table->integer('grupo_id')->unsigned()->index('actividad_grupo_idx');
			$table->integer('usuario_id')->unsigned();
			$table->dateTime('fecha');
			$table->text('texto', 65535);
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
		Schema::drop('mensaje_grupo');
	}

}
