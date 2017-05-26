<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Create an admin user in the database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $table = [
            'first_name' => env('FIRST_NAME'),
            'last_name' => env('LAST_NAME'),
            'email' => env('EMAIL'),
            'status' => 1,
	            'permanent' => 1,
            'password' => bcrypt(env('PASSWORD')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($table);
    }
}
