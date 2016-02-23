<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToTravelFlyer {

    /**
     * @var Flyer
     */
    protected $flyer;


    /**
     * The UploadedFile Instance.
     *
     * @var UploadedFile
     */
    protected $file;


    /**
     * Create a new AddPhotoToTravelFlyer form object.
     *
     * @param Flyer $flyer
     * @param UploadedFile $file
     * @param Thumbnail|null $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null) {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }


    /**
     * Process the form.
     */
    public function save() {

        // Attach the photo to the flyer.
        $photo = $this->flyer->addPhoto($this->makePhoto());

        // move a file to the base directory with the file name.
        $this->file->move($photo->baseDir(), $photo->name);

        // Generate a photo thumbnail.
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }


    /**
     * Make a new Photo Instance.
     *
     * @return FlyerPhoto
     */
    protected function makePhoto() {
       return new FlyerPhoto(['name' => $this->makeFilename()]);
    }


    /**
     * Make a Filename, based on the uploaded file.
     *
     * @return string
     */
    protected function makeFilename() {

        // Get the file name original name
        // and encrypt it with sha1
        $name = sha1 (
            time() . $this->file->getClientOriginalName()
        );

        // Get the extension of the photo.
        $extension = $this->file->getClientOriginalExtension();

        // Then set name = merge those together.
        return "{$name}.{$extension}";
    }

}