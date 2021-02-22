<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Page extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    protected $appends = [
        'display_name'
    ];

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
        return $this->hasMany('Bubalubs\Gravity\PageField');
    }

    public function parent()
    {
        return $this->belongsTo('Bubalubs\Gravity\Page', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Bubalubs\Gravity\Page', 'parent_id')->with('children');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }
}
