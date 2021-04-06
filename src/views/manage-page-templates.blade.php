@extends('gravity::layouts.main')

@section('content')
    <h4 class="title is-4">New Page Template</h4>

    <form method="post" action="/admin/page-templates/create">
        @csrf

        <div class="field">
            <div class="control">
                <input class="input" name="name" type="text" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <input class="input" name="view" type="text" placeholder="View">
            </div>
        </div>

        <button type="submit" class="button is-primary">Create</button>
    </form>

    <hr>

    <h4 class="title is-4">Manage Page Templates</h4>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Name</th>
                <th>View</th>
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pageTemplates as $template)
                <tr>
                    <td>
                        {{ $template->name }}
                    </td>
                    <td>
                        {{ $template->view }}
                    </td>
                    <td>
                        <div class="field is-grouped is-grouped-right">
                            <a href="/admin/page-templates/{{ $template->id }}/fields" class="button">Manage Fields</a>

                            <p class="control">
                                <form method="post" action="/admin/page-templates/{{ $template->id }}/delete">
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