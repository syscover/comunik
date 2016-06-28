<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class ComunikUpdateV2 extends Migration
{
	public function up()
	{
		// change country_041
		DBLibrary::renameColumnWithForeignKey('005_041_contact', 'country_041', 'country_id_041', 'VARCHAR', 2, false, false, 'fk01_005_041_contact', '001_002_country', 'id_002');

		// change group_042
		DBLibrary::renameColumnWithForeignKey('005_042_contacts_groups', 'group_042', 'group_id_042', 'INT', 10, true, false, 'fk01_005_042_contacts_groups', '005_040_group', 'id_040', 'cascade', 'cascade');
		// change contact_042
		DBLibrary::renameColumnWithForeignKey('005_042_contacts_groups', 'contact_042', 'contact_id_042', 'INT', 10, true, false, 'fk02_005_042_contacts_groups', '005_041_contact', 'id_041', 'cascade', 'cascade');

		// change email_account_044
		DBLibrary::renameColumnWithForeignKey('005_044_email_campaign', 'email_account_044', 'email_account_id_044', 'INT', 10, true, false, 'fk01_005_044_email_campaign', '001_013_email_account', 'id_013');
		// change template_044
		DBLibrary::renameColumnWithForeignKey('005_044_email_campaign', 'template_044', 'template_id_044', 'INT', 10, true, true, 'fk02_005_044_email_campaign', '005_043_email_template', 'id_043');

		// change campaign_045
		DBLibrary::renameColumnWithForeignKey('005_045_email_campaigns_countries', 'campaign_045', 'campaign_id_045', 'INT', 10, true, false, 'fk01_005_045_email_campaigns_countries', '005_044_email_campaign', 'id_044', 'cascade', 'cascade');
		// change country_045
		DBLibrary::renameColumnWithForeignKey('005_045_email_campaigns_countries', 'country_045', 'country_id_045', 'VARCHAR', 2, false, false, 'fk02_005_045_email_campaigns_countries', '001_002_country', 'id_002', 'cascade', 'cascade');

		// change campaign_046
		DBLibrary::renameColumnWithForeignKey('005_046_email_campaigns_groups', 'campaign_046', 'campaign_id_046', 'INT', 10, true, false, 'fk01_005_046_email_campaigns_groups', '005_044_email_campaign', 'id_044', 'cascade', 'cascade');
		// change group_046
		DBLibrary::renameColumnWithForeignKey('005_046_email_campaigns_groups', 'group_046', 'group_id_046', 'INT', 10, true, false, 'fk02_005_046_email_campaigns_groups', '005_040_group', 'id_040', 'cascade', 'cascade');

		// change campaign_047
		DBLibrary::renameColumnWithForeignKey('005_047_email_send_queue', 'campaign_047', 'campaign_id_047', 'INT', 10, true, false, 'fk01_005_047_email_send_queue', '005_044_email_campaign', 'id_044', 'cascade', 'cascade');
		// change contact_047
		DBLibrary::renameColumnWithForeignKey('005_047_email_send_queue', 'contact_047', 'contact_id_047', 'INT', 10, true, false, 'fk02_005_047_email_send_queue', '005_041_contact', 'id_041', 'cascade', 'cascade');
		
		// rename columns
		// status_047
		DBLibrary::renameColumn('005_047_email_send_queue', 'status_047', 'status_id_047', 'TINYINT', 3, true, false, 0);

		
		// rename table
		if (Schema::hasTable('005_048_email_send_historical'))
		{
			Schema::rename('005_048_email_send_historical', '005_048_email_send_history');
		}

		// change send_queue_048
		DBLibrary::renameColumnWithForeignKey('005_048_email_send_history', 'send_queue_048', 'send_queue_id_048', 'BIGINT', 20, true, true, 'fk01_005_048_email_send_history', '005_047_email_send_queue', 'id_047', 'set null', 'cascade');
		// change campaign_048
		DBLibrary::renameColumnWithForeignKey('005_048_email_send_history', 'campaign_048', 'campaign_id_048', 'INT', 10, true, false, 'fk02_005_048_email_send_history', '005_044_email_campaign', 'id_044', 'cascade', 'cascade');
		// change contact_048
		DBLibrary::renameColumnWithForeignKey('005_048_email_send_history', 'contact_048', 'contact_id_048', 'INT', 10, true, false, 'fk03_005_048_email_send_history', '005_041_contact', 'id_041', 'cascade', 'cascade');

	}

	public function down(){}
}