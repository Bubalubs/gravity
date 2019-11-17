<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name'];

    public function keys()
    {
        return $this->hasMany('Bubalubs\LaravelGravity\PageKey');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords($this->name);
    }
}
