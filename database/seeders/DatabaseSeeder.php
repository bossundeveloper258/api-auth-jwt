<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('rols')->insert(
            array(
                array(
                    'name' => 'admin',
                    'status' => true
                ),
                array(
                    'name' => 'user',
                    'status' => true
                )
            )
        );

        DB::table('departments')->insert(
            array(
                array(
                    'name' => 'department1',
                    'status' => 1,
                )
            )
        );

        DB::table('cities')->insert(
            array(
                array(
                    'name' => 'city1',
                    'status' => 1,
                    'id_department' => 1,
                )
            )
        );

        DB::table('type_people')->insert(
            array(
                array(
                    'description' => 'type_people1',
                    'status' => 1,
                )
            )
        );

        DB::table('people')->insert(
            array(
                array(
                    'name' => 'admin',
                    'lastname' => '',
                    'phone' => '',
                    'email' => '',
                    'nuip' => '123456789',
                    'id_city' => 1,
                    'id_type_person' => 1,
                    'status' => 1,
                )
            )
        );

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'id_rol' => 1,
                    'id_person' => 1,
                    'password' => bcrypt('admin123'),
                )
            )
        );
    }
}
