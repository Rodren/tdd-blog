<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BlogTest extends TestCase
{
    // do the migration before doing the test
    use DatabaseMigrations;
    
   /** @test */
    public function user_can_see_all_blogs()
    {
        // past / scene / prepare
        $blog1 = $this->createBlog();;

        // present / action / act
        $response = $this->get('/blog');

        // future / assertion / assert
        $response->assertStatus(200);
        $response->assertSee($blog1->title);
    }

    /** @test */
    public function user_can_visit_a_single_blog() {
        // prepare
        $blog = $this->createBlog('This is my new blog');

        // act
        $res = $this->get('/blog/' . $blog->id);

        // assert
        $res->assertStatus(200);
        $res->assertSee($blog->title);
    }

    /** @test */
    public function user_can_store_blog() {
        // prepare
        $data = ['title'=> 'title for blog to store'];
        // act
        $res = $this->post('/blog', $data);

        // assert
        $res->assertRedirect('/blog');
        $this->assertDatabaseHas('blogs', $data);

    }

    protected function createBlog($title=null) {
        $title = $title ?? 'Simple ever blog';
        return Blog::create(['title'=>$title]);
    }
}
