@extends('gravity::layouts.main')

@section('content')
    <div class="is-pulled-right">
        <a href="/admin/entities/{{ $entity->name }}/create" class="button is-primary">Create</a>
    </div>

    <h4 class="title is-4">{{ $entity->displayName }}</h4>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                @foreach($entity->fields as $field)
                    <th>
                        {{ $field->displayName }}
                    </th>
                @endforeach
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @foreach($entity->fields as $field)
                        <td>
                            {{ $item->{$field->name} }}
                        </td>
                    @endforeach
                    <td>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <a href="/admin/entities/{{ $entity->name }}/{{ $item->id }}" class="button">Edit</a>
                            </p>

                            <p class="control">
                                <form method="post" action="/admin/entities/{{ $entity->name }}/{{ $item->id }}/delete">
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