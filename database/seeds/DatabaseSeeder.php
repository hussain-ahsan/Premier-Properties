<?php

use Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(\UsersTableSeeder::class);
        $this->call(\PermissionsTableSeeder::class);
        $this->call(\RolesTableSeeder::class);
        $this->call(\UserRolesTableSeeder::class);
        $this->call(\RolesAndPermissionsTableSeeder::class);
        $this->call(\StatesTableSeeder::class);

        Model::reguard();
    }
}
