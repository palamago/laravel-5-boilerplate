<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupo', function(Blueprint $table)
		{
			$table->increments('grupo_id');
			$table->string('nombre', 100);
			$table->string('descripcion', 100);
			$table->date('fecha_inicio');
			$table->date('fecha_fin')->nullable();
			$table->integer('etapa_maxima')->unsigned()->index('etapa_maxima_grupo_idx');
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
		Schema::drop('grupo');
	}

}
