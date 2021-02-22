@extends('gravity::layouts.main')

@section('content')
    <div class="is-pulled-right">
        <a class="button is-info" href="/{{ $page->name }}" target="_blank" v-tooltip="'View this page in new tab'">
            <span class="icon">
                <i class="fas fa-external-link-alt"></i>
            </span>
        </a>
    </div>

    <h4 class="title is-4">Edit Page</h4>
    <h6 class="subtitle is-6">{{ $page->displayName }}</h6>
    
    @if ($page->fields->count())
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
                            <text-editor name="{{ $field->name }}" :value="'{{ addslashes($data[$field->name]) ?? '' }}'"></text-editor>
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

                                    <div class="current-image-container">
                                        <a href="{{ $data[$field->name]->getUrl() ?? '' }}" target="_blank">
                                            <img src="{{ $data[$field->name]->getUrl() ?? '' }}" alt="{{ $data[$field->name]->getUrl() ?? '' }}" style="max-height:100px" v-tooltip="'View full image in new tab'">
                                        </a>
                                    </div>
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
    @else
        <p><em>This page currently has no fields to edit.</em></p>

        @can('use_tools_in_admin')
            <br><a class="button is-primary" href="/admin/pages/{{ $page->name }}/fields">Edit page fields</a>
        @endcan
    @endif
@endsection