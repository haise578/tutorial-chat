<?php

namespace Tests\FeatureDB;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetRegisterPage(): void
    {
        $getResponse = $this->get('/register');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('会員登録');
    }

    public function testRegister(): void
    {
        $postSuccessResponse = $this->withoutMiddleware()->post('/register', [
            'email' => 'test@example.com',
            'name' => 'テスト',
            'password' => 'test0000',
            'password_confirmation' => 'test0000',
        ]);
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/');
    }

    public function testRegisterValidation(): void
    {
        $postFailureResponse = $this->withoutMiddleware()->post('/register', [
            'email' => 'test@example.com',
            'name' => 'テスト'
        ]);
        $postFailureResponse->assertStatus(302);
        $postFailureResponse->assertSessionHasErrorsIn('password');
    }
}
