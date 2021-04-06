<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;

class PageTemplate extends Model
{
    protected $fillable = [
        'name',
        'view'
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
}
