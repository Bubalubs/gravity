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

        <div class="field">
            <label class="label">Parent</label>
            <div class="control">
                <div class="select">
                    <select name="parent_id">
                        <option value="">- None -</option>

                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->displayName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="button is-primary">Create</button>
    </form>

    <hr>
    
    <h4 class="title is-4">Manage Pages</h4>

    <manage-pages-list></manage-pages-list>
@endsection