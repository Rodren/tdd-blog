<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BlogTest extends TestCase
{
    // do the migration before doing the test
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_all_blogs()
    {
        $blog = $this->createBlog(['published_at' => now()], 2);
        $unPublishedBlog = $this->createBlog([], 2);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($blog[0]->title);
        $response->assertSee($blog[0]->body);
        $response->assertDontSee($unPublishedBlog[0]->title);
    }

    /** @test */
    public function user_can_visit_a_single_blog()
    {
        $blog = $this->createBlog(['title' => 'This is my new blog', 'published_at' => now()]);

        $res = $this->get('/blog/' . $blog->id);

        $res->assertStatus(200);
        $res->assertSee($blog->title);
    }

    /** @test */
    public function user_can_not_visit_a_published_single_blog()
    {
        $blog = $this->createBlog();

        $res = $this->get('/blog/' . $blog->id);

        $res->assertStatus(404);
        $res->assertDontSee($blog->title);
    }

    /** @test */
    public function user_can_store_blog()
    {
        $blog = Blog::factory()->raw();

        $res = $this->post('/blog', $blog);

        $res->assertRedirect('/blog');
        $this->assertDatabaseHas('blogs', $blog);
    }

    /** @test */
    public function user_can_delete_a_blog()
    {
        $blog = $this->createBlog();

        $res = $this->delete('/blog/' . $blog->id);

        $res->assertRedirect('/blog');
        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);

    }

    /** @test */
    public function user_can_update_blog_details()
    {
        $blog = $this->createBlog();

        $res = $this->patch('/blog/' . $blog->id, ['title' => 'updated title']);

        $res->assertRedirect('/blog');
        $this->assertDatabaseHas('blogs', ['id' => $blog->id, 'title' => 'updated title']);
    }

    /** @test */
    public function user_can_visit_a_form_to_store_a_blog()
    {

        $res = $this->get('/blog/create');

        $res->assertStatus(200);
        $res->assertSee('Create New Blog');
    }

    /** @test */
    public function user_can_visit_the_blog_update_form()
    {
        $blog = $this->createBlog();

        $res = $this->get('/blog/' . $blog->id . '/edit');

        $res->assertStatus(200);
        $res->assertSee('Update The Blog');
        $res->assertSee($blog->title);
    }
}
