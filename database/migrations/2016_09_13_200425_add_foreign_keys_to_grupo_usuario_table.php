<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGrupoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grupo_usuario', function(Blueprint $table)
		{
			$table->foreign('grupo_id', 'grupo_usuario1')->references('grupo_id')->on('grupo')->onUpdate('CASCADE')->onDelete('CASCADE');

			$table->foreign('usuario_id','grupo_usuario2')
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
		Schema::table('grupo_usuario', function(Blueprint $table)
		{
			$table->dropForeign('grupo_usuario1');
			$table->dropForeign('grupo_usuario2');
		});
	}

}
