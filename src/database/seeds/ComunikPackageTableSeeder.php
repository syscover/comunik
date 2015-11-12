<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Package;

class ComunikPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id_012' => '3', 'name_012' => 'Comunik Package', 'folder_012' => 'comunik', 'sorting_012' => 3, 'active_012' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikPackageTableSeeder"
 */