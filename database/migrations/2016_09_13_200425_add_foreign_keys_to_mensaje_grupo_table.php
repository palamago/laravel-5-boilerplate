<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMensajeGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mensaje_grupo', function(Blueprint $table)
		{
			$table->foreign('grupo_id', 'mensaje_grupo')->references('grupo_id')->on('grupo')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('mensaje_grupo_padre_id', 'mensaje_padre')->references('mensaje_grupo_id')->on('mensaje_grupo')->onUpdate('SET NULL')->onDelete('SET NULL');

			$table->foreign('usuario_id','mensaje_usuario')
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
		Schema::table('mensaje_grupo', function(Blueprint $table)
		{
			$table->dropForeign('mensaje_grupo');
			$table->dropForeign('mensaje_padre');
			$table->dropForeign('mensaje_usuario');
		});
	}

}
