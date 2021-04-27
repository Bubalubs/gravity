<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * A Media object without an assigned model
 */
class MediaLibraryUpload extends Model implements HasMedia
{
    use HasMediaTrait;

    public function getPath()
    {
        return url('storage/' . $this->id . '/' . $this->file_name);
    }
}
