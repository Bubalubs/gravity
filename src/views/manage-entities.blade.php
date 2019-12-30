@extends('gravity::layouts.main')

@section('content')
    <h4 class="title is-4">New Entity</h4>

    <form method="post" action="/admin/entities/create">
        @csrf

        <div class="field">
            <div class="control">
                <input class="input" name="name" type="text" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <input class="input" name="model" type="text" placeholder="Model">
            </div>
        </div>

        <button type="submit" class="button is-primary">Create</button>
    </form>

    <hr>
    
    <h4 class="title is-4">Manage Entities</h4>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Model</th>
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entities as $entity)
                <tr>
                    <td>
                        {{ $entity->displayName }}
                    </td>
                    <td>
                        {{ $entity->model }}
                    </td>
                    <td>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <a href="/admin/entities/{{ $entity->name }}/fields" class="button">Manage Fields</a>
                            </p>

                            <p class="control">
                                <form method="post" action="/admin/entities/{{ $entity->id }}/delete">
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