<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'parent_id',
        'published'
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
        return $this->hasMany('Bubalubs\Gravity\Page', 'parent_id')
            ->with('children')
            ->orderBy('order');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }

    public function getUrlAttribute(): string
    {
        return $this->getUrlSegment($this->name, $this->parent);
    }

    private function getUrlSegment($pageName, $parent)
    {
        $url = '/' . $pageName;

        if (!$parent) {
            return $url;
        }

        return $this->getUrlSegment($parent->name, $parent->parent) . $url;
    }
}
