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
        DB::table('directors')->insert([
            'fullname' => 'Mohammed Ali',
            'username'=> 'M.Ali123',
            'email' => 'directorX@taourirt.ma',
            'password' => Hash::make('12345678'),
        ]);
    }
}
