<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTablePlantillaEmail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_058_plantilla_email', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_058')->unsigned();
                $table->string('nombre_058',100);
                $table->string('asunto_058',255);
                $table->string('theme_058',255);
                $table->text('header_058');
                $table->text('body_058');
                $table->text('footer_058');
                $table->text('text_058');
                $table->text('data_058');
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
            Schema::drop('005_058_plantilla_email');
	}

}