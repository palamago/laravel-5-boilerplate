<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequeoFuenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chequeo_fuente', function(Blueprint $table)
		{
			$table->integer('chequeo_fuente_id', true);
			$table->integer('chequeo_id')->unsigned()->index('chequeo_fuente_idx');
			$table->string('fuente', 100);
			$table->string('referencia', 200);
			$table->enum('tipo', array('original','oficial','alternativa'));
			$table->boolean('exito')->default(1);
			$table->string('archivo', 45)->nullable();
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
		Schema::drop('chequeo_fuente');
	}

}
