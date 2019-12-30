<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Entity;
use Bubalubs\Gravity\EntityField;

class EntityFieldsController extends Controller
{    
    public function edit(string $name)
    {
        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        return view('gravity::manage-entity-fields')->with(compact(
            'entity'
        ));
    }

    public function create(string $name, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'type' => 'required|in:single-line-text,multi-line-text,image,color,url'
        ]);

        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');
        $data['entity_id'] = $entity->id;

        EntityField::create($data);

        return redirect('/admin/entities/' . $name . '/fields')->with('success', 'Successfully created field');
    }

    public function delete(string $name, int $fieldID)
    {
        EntityField::findOrFail($fieldID)->delete();

        return redirect('/admin/entities/' . $name . '/fields')->with('success', 'Successfully deleted field');
    }
}