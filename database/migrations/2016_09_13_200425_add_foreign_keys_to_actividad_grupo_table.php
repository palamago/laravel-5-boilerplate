<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActividadGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('actividad_grupo', function(Blueprint $table)
		{
			$table->foreign('grupo_id', 'actividad_grupo')->references('grupo_id')->on('grupo')->onUpdate('CASCADE')->onDelete('CASCADE');

			$table->foreign('usuario_id','actividad_grupo_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('actividad_grupo', function(Blueprint $table)
		{
			$table->dropForeign('actividad_grupo');
			$table->dropForeign('actividad_grupo_usuario');
		});
	}

}
