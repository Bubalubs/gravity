<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;

class PageField extends Model
{
    protected $fillable = [
        'name',
        'type',
        'page_id',
        'is_global'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($pageField) {
            foreach ($pageField->content as $pageContent) {
                $pageContent->delete();
            }

            return true;
        });
    }

    public function content()
    {
        return $this->hasMany('Bubalubs\LaravelGravity\PageContent');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }

    public function getDisplayTypeAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->type));
    }
}
