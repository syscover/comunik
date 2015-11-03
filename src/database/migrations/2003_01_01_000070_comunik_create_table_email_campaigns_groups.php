<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikCreateTableEmailCampaignsGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('005_046_email_campaigns_groups', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('campaign_046')->unsigned();
            $table->integer('group_046')->unsigned();

            $table->primary(['campaign_046', 'group_046'], 'pk01_005_046_email_campaigns_groups');

            $table->foreign('campaign_046', 'fk01_005_046_email_campaigns_groups')->references('id_044')->on('005_044_email_campaign')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_046', 'fk02_005_046_email_campaigns_groups')->references('id_040')->on('005_040_group')
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
        Schema::drop('005_046_email_campaigns_groups');
	}

}