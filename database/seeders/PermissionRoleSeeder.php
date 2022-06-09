<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        

        $data = [
            /* =================================== */
            /*          ADMIN ROLE                 */
            /* =================================== */
            [
                'permission_id' => 1,
                'role_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_id' => 1,
            ],
            [
                'permission_id' => 3,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 1,
            ],
            [
                'permission_id' => 5,
                'role_id' => 1,
            ],
            [
                'permission_id' => 6,
                'role_id' => 1,
            ],
            [
                'permission_id' => 7,
                'role_id' => 1,
            ],
            [
                'permission_id' => 8,
                'role_id' => 1,
            ],
            [
                'permission_id' => 9,
                'role_id' => 1,
            ],
            [
                'permission_id' => 10,
                'role_id' => 1,
            ],
            [
                'permission_id' => 11,
                'role_id' => 1,
            ],
            [
                'permission_id' => 12,
                'role_id' => 1,
            ],
            /* =================================== */
            /*          COORDINATOR ROLE           */
            /* =================================== */
            [
                'permission_id' => 1,
                'role_id' => 2,
            ],
            [
                'permission_id' => 2,
                'role_id' => 2,
            ],
            [
                'permission_id' => 3,
                'role_id' => 2,
            ],
            [
                'permission_id' => 4,
                'role_id' => 2,
            ],
            [
                'permission_id' => 5,
                'role_id' => 2,
            ],
            [
                'permission_id' => 8,
                'role_id' => 2,
            ],
            [
                'permission_id' => 9,
                'role_id' => 2,
            ],
            [
                'permission_id' => 10,
                'role_id' => 2,
            ],
            /* =================================== */
            /*          MANAGER ROLE                 */
            /* =================================== */
            [
                'permission_id' => 1,
                'role_id' => 3,
            ],
            [
                'permission_id' => 2,
                'role_id' => 3,
            ],
            [
                'permission_id' => 3,
                'role_id' => 3,
            ],
            [
                'permission_id' => 4,
                'role_id' => 3,
            ],
            [
                'permission_id' => 5,
                'role_id' => 3,
            ],
            [
                'permission_id' => 6,
                'role_id' => 3,
            ],
            [
                'permission_id' => 7,
                'role_id' => 3,
            ],
            [
                'permission_id' => 8,
                'role_id' => 3,
            ],
            [
                'permission_id' => 9,
                'role_id' => 3,
            ],
            [
                'permission_id' => 10,
                'role_id' => 3,
            ],
            [
                'permission_id' => 11,
                'role_id' => 3,
            ],
            [
                'permission_id' => 12,
                'role_id' => 3,
            ],
            /* =================================== */
            /*          USER ROLE                 */
            /* =================================== */
            [
                'permission_id' => 1,
                'role_id' => 4,
            ],
            [
                'permission_id' => 2,
                'role_id' => 4,
            ],
            [
                'permission_id' => 3,
                'role_id' => 4,
            ],
            [
                'permission_id' => 4,
                'role_id' => 4,
            ],
            [
                'permission_id' => 5,
                'role_id' => 4,
            ],
            [
                'permission_id' => 6,
                'role_id' => 4,
            ],
            [
                'permission_id' => 7,
                'role_id' => 4,
            ],
            [
                'permission_id' => 8,
                'role_id' => 4,
            ],
            [
                'permission_id' => 9,
                'role_id' => 4,
            ]

        ];

        DB::table('permission_role')->insert($data);

        $this->command->info('Permission role has been created!');
    }
}
