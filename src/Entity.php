<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable = [
        'name',
        'model'
    ];

    public function fields()
    {
        return $this->hasMany('Bubalubs\Gravity\EntityField');
    }

    public function getModel()
    {
        return new $this->model;
    }

    public function getModelFromID(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function getDisplayNameAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->name));
    }
}
