<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailCampaignsCountries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('005_045_email_campaigns_countries'))
		{
			Schema::create('005_045_email_campaigns_countries', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->integer('campaign_id_045')->unsigned();
				$table->string('country_id_045', 2);

				$table->foreign('campaign_id_045', 'fk01_005_045_email_campaigns_countries')
					->references('id_044')
					->on('005_044_email_campaign')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('country_id_045', 'fk02_005_045_email_campaigns_countries')
					->references('id_002')
					->on('001_002_country')
					->onDelete('cascade')
					->onUpdate('cascade');

				$table->primary(['campaign_id_045', 'country_id_045'], 'pk01_005_045_email_campaigns_countries');
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
        Schema::drop('005_045_email_campaigns_countries');
	}
}