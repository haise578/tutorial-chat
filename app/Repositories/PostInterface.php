<?php
namespace App\Repositories;

interface PostInterface
{
    /**
     * 全メッセージ取得
     *
     * @return object
     */
    public function getAll(): object;

    /**
     * メッセージ作成
     *
     * @param string $body
     * @param int $userId
     * @return object
     */
    public function create(string $body, int $userId): object;
}
