@extends('gravity::layouts.main')

@section('content')
    <h4 class="title is-4">New Page</h4>

    <form method="post" action="/admin/pages/create">
        @csrf

        <div class="field">
            <div class="control">
                <input class="input" name="name" type="text" placeholder="Name">
            </div>
        </div>

        <button type="submit" class="button is-primary">Create</button>
    </form>

    <hr>
    
    <h4 class="title is-4">Manage Pages</h4>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Name</th>
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>
                        {{ $page->displayName }}
                    </td>
                    <td>
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <a href="/admin/pages/{{ $page->name }}/fields" class="button">Manage Fields</a>
                            </p>

                            <p class="control">
                                <form method="post" action="/admin/pages/{{ $page->id }}/delete">
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