<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $marker = factory(Marker::class)->make();
        $this->postJson(route('admin.projects.store'), $marker->toArray() + [
                'photo' => $file
            ]);
        $marker = Marker::where($marker->only('id'))
            ->with('photos')
            ->first();
        foreach ($marker->photos as $photo) {
            $sizes = array_keys($photo->sizes);
            foreach ($sizes as $size) {
                Storage::disk('public')->assertExists("uploads/{$marker->id}/{$photo->getFilename($size)}");
            }
        }
    }
}
