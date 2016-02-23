<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FlyerPhoto extends Model {

    /**
     * @var string
     * The associated table.
     */
    protected $table = "flyer_photos";

    /**
     * @var array
     */
    protected $fillable = ['name', 'path', 'thumbnail_path'];


    /**
     * Flyer photos belong to a Travel Flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer() {
        return $this->belongsTo('App\Flyer');
    }


    /**
     * Get the flyer photos base directory.
     */
    public function baseDir() {
        return 'src/public/FlyerPhotos/photos';
    }


    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;

        //
        $this->path = $this->baseDir() . '/' . $name;

        //
        $this->thumbnail_path = $this->baseDir() . '/th-' . $name;
    }


    /**
     * @throws \Exception
     */
    public function delete() {

        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

}