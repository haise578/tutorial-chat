<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('testpass'),
            'profile' => '',
        ]);

        User::create([
            'name' => 'test2',
            'email' => 'test2@example.com',
            'password' => Hash::make('testpass'),
            'profile' => '',
        ]);
    }
}
