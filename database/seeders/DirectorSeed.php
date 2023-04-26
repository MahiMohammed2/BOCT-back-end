<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DirectorSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presidents')->insert([
            'fullname' => 'ahmed ahmed',
            'username'=> 'ahmed1234',
            'email' => 'ahmed1234@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
