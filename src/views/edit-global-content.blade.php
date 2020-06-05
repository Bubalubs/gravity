@extends('gravity::layouts.main')

@section('content')
    <h4 class="title is-4">Edit Global Content</h4>

    <form method="post" action="/admin/global/update" enctype="multipart/form-data">
        @csrf

        @foreach($globalPageFields as $field)
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

            @if ($field->type == 'image')
                <div class="field">
                    <div class="columns">
                        <div class="column">
                            <label class="label">{{ $field->displayName }}</label>
                            <div class="control">
                                <input class="input" name="{{ $field->name }}" type="file">
                            </div>
                        </div>
                        @if (isset($data[$field->name]))
                            <div class="column">
                                <h6 class="title is-6">Current</h6>

                                <a href="{{ $data[$field->name] ?? '' }}" target="_blank">
                                    <img src="{{ $data[$field->name] ?? '' }}" alt="{{ $data[$field->name] ?? '' }}" style="max-height:100px">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if ($field->type == 'color')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <color-picker name="{{ $field->name }}" :value="'{{ $data[$field->name] ?? '' }}'"></color-picker>
                    </div>
                </div>
            @endif
            
            @if ($field->type == 'url')
                <div class="field">
                    <label class="label">{{ $field->displayName }}</label>
                    <div class="control">
                        <input class="input" name="{{ $field->name }}" type="url" placeholder="{{ $field->displayName }}" value="{{ $data[$field->name] ?? '' }}">
                    </div>
                </div>
            @endif

            @if ($field->type == 'checkbox')
                <div class="field">
                    <label class="checkbox">
                        <input type="hidden" name="{{ $field->name }}" value="0">
                        <input type="checkbox" name="{{ $field->name }}"{{ isset($data[$field->name]) && $data[$field->name] == 'true' ? ' checked' : '' }}>
                        {{ $field->displayName }}
                    </label>
                </div>
            @endif
        @endforeach

        <button type="submit" class="button is-primary">Update</button>
    </form>
@endsection