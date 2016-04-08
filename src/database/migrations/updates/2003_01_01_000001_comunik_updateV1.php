<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComunikUpdateV1 extends Migration
{
	public function up()
	{
		if(!Schema::hasColumn('005_041_contact', 'birth_date_text_041'))
		{
			Schema::table('005_041_contact', function (Blueprint $table) {
				$table->string('birth_date_text_041')->nullable()->after('birth_date_041');
			});
		}

		if(!Schema::hasColumn('005_044_email_campaign', 'shipping_date_text_044'))
		{
			Schema::table('005_044_email_campaign', function (Blueprint $table) {
				$table->string('shipping_date_text_044')->nullable()->after('shipping_date_044');
			});
		}

		if(!Schema::hasColumn('005_044_email_campaign', 'persistence_date_text_044'))
		{
			Schema::table('005_044_email_campaign', function (Blueprint $table) {
				$table->string('persistence_date_text_044')->nullable()->after('persistence_date_044');
			});
		}
	}

	public function down(){}
}