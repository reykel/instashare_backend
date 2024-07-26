<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert(array (
            0 =>
            array(
                'id' => 1,
                'role' => 'superadmin',
                'scopes' => 'basic-user,system-admin,common-admin,super-admin',
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            1 =>
            array(
                'id' => 2,
                'role' => 'tenant',
                'scopes' => 'basic-user,tenant-admin,common-admin,client-admin',
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            2 =>
            array(
                'id' => 3,
                'role' => 'user',
                'scopes' => 'basic-user,client-admin',
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            3 =>
             array(
                 'id' => 4,
                 'role' => 'admin',
                 'scopes' => 'basic-user,system-admin,common-admin',
                 'created_at' =>now(),
                 'updated_at' => now(),
             ),
        ));


        \DB::table('organizations')->insert(array (
            0 =>
            array(
                'id' => 1,
                'name' => 'root',
                'is_active' => 0,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
        ));


        \DB::table('users')->insert(array (
            0 =>
            array(
                'id' => 1,
                'name' => 'root',
                'email' => 'root@doe.com',
                'password' => '$2y$10$kx8U3.aWKE.rtq7EyVAffOUuVDzgoudI9FoslHfgWjivxpMqwTTDm',//A123456789a
                'is_active' => 0,
                'organization_id' => 1,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
        ));


        \DB::table('scopes')->insert(array (
            0 =>
            array(
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
        ));


        \DB::table('oauth_clients')->insert(array (
            0 =>
            array(
                'id' => 1,
                'user_id' => 0,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'KjKhuQVhQ7TChm9lrwaMpYlwwFK9VE00I8DyL1Zs',
                'provider' => '',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 2,
                'user_id' => 0,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'TJASU4CyKk8uHevG0lo79iluM6vdG4Ha7tVYjSqV',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 3,
                'user_id' => 0,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'AUG4JBSOkdSUHG1tfOEgG6u5MNiYJ5QSE3HJ3QfY',
                'provider' => '',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 4,
                'user_id' => 0,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'sdNgo1kJ6z8K4eRxuukAD40QwhXgu21bMeYbLYM6',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' =>now(),
                'updated_at' => now(),
            ),
        ));

    }
}
