<?php

namespace Tests\FeatureDB;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(\App\User::class, 'FakeLogin')->make();
        $this->be($this->user);
        $this->seed('UserSeeder');
    }

    public function testShowSelf()
    {
        $getResponse = $this->get('/user/1');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('ユーザー情報');
    }

    public function testShowOther()
    {
        $getResponse = $this->get('/user/2');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('ユーザー情報');
    }

    public function testEditSelf()
    {
        $getResponse = $this->get('/user/1/edit');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('プロフィール編集');
    }

    public function testEditOther()
    {
        $getResponse = $this->get('/user/2/edit');
        $getResponse->assertStatus(403);
    }

    public function testUpdateSelf()
    {
        $postSuccessResponse = $this->put('/user/1', [
            'email' => 'test@example.com',
            'name' => 'test',
            'profile' => 'test',
        ]);
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/user/1');
    }

    public function testUpdateValidation()
    {
        $postFailureResponse = $this->put('/user/1', [
            'email' => 'test@example.com',
            'name' => 'test',
        ]);
        $postFailureResponse->assertStatus(302);
        $postFailureResponse->assertSessionHasErrorsIn('profie');
    }

    public function testUpdateOther()
    {
        $postFailureResponse = $this->put('/user/2', [
            'email' => 'test@example.com',
            'name' => 'test',
        ]);
        $postFailureResponse->assertStatus(403);
    }

    public function testDestroySelf()
    {
        $postSuccessResponse = $this->delete('/user/1');
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/register');
    }

    public function testDestroyOther()
    {
        $postFailureResponse = $this->delete('/user/2');
        $postFailureResponse->assertStatus(403);
    }
}
