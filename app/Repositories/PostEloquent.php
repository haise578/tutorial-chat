<?php
namespace App\Repositories;

use App\Post;

class PostEloquent implements PostInterface
{
    /**
     * 全メッセージ取得
     *
     * @return object
     */
    public function getAll(): object
    {
        return Post::with('user')->get()->sortBy('created_at');
    }

    /**
     * メッセージ作成
     *
     * @param string $body
     * @param int $userId
     * @return object
     */
    public function create(string $body, int $userId): object
    {
        return Post::create([
            'body' => $body,
            'user_id' => $userId,
        ]);
    }
}
