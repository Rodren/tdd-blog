<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogImageUploadTest extends TestCase
{
    // do the migration before doing the test
    use DatabaseMigrations;

    /** @test */
    public function user_can_upload_image_along_with_blog_details()
    {
        Storage::fake();
        $blog = Blog::factory()->raw();

        $res = $this->post('/blog', $blog);

        $this->assertDatabaseHas('blogs', ['image' => $blog['image']]);
        Storage::assertExists('photo1.jpg');
    }
}
