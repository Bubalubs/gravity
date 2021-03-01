@extends('gravity::layouts.main')

@section('content')
    <a href="/admin/users" class="button is-info">Back</a>

    <hr>

    <h4 class="title is-4">Edit User</h4>
    <h6 class="subtitle is-6">{{ $user->email }} ({{ $user->name }})</h6>

    <form method="post" action="/admin/users/{{ $user->id }}/update" enctype="multipart/form-data">
        @csrf
        
        <div class="field">
            <label class="label">Set New Password</label>
            <div class="control">
                <input class="input" name="password" type="password" placeholder="New Password">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="access_admin" value="1" {{ $user->can('access_admin') ? 'checked' : '' }}>
                    Can access admin
                </label>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="edit_entities_in_admin" value="1" {{ $user->can('edit_entities_in_admin') ? 'checked' : '' }}>
                    Can edit entities
                </label>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="edit_page_content_in_admin" value="1" {{ $user->can('edit_page_content_in_admin') ? 'checked' : '' }}>
                    Can edit page content
                </label>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="edit_global_content_in_admin" value="1" {{ $user->can('edit_global_content_in_admin') ? 'checked' : '' }}>
                    Can edit global content
                </label>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="manage_users_in_admin" value="1" {{ $user->can('manage_users_in_admin') ? 'checked' : '' }}>
                    Can manage users
                </label>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="use_tools_in_admin" value="1" {{ $user->can('use_tools_in_admin') ? 'checked' : '' }}>
                    Can use advanced tools
                </label>
            </div>
        </div>

        <button type="submit" class="button is-primary">Update</button>
    </form>
@endsection