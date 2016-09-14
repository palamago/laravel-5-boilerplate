<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChequeoFuenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chequeo_fuente', function(Blueprint $table)
		{
			$table->foreign('chequeo_id', 'chequeo_fuente')->references('chequeo_id')->on('chequeo')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chequeo_fuente', function(Blueprint $table)
		{
			$table->dropForeign('chequeo_fuente');
		});
	}

}
