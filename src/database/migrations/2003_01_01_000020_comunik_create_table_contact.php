<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableContact extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_041_contact', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_041')->unsigned();
                $table->string('company_041',100)->nullable();
                $table->string('name_041',50)->nullable();
                $table->string('surname_041',50)->nullable();
                $table->integer('birth_date_041')->nullable()->unsigned();
                $table->string('country_041',2)->index();
                $table->string('prefix_041',5)->nullable();
                $table->string('mobile_041',50)->nullable()->unique();
                $table->string('email_041',50)->nullable()->unique();
                $table->boolean('unsubscribe_mobile_041')->default(false);
                $table->boolean('unsubscribe_email_041')->default(false);

                $table->foreign('country_041')->references('id_002')->on('001_002_country')
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
            Schema::drop('005_041_contact');
	}

}