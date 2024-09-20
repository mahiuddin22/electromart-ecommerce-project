<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('123456');
        $adminRecords = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => $password,
            'image' => '',
            'status' => '1',
        ];
        Admin::insert($adminRecords);
    }
}
