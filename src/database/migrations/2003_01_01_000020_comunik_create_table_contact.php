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
            Schema::create('005_030_contact', function($table){
                $table->engine = 'InnoDB';
                $table->increments('id_030')->unsigned();
                $table->string('company_030',100)->nullable();
                $table->string('name_030',50)->nullable();
                $table->string('surname_030',50)->nullable();
                $table->integer('birthdate_030')->nullable()->unsigned();
                $table->string('country_030',2)->index();
                $table->string('prefix_030',5)->nullable();
                $table->string('mobile_030',50)->nullable()->unique();
                $table->string('email_030',50)->nullable()->unique();
                $table->boolean('unsubscribe_mobile_030')->default(false);
                $table->boolean('unsubscribe_email_030')->default(false);

                $table->foreign('country_030')->references('id_002')->on('001_002_country')
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
            Schema::drop('005_030_contact');
	}

}