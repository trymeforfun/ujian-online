<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Teacher')->insert([
            'id' => 4,
            'teacher_username' => 'Kurniawan',
            'teacher_password' => Hash::make('guru123'),
            'teacher_email' => 'Okky@kurniawan',
            'teacher_hide' => 0,
            'teacher_created' => date('Y-m-d')
        ]);
    }
}
