<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(\Figtest\Models\User::class)->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@qq.com',
            'password' => '12345678'
        ]);
    }
}
