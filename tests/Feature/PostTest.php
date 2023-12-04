<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Web post list
     @test
     */
    public function web_list_posts(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/posts');
        $response->assertStatus(200);
    }

    /**
     * Web Not Authenticated
     @test
     */
    public function web_not_auth()
    {
        $response = $this->get('/posts');
        $response->assertRedirect('/login');
    }

    /**
     * Api posts list
     @test
     */
    public function api_list_posts(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->get('/api/v1/posts');
        $response->assertStatus(200);
    }

    /**
     * Api show post
     @test
     */
    public function api_show_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->make(['author_id' => $user->id]);

        $response = $this->actingAs($user, 'api')
            ->get('/api/v1/posts/'.$post->id);
        $response->assertStatus(200);
    }

    /**
     * Api post create
     @test
     */
    public function api_create_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->make();

        $response = $this->actingAs($user, 'api')->post('/api/v1/posts', $post->toArray());
        $response->assertStatus(201);
    }

    /**
     * Api update post
     *
     * @test
     */
    public function api_update_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->make(['author_id' => $user->id]);
        $postUpdate = Post::factory()->make();
        $this->actingAs($user, 'api')->post('/api/v1/posts', $post->toArray());
        $this->actingAs($user, 'api')
            ->put('/api/v1/posts/1', $postUpdate->toArray());
        $posted = Post::find(1);
        $this->assertEquals($posted['content'], $postUpdate['content']);
    }

    /**
     * Api delete post
     *
     * @test
     */
    public function api_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->make(['author_id' => $user->id]);
        $this->actingAs($user, 'api')->post('/api/v1/posts', $post->toArray());
        $this->actingAs($user, 'api')->delete('/api/v1/posts/1');
        $this->assertNull(Post::find(1));
    }
}
