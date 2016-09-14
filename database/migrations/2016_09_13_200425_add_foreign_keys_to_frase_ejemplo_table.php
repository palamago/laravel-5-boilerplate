<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFraseEjemploTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('frase_ejemplo', function(Blueprint $table)
		{
			$table->foreign('grupo_id', 'frase_ejemplo_grupo')->references('grupo_id')->on('grupo')->onUpdate('SET NULL')->onDelete('SET NULL');


			$table->foreign('usuario_id','frase_ejemplo_usuario')
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
		Schema::table('frase_ejemplo', function(Blueprint $table)
		{
			$table->dropForeign('frase_ejemplo_grupo');
			$table->dropForeign('frase_ejemplo_usuario');
		});
	}

}
