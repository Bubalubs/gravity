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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            Storage::delete($image->path);

            return true;
        });
    }
}
