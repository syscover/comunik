<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailSendQueue extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('005_047_email_send_queue'))
		{
			Schema::create('005_047_email_send_queue', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->bigIncrements('id_047')->unsigned();
				$table->integer('campaign_047')->unsigned();
				$table->integer('contact_047')->unsigned();
				$table->smallInteger('sorting_047')->nullable()->unsigned()->default(0);
				// status_047 = 0 waiting
				// status_047 = 1 in process
				// when is sent, will be deleted
				$table->tinyInteger('status_047')->unsigned()->default(0);
				$table->integer('create_047')->unsigned();

				$table->foreign('campaign_047', 'fk01_005_047_email_send_queue')->references('id_044')->on('005_044_email_campaign')
					->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('contact_047', 'fk02_005_047_email_send_queue')->references('id_041')->on('005_041_contact')
					->onDelete('cascade')->onUpdate('cascade');
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
            Schema::drop('005_047_email_send_queue');
	}

}