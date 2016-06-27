<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailPattern extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('005_049_email_pattern')) 
		{
			Schema::create('005_049_email_pattern', function ($table) {
				$table->engine = 'InnoDB';
				$table->increments('id_049')->unsigned();
				$table->string('name_049');
				$table->string('subject_049')->nullable();
				$table->string('operator_049', 10)->nullable();
				$table->string('message_049')->nullable();
				
				// 0 = nada
				// 1 = borrar contacto y mensaje
				// 2 = unsuscribe y borrar mensaje
				// 3 = borrar contacto
				// 4 = ususcribe contacto
				// 5 = borrar mensaje
				$table->tinyInteger('action_049')->unsigned();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('005_049_email_pattern');
	}
}