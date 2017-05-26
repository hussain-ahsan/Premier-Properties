<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserRolesTableSeeder extends Seeder
{
    /**
     * assign a role to the user.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->delete();
        $table = [
            'role_id' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('user_roles')->insert($table);
    }
}
