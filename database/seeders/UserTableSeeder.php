<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $password = Hash::make('12345678');
        $userRecords = [
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => $password,
        ];
        User::insert($userRecords);
    }
}
