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
        Schema::create('005_045_email_campaigns_countries', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('campaign_045')->unsigned();
            $table->string('country_045',2);

            $table->primary(['campaign_045', 'country_045'], 'pk01_005_045_email_campaigns_countries');

            $table->foreign('campaign_045', 'fk01_005_045_email_campaigns_countries')->references('id_044')->on('005_044_email_campaign')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_045', '')->references('id_002')->on('001_002_country')
                    ->onDelete('cascade', 'fk02_005_045_email_campaigns_countries')->onUpdate('cascade');
        });
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