<?php

namespace Tests\FeatureDB;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UserSeeder');
    }

    public function testGetLoginPage(): void
    {
        $getResponse = $this->get('/login');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('ログイン');
    }

    public function testLogin(): void
    {
        $postSuccessResponse = $this->withoutMiddleware()->post('/login', [
            'email' => 'test@example.com',
            'password' => 'testpass',
        ]);
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/');
        $this->assertTrue(Auth::check());
    }

    public function testLoginValidation(): void
    {
        $postFailureResponse = $this->withoutMiddleware()->post('/login', [
            'email' => 'test@example.com',
            'password' => '',
        ]);
        $postFailureResponse->assertStatus(302);
        $postFailureResponse->assertSessionHasErrorsIn('password');
        $this->assertFalse(Auth::check());
    }

    public function testLogout()
    {
        $user = factory(\App\User::class, 'FakeLogin')->make();
        $this->be($user);
        $postSuccessResponse = $this->withoutMiddleware()->post('/logout', []);
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/login');
        $this->assertFalse(Auth::check());
    }

    public function testRemember()
    {
        $postSuccessResponse = $this->withoutMiddleware()->post('/login', [
            'email' => 'test@example.com',
            'password' => 'testpass',
            'remember' => '1',
        ]);
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/');
        $this->assertTrue(Auth::check());
        $user = User::where('email', 'test@example.com')->find(1);
        $this->assertTrue(strlen($user->remember_token) > 0);
    }
}
