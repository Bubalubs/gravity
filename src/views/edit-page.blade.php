@extends('laravel-gravity::layouts.main')

@section('content')
    <h4 class="title is-4">Edit Page</h4>

    <h6 class="subtitle is-6">{{ $page->name }}</h6>

    <form method="post" action="/admin/pages/{{ $page->name }}/update" enctype="multipart/form-data">
        @csrf

        @foreach($page->fields as $field)
            @if ($field->type == 'single-line-text')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <input class="input" name="{{ $field->name }}" type="text" placeholder="{{ $field->displayName }}" value="{{ $data[$field->name] ?? '' }}">
                    </div>
                </div>
            @endif
            @if ($field->type == 'multi-line-text')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <text-editor name="{{ $field->name }}" :value="'{{ $data[$field->name] ?? '' }}'"></text-editor>
                    </div>
                </div>
            @endif
            @if ($field->type == 'color')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <input class="input" name="{{ $field->name }}" type="text" placeholder="{{ $field->displayName }}" value="{{ $data[$field->name] ?? '' }}">
                    </div>
                </div>
            @endif
            @if ($field->type == 'image')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <input class="input" name="{{ $field->name }}" type="file">
                    </div>
                    {{ $data[$field->name] ?? '' }}
                </div>
            @endif
        @endforeach

        <button type="submit" class="button is-primary">Update</button>
    </form>
@endsection