<?php
namespace App\Repositories;

use App\User;

interface UserInterface
{
    /**
     * ユーザー作成
     *
     * @param array $data
     * @return object
     */
    public function create(array $data): object;

    /**
     * ユーザー更新
     *
     * @param array $data
     * @param User $user
     * @return bool
     */
    public function update(array $data, User $user): bool;
}
