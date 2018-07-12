<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class Photo extends Model
{

    /**
     * @var array - Fillable fields
     */
    protected $fillable = [
        'path', 'description', 'marker_id'
    ];

    /**
     * @var array - Picture proccessed sizes
     */
    public $sizes = [
        'o' => ['width' => null, 'height' => null],
        'l' => ['width' => 1920, 'height' => 1080],
        'm' => ['width' => 1280, 'height' => 720],
        's' => ['width' => 576, 'height' => 324]
    ];

    /**
     * A Photo belongsTo a Marker
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marker()
    {
        return $this->belongsTo(Marker::class);
    }

    /**
     * Thumbnail picture shortcut method
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->getPath('s');
    }
    /**
     * Determines the path for a given picture size and format
     * @param string $size
     * @param string $format
     * @return string
     */
    public function getPath($size = 'o', $format = 'jpg')
    {
        $sizes = array_keys($this->sizes);
        if (!in_array($size, $sizes)) return null;
        return Storage::disk('public')->url(
            $this->getFilepath($size, $format)
        );
    }
    /**
     * Determines the current entity' filepath
     * @param string $size - Given file size (s for small, l for large, o for original)
     * @param string $format - File format
     * @return string
     */
    public function getFilepath($size = 'o', $format = 'jpg')
    {
        $filename = $this->getFilename($size, $format);
        $directory = 'uploads/' . $this->marker_id;
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }
        return $directory . '/' . $filename;
    }
    /**
     * Determines a picture filename
     * @param string $size - Picture size
     * @param string $format - File format
     * @return string - Picture hashed filename
     */
    public function getFilename($size = 'o', $format = 'jpg')
    {
        return md5(
                $this->id . $size . $this->created_at
            ) . '.' . $format;
    }

    /**
     * Stores the newly created picture
     * @param UploadedFile $file
     * @return Photo
     */
    public function store(UploadedFile $file)
    {
        $image = Image::make(
            $file->getRealPath()
        );
        foreach ($this->sizes as $name => $size) {
            $filepath = Storage::disk('public')->path(
                $this->getFilepath($name)
            );
            $this->process($image, $size['width'], $size['height'])
                ->save($filepath);
            ImageOptimizer::optimize($filepath);
        }

        return $this;
    }
    /**
     * Original image specific process
     * @param InterventionImage $image
     * @param $width - Max image width
     * @param $height - Max image height
     * @return InterventionImage $image
     */
    protected function process (InterventionImage $image, $width, $height)
    {
        if (is_null($width) || is_null($height)) return $image;
        $constraint = function ($constraint) {
            $constraint->upsize();
        };
        if ($image->width() >= $image->height()) {
            return $image->heighten($height, $constraint);
        }
        return $image->widen($width, $constraint);
    }
}
