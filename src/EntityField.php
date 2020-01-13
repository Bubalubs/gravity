<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;

class EntityField extends Model
{
    protected $fillable = [
        'entity_id',
        'name',
        'type'
    ];

    public function fields()
    {
        return $this->hasMany('Bubalubs\Gravity\EntityField');
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
