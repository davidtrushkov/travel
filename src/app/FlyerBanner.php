<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyerBanner extends Model {

    /**
     * @var string
     */
    protected $table = "flyer_banner";

    /**
     * @var array
     */
    protected $fillable = ['name', 'path', 'thumbnail_path'];

    /**
     * @var
     */
    protected $file;

    /**
     * @var
     */
    protected $name;


    /**
     * A banner photo belongs to a flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer() {
      return $this->belongsTo('App\Flyer');
    }


    /**
     * Make a new instance from an uploaded file.
     *
     * @param UploadedFile $file
     * @return static
     */
    public static function fromFile(UploadedFile $file) {
        // Make new instance of photo.
        $photo = new static;

        // Assign the Uploaded file to the $file object.
        $photo->file = $file;

        // Set $photo to the fill properties, which are
        // the name, path, and thumbnail path of a photo.
        $photo->fill([
            'name' => $photo->setFileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);

        // return the photo
        return $photo;

    }


    /**
     * Get the banner photos base directory.
     */
    public function baseDir() {
        return 'src/public/FlyerBanner/photos';
    }


    /**
     * Get the name and extension of the banner photo.
     *
     * @return string
     */
    public function setFileName() {
        // Get the file name original name
        // and encrypt it with sha1
        $hash = sha1 (
            $this->file->getClientOriginalName()
        );

        // Get the extension of the photo.
        $extension = $this->file->getClientOriginalExtension();

        // Then set name = merge those together.
        return $this->name = "{$hash}.{$extension}";
    }



    /**
     *  Return the full file path of the banner photo, with the name.
     *
     * @return string
     */
    public function filePath() {
        return $this->baseDir() . '/' . $this->name;
        // Ex: 'BannerPhoto/photos/foo.jpg'
    }


    /**
     * Return the full file thumbnail path of the banner photo, with the name.
     *
     * @return string
     */
    public function thumbnailPath() {
        return $this->baseDir() . '/tn-' . $this->name;
        // Ex: 'BannerPhoto/photos/tn-foo.jpg'
    }


    /**
     * Upload the file to the proper directory.
     *
     * @return $this
     */
    public function upload() {
        // move a file to the base directory with the file name.
        $this->file->move($this->baseDir(), $this->name);

        // Make the thumbnail.
        $this->makeThumbnail();

        return $this;
    }


    /**
     * Function to make the actual thumbnail.
     * -- make and save reference the Image intervention library, not Eloquent. --
     */
    protected function makeThumbnail() {
        Image::make($this->filePath())
            ->fit(2000, 800)
            //->resize(null, 400, function ($constraint) {
             //   $constraint->aspectRatio();
             //   $constraint->upsize();
            //})
            ->save($this->thumbnailPath());
    }


    /**
     * Delete the banner photo path and thumbnail path in DB.
     * Access the delete function in FlyerController@destroyBannerPhoto method
     */
    public function delete() {

        $image = $this->path;
        $thumbnail_image = $this->thumbnail_path;

        \File::delete([
            $image,
            $thumbnail_image
        ]);

        parent::delete();
    }


}