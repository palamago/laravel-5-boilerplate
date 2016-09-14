<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChequeoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chequeo', function(Blueprint $table)
		{
			$table->foreign('calificacion_id', 'chequeo_calificacion')->references('calificacion_id')->on('calificacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('etapa_completa_id', 'chequeo_etapa')->references('etapa_id')->on('etapa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chequeo', function(Blueprint $table)
		{
			$table->dropForeign('chequeo_calificacion');
			$table->dropForeign('chequeo_etapa');
		});
	}

}
