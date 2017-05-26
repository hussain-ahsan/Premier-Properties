<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * add the roles and permission against user admin.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->delete();

        $table = [
            [
                'role_id' => '1',
                'permission_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_id' => '1',
                'permission_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_id' => '1',
                'permission_id' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_id' => '2',
                'permission_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        DB::table('roles_permissions')->insert($table);
    }
}
