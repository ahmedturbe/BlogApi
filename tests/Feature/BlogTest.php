<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class BlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * Test get all blog posts
     */
    public function allPosts()
    {
        // Stvaranje testnih blog postova
        Post::factory()->count(5)->create();

        // Pozivanje API endpointa za dohvaćanje svih blog postova
        $response = $this->get('/api/blog');

        // Provjera statusnog koda odgovora
        $response->assertStatus(200);

        // Provjera broja vraćenih blog postova
        $response->assertJsonCount(5);

        // Provjera strukture odgovora
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
