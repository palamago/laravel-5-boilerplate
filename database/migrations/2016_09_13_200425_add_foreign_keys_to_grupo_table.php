<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grupo', function(Blueprint $table)
		{
			$table->foreign('etapa_maxima', 'etapa_maxima_grupo')->references('etapa_id')->on('etapa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('grupo', function(Blueprint $table)
		{
			$table->dropForeign('etapa_maxima_grupo');
		});
	}

}
