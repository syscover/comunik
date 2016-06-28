<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailTemplate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('005_043_email_template'))
		{
			Schema::create('005_043_email_template', function ($table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id_043')->unsigned();
				$table->string('name_043');
				$table->string('subject_043');
				$table->string('theme_043');
				$table->text('header_043');
				$table->text('body_043');
				$table->text('footer_043');
				$table->text('text_043');
				$table->text('data_043')->nullable();
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
    	Schema::drop('005_043_email_template');
	}
}