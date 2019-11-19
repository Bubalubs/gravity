<?php

namespace Bubalubs\LaravelGravity;

use Intervention\Image\ImageManager;

class ImageProcessor
{
    public $width = 1000;
    public $height = null;

    private $path = null;

    function __construct($path)
    {
        $this->path = $path;
    }

    public function process()
    {
        $imageManager = new ImageManager;

        return $imageManager->make($this->path)
                            ->resize($this->width, $this->height, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->orientate()
                            ->save($this->path, 80);
    }
}