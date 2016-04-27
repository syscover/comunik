<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Package;

class ComunikPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id_012' => '5', 'name_012' => 'Comunik Package', 'folder_012' => 'comunik', 'sorting_012' => 5, 'active_012' => false]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikPackageTableSeeder"
 */