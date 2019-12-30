<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Entity;

class EntitiesController extends Controller
{    
    public function manage()
    {
        $entities = Entity::all();

        return view('gravity::manage-entities')->with(compact(
            'entities'
        ));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60|unique:entities,name',
        ]);

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');

        Entity::create($data);

        return redirect('/admin/entities')->with('success', 'Successfully created entity');
    }

    public function delete(int $id)
    {
        $entity = Entity::findOrFail($id);

        $entity->delete();

        return redirect('/admin/entities')->with('success', 'Successfully deleted entity');
    }
}
