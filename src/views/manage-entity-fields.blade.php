@extends('gravity::layouts.main')

@section('content')
    <a href="/admin/entities" class="button is-info">Back</a>

    <hr>

    <h4 class="title is-4">New Field</h4>

    <form method="post" action="/admin/entities/{{ $entity->name }}/fields/create">
        @csrf

        <div class="field">
            <div class="control">
                <input class="input" name="name" type="text" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <div class="select">
                    <select name="type">
                        <option value="single-line-text">Single Line Text</option>
                        <option value="multi-line-text">Multi Line Text</option>
                        <option value="image">Image</option>
                        <option value="color">Color</option>
                        <option value="url">URL</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="button is-primary">Create</button>
    </form>

    <hr>

    <h4 class="title is-4">Manage Fields</h4>

    <h6 class="subtitle is-6">Entity: {{ $entity->displayName }}</h6>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entity->fields as $field)
                <tr>
                    <td>
                        {{ $field->displayName }}
                    </td>
                    <td>
                        {{ $field->displayType }}
                    </td>
                    <td>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <form method="post" action="/admin/entities/{{ $entity->name }}/fields/{{ $field->id }}/delete">
                                    @csrf
                                    
                                    <input type="hidden" name="_method" value="delete">
                                    
                                    <button type="submit" class="button is-danger">Delete</button>
                                </form>
                            </p>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection