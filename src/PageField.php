<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;

class PageField extends Model
{
    protected $fillable = [
        'name',
        'type',
        'page_id'
    ];

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }

    public function getDisplayTypeAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->type));
    }
}
