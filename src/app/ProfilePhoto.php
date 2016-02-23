<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfilePhoto extends Model {

    /**
     * @var string
     * The associated table.
     */
    protected $table = "profile_photos";

    /**
     * Fillable fields for a photo.
     * @var array
     */
    protected $fillable = ['name', 'path', 'thumbnail_path'];

    /**
     * @var
     * The UploadedFile instance.
     */
    protected $file;

    /**
     * @var
     * The file name instance.
     */
    protected $name;


    /**
     * A profile photo belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }


    /**
     * Make a new instance from an uploaded file.
     *
     * @param UploadedFile $file
     * @return static
     */
    public static function fromFile(UploadedFile $file) {
        // Make a new instance.
        $photo = new static;

        // Assign the Uploaded file to the $file object.
        $photo->file = $file;

        // Set $photo to the fill properties, which are
        // the name, path, and thumbnail path of a photo.
        $photo->fill([
            'name' =>  $photo->setFileName(),
            'path' =>  $photo->filePath(),
            'thumbnail_path' =>  $photo->thumbnailPath()
        ]);

        // Then return the photo.
        return $photo;
    }


    /**
     * Get the profile photos base directory.
     *
     * @return string
     */
    public function baseDir() {
        return 'src/public/ProfilePhotos/photos';
    }


    /**
     * This function gets the name and extension of a photo.
     *
     * @return string
     */
    public function setFileName() {

        // hash the name of the file with the $t function.
        $hash  = sha1(
            $this->file->getClientOriginalName()
        );

        // Get the extension of the photo.
        $extension = $this->file->getClientOriginalExtension();

        // Then set name = merge those together.
        return $this->name = "{$hash}.{$extension}";
    }


    /**
     * Get the full file path of the photo, with the name.
     *
     * @return string
     */
    public function filePath() {
        return $this->baseDir() . '/' . $this->name;
        // Ex: 'ProfilePhotos/photos/foo.jpg'
    }


    /**
     * Get the full file thumbnail path of the photo, with the name.
     *
     * @return string
     */
    public function thumbnailPath() {
        return $this->baseDir() . '/tn-' . $this->name;
        // Ex: 'ProfilePhotos/photos/tn-foo.jpg'
    }


    /**
     * Upload the file to the proper directory.
     *
     * @return $this
     */
    public function upload() {

        // Move the file instance to the base directory with the file name.
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
        Image::make($this->filePath())->fit(200)->save($this->thumbnailPath());
    }


    /**
     * Delete the profile photo path and thumbnail path in DB.
     * Access the delete function in ProfileController@destroyPhoto method
     *
     * @throws \Exception
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