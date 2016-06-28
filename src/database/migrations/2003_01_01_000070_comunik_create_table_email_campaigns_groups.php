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
		if (! Schema::hasTable('005_046_email_campaigns_groups'))
		{
			Schema::create('005_046_email_campaigns_groups', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->integer('campaign_id_046')->unsigned();
				$table->integer('group_id_046')->unsigned();

				$table->foreign('campaign_id_046', 'fk01_005_046_email_campaigns_groups')
					->references('id_044')
					->on('005_044_email_campaign')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('group_id_046', 'fk02_005_046_email_campaigns_groups')
					->references('id_040')
					->on('005_040_group')
					->onDelete('cascade')
					->onUpdate('cascade');

				$table->primary(['campaign_id_046', 'group_id_046'], 'pk01_005_046_email_campaigns_groups');
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
        Schema::drop('005_046_email_campaigns_groups');
	}
}