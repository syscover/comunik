<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailCampaign extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('005_044_email_campaign', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id_044')->unsigned();
            $table->string('name_044',100);
            $table->integer('email_account_044')->unsigned();
            $table->integer('template_044')->nullable()->unsigned();
            $table->string('subject_044',255);
            $table->string('theme_044',255);
            $table->text('header_044');
            $table->text('body_044');
            $table->text('footer_044');
            $table->text('text_044');
            $table->text('data_044');
            $table->integer('shipping_date_044')->nullable()->unsigned()->default(0);
            $table->integer('persistence_date_044')->nullable()->unsigned()->default(0);
            $table->smallInteger('sorting_044')->nullable()->unsigned()->default(0);
            $table->boolean('created_044')->default(false);
            $table->boolean('sent_044')->default(false);
            $table->integer('viewed_044')->unsigned()->default(0);

            $table->foreign('email_account_044')->references('id_013')->on('001_013_email_account')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('template_044')->references('id_043')->on('005_043_email_template')
                    ->onDelete('restrict')->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('005_044_email_campaign');
	}
}