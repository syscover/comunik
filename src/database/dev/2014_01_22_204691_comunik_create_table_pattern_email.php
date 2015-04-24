<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTablePatternEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('005_079_pattern_email', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id_079')->unsigned();
            $table->string('name_079', 100);
            $table->string('subject_079', 255)->nullable();
            $table->string('message_079', 255)->nullable();
            $table->string('summation_079', 10)->nullable();
            $table->tinyInteger('action_079')->unsigned(); // 0 = nada, 1 = borrar contacto y mensaje, 2 = unsuscribe y borrar mensaje, 3 = borrar contacto, 4 = ususcribe contacto, 5 = borrar mensaje
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
        Schema::drop('005_079_pattern_email');
	}

}
