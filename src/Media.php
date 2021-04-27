<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Media extends Model implements HasMedia
{
    use HasMediaTrait;

    public function getPath()
    {
        return url('storage/' . $this->id . '/' . $this->file_name);
    }
}
