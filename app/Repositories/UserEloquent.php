<?php
namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserEloquent implements UserInterface
{
    /**
     * ユーザー作成
     *
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * ユーザー更新
     *
     * @param array $data
     * @param User $user
     * @return bool
     */
    public function update(array $data, User $user): bool
    {
        return $user->fill($data)->save();
    }
}
