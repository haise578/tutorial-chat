<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class PostTestSeeder extends Seeder
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

        Post::create([
            'body' => '投稿テスト',
            'user_id' => '1',
        ]);
    }
}
