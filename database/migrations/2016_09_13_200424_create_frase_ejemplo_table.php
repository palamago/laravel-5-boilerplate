<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFraseEjemploTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('frase_ejemplo', function(Blueprint $table)
		{
			$table->increments('frase_ejemplo_id');
			$table->integer('usuario_id')->unsigned();
			$table->integer('grupo_id')->unsigned()->nullable()->index('frase_ejemplo_grupo_idx');
			$table->string('frase', 100);
			$table->string('quien', 100)->nullable();
			$table->string('donde', 100)->nullable();
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
		Schema::drop('frase_ejemplo');
	}

}
