@extends('gravity::layouts.main')

@section('content')
    <a href="/admin/media" class="button is-info">Back</a>

    <hr>

    <div class="is-pulled-right buttons">
        <a href="{{ $media->getPath() }}" title="View Media" class="button is-primary" target="_blank">
            View
        </a>

        <form method="post" action="/admin/media/{{ $media->id }}/delete">
            @csrf
            
            <input type="hidden" name="_method" value="delete">
            
            <button type="submit" class="button is-danger">Delete</button>
        </form>
    </div>

    <h4 class="title is-4">Edit Media</h4>

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">URL</label>
                <input class="input" type="text" value="{{ $media->getPath() }}">
            </div>
        </div>
        <div class="column">
            <strong>Assigned to:</strong>

            @if ($media->model_type == 'Bubalubs\Gravity\MediaLibraryUpload')
                <p>Nothing</p>
            @else
                <p>{{ str_replace('Bubalubs\Gravity\\', '', $media->model_type) }}</p>
                <p>ID: {{ $media->model_id }}</p>
            @endif
        </div>
    </div>

    <hr>

    <div class="has-text-centered">
        <a href="{{ $media->getPath() }}" title="View Media" target="_blank">
            <img src="{{ $media->getPath() }}" alt="">
        </a>
    </div>
@endsection