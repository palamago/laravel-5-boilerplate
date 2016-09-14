<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChequeoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chequeo_usuario', function(Blueprint $table)
		{
			$table->foreign('chequeo_id', 'chequeo_usuario')->references('chequeo_id')->on('chequeo')->onUpdate('CASCADE')->onDelete('CASCADE');
			
			$table->foreign('usuario_id','chequeo_usuario_usuario')
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
		Schema::table('chequeo_usuario', function(Blueprint $table)
		{
			$table->dropForeign('chequeo_usuario');
			$table->dropForeign('chequeo_usuario_usuario');
		});
	}

}
