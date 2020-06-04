<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'id' => 1,
            'username' => 'Dimas',
            'password' => Hash::make('guru123'),
            'email' => 'Okky@kurniawan',
            'level' => 'guru',
            'is_active' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
        DB::table('Users')->insert([
            'id' => 2,
            'username' => 'Dimas',
            'password' => Hash::make('staff123'),
            'email' => 'Dimas@Ardiansyah',
            'level' => 'staff',
            'is_active' => 1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
