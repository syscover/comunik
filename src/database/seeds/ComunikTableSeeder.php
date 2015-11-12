<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComunikTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(ComunikPackageTableSeeder::class);
        $this->call(ComunikResourceTableSeeder::class);
        $this->call(ComunikCronjobTableSeeder::class);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ComunikTableSeeder"
 */