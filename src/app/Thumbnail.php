<?php

namespace App;

use Image;

class Thumbnail {


    public function make($src, $destination) {
        Image::make($src)
            ->fit(250)
            ->save($destination);
    }

}