<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\Gravity\Entity;
use Bubalubs\Gravity\EntityField;
use Bubalubs\Gravity\PageContent;

class EntityController extends Controller
{
    public function list(string $name)
    {
        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();
        
        $items = $entity->getModel()->all();

        return view('gravity::list-entity')->with(compact(
            'entity',
            'items'
        ));
    }

    public function viewCreateForm(string $name)
    {
        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        return view('gravity::create-entity')->with(compact(
            'entity'
        ));
    }

    public function create(string $name, Request $request)
    {
        $entity = Entity::where('name', $name)->firstOrFail();

        $entityModel = $entity->getModel();

        foreach ($request->except('_token') as $key => $content) {
            $field = EntityField::where('name', $key)
                ->where('entity_id', $entity->id)
                ->firstOrFail();

            if ($field->type == 'image') {
                $entityModel->{$field->name} = '';
            } else {
                if ($field->type == 'checkbox') {
                    $content = $content ? 'true' : 'false';
                }

                $entityModel->{$field->name} = $content;
            }
        }

        $entityModel->save();

        foreach ($request->except('_token') as $key => $content) {
            $field = EntityField::where('name', $key)
                ->where('entity_id', $entity->id)
                ->firstOrFail();

            if ($field->type == 'image') {
                $file = $request->file($field->name);

                if ($file) {
                    $media = $entityModel->addMediaFromRequest($field->name)
                        ->withResponsiveImages()
                        ->toMediaCollection($field->name);

                    $entityModel->{$field->name} = $media->getUrl();
                }
            }
        }

        $entityModel->save();

        return redirect('/admin/entities/' . $name)->with('success', 'Successfully created ' . $entity->displayName);
    }

    public function edit(string $name, int $id)
    {
        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();
        
        $entityModel = $entity->getModelFromID($id);

        $data = [];

        foreach ($entity->fields as $field) {
            $data[$field->name] = $entityModel->{$field->name};
        }

        $id = $entityModel->id;

        return view('gravity::edit-entity')->with(compact(
            'id',
            'entity',
            'data'
        ));
    }

    public function update(string $name, int $id, Request $request)
    {
        $entity = Entity::where('name', $name)->firstOrFail();

        $entityModel = $entity->getModelFromID($id);

        foreach ($request->except('_token') as $key => $content) {
            $field = EntityField::where('name', $key)
                ->where('entity_id', $entity->id)
                ->firstOrFail();

            if ($field->type == 'image') {
                $file = $request->file($field->name);

                if ($file) {
                    $media = $entityModel->addMediaFromRequest($field->name)
                        ->withResponsiveImages()
                        ->toMediaCollection($field->name);

                    $entityModel->{$field->name} = $media->getUrl();
                    $entityModel->save();
                }
            } else {
                if ($field->type == 'checkbox') {
                    $content = $content ? 'true' : 'false';
                }

                $entityModel->{$field->name} = PageContent::sanitize($content);
                $entityModel->save();
            }
        }

        return redirect('/admin/entities/' . $name)->with('success', 'Successfully updated ' . $entity->displayName);
    }

    public function delete(string $name, int $id)
    {
        $entity = Entity::with('fields')
            ->where('name', $name)
            ->firstOrFail();
        
        $entityModel = $entity->getModelFromID($id);

        $entityModel->delete();

        return redirect('/admin/entities/' . $name)->with('success', 'Successfully deleted ' . $entity->displayName);
    }
}
