<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($page) {
            foreach ($page->fields as $field) {
                $field->delete();
            }

            return true;
        });
    }

    public function fields()
    {
        return $this->hasMany('Bubalubs\LaravelGravity\PageField');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }
}
