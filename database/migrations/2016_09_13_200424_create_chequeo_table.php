<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequeoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chequeo', function(Blueprint $table)
		{
			$table->increments('chequeo_id');
			$table->string('nombre', 100);
			$table->string('slug', 100);
			$table->boolean('privado')->default(1);
			$table->text('frase', 65535)->nullable();
			$table->string('frase_quien', 100)->nullable();
			$table->string('frase_donde', 100)->nullable();
			$table->text('frase_contexto', 65535)->nullable();
			$table->integer('calificacion_id')->unsigned()->nullable()->index('chequeo_calificacion_idx');
			$table->text('calificacion_explicacion', 65535)->nullable();
			$table->text('nota_copete', 65535)->nullable();
			$table->text('nota_parrafo_1', 65535)->nullable();
			$table->text('nota_parrafo_2', 65535)->nullable();
			$table->text('nota_calificacion', 65535)->nullable();
			$table->integer('etapa_completa_id')->unsigned()->index('chequeo_etapa_idx');
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
		Schema::drop('chequeo');
	}

}
