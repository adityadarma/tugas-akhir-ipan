<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [   'id'                        => 1,
                'nama'                      => 'Owner'
            ],
            [   'id'                        => 2,
                'nama'                      => 'Admin'
            ]
        ]);
    }
}
