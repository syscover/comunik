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
		if (! Schema::hasTable('005_042_contacts_groups'))
		{
			Schema::create('005_042_contacts_groups', function ($table) {
				$table->engine = 'InnoDB';
				
				$table->integer('group_042')->unsigned();
				$table->integer('contact_042')->unsigned();

				$table->foreign('group_042', 'fk01_005_042_contacts_groups')
					->references('id_040')
					->on('005_040_group')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('contact_042', 'fk02_005_042_contacts_groups')
					->references('id_041')
					->on('005_041_contact')
					->onDelete('cascade')
					->onUpdate('cascade');

				$table->primary(['contact_042', 'group_042'], 'pk01_005_042_contacts_groups');
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
            Schema::drop('005_042_contacts_groups');
	}
}