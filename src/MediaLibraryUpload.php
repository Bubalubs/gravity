<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * A Media object without an assigned model
 */
class MediaLibraryUpload extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function getPath()
    {
        return url('storage/' . $this->id . '/' . $this->file_name);
    }
}
