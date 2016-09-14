<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequeoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chequeo_usuario', function(Blueprint $table)
		{
			$table->increments('chequeo_usuario_id')->unsigned();
			$table->integer('chequeo_id')->unsigned()->index('chequeo_usuario_idx');
			$table->integer('usuario_id')->unsigned();
			$table->enum('rol', array('creador','co-autor'))->default('co-autor');
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
		Schema::drop('chequeo_usuario');
	}

}
