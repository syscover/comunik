<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class ComunikUpdateV3 extends Migration
{
	public function up()
	{
        // rename columns
        // birth_date_041
        DBLibrary::renameColumn('005_041_contact', 'birth_date_041', 'birth_date_041', 'INT', 10, false, true);
	}

	public function down(){}
}