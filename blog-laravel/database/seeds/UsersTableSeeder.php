<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //插入默认管理员数据
        \App\Models\User::insert([
            "username" => "season",
            "password" => Hash::make("seasonxuan233"),
            "type" => "0"
        ]);
    }
}
