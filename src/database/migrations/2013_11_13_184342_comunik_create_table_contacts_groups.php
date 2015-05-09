<?php

use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableContactsGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('005_044_contacts_groups', function($table){
                $table->engine = 'InnoDB';
                $table->integer('contact_044')->unsigned();
                $table->integer('group_044')->unsigned();

                $table->primary(['contact_044', 'group_044']);
                $table->foreign('contact_044')->references('id_030')->on('005_030_contact')
                        ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('group_044')->references('id_029')->on('005_029_group')
                        ->onDelete('cascade')->onUpdate('cascade');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('005_044_contacts_groups');
	}

}