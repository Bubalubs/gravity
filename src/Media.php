<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Media extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $appends = [
        'path'
    ];

    public function getPath()
    {
        return url('storage/' . $this->id . '/' . $this->file_name);
    }

    public function getPathAttribute()
    {
        return $this->getPath();    
    }
}
