<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name'];

    public function fields()
    {
        return $this->hasMany('Bubalubs\LaravelGravity\PageField');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }
}
