<?php

namespace App\Http;

use Intervention\Image\Image;

class ImageFile
{
    /**
     * Intervention image instance.
     *
     * @var \Intervention\Image\Image
     */
    private $image;

    function __construct(Image $image)
    {
        $this->image = $image;
    }

    function getRealPath()
    {
        return $this->image->basePath();
    }

}
