<?php

namespace Tests\FeatureDB;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(\App\User::class, 'FakeLogin')->make();
        $this->be($this->user);
        $this->seed('PostTestSeeder');
    }

    public function testIndex()
    {
        $getResponse = $this->get('/posts');
        $getResponse->assertStatus(200);
        $getResponse->assertSeeText('投稿テスト');
    }

    public function testStore()
    {
        $postResponse = $this->post('/posts', [
            'body' => 'Storeテスト',
        ]);
        $postResponse->assertStatus(302);
        $this->assertTrue(Post::where('body', 'Storeテスト')->count() == 1);
    }

    public function testDestroy()
    {
        $postSuccessResponse = $this->delete('/posts/1');
        $postSuccessResponse->assertStatus(302);
        $postSuccessResponse->assertRedirect('/posts');
        $this->assertTrue(is_null(Post::find(1)));
    }
}
