<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_upload_a_photo()
    {
        $this->be(
            factory(User::class)->create()
        );

        Storage::fake('public');

        $file = UploadedFile::fake()->image('file1.jpg');
        $photo = factory(Photo::class)->make();

        $this->postJson(
            route('photos.store', [$photo->marker->roadwork_id, $photo->marker_id]),
            $photo->toArray() + ['photo' => $file]
        );

        $photo = $photo->where(
            $photo->only('description', 'marker_id')
        )->first();

        $sizes = array_keys($photo->sizes);
        foreach ($sizes as $size) {
            Storage::disk('public')->assertExists("uploads/{$photo->marker_id}/{$photo->getFilename($size)}");
        }
    }
}
