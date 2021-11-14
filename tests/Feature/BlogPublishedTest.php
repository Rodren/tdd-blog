<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BlogPublishedTest extends TestCase
{
    // do the migration before doing the test
    use DatabaseMigrations;

    /** @test */
    public function user_can_publish_a_blog()
    {
        $blog = $this->createBlog();

        $res = $this->patch('/blog/' . $blog->id, ['published_at' => now()]);

        $res->assertRedirect('/blog');
        $this->assertNotNull($blog->fresh()->published_at);
    }

    /** @test */
    public function user_can_unpublish_a_blog()
    {
        $blog = $this->createBlog(['published_at' => now()]);

        $res = $this->patch('/blog/' . $blog->id, ['published_at' => null]);

        $res->assertRedirect('/blog');
        $this->assertNull($blog->fresh()->published_at);
    }
}
