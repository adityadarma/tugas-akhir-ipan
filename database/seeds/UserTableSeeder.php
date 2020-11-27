<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [   'id'                        => 1,
                'nama'                      => 'Owner',
                'email'                     => 'owner@gmail.com',
                'password'                  => Hash::make('owner'),
                'role_id'                   => 1,
            ],
            [   'id'                        => 2,
                'nama'                      => 'Admin',
                'email'                     => 'admin@gmail.com',
                'password'                  => Hash::make('admin'),
                'role_id'                   => 1,
            ]
        ]);
    }
}
