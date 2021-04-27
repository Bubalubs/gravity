@extends('gravity::layouts.main')

@section('content')
    <h4 class="title is-4">Upload Media</h4>

    <form method="post" action="/admin/media/create" enctype="multipart/form-data">
        @csrf

        <div class="field">
            <label class="label">File</label>
            <div class="control">
                <input class="input" name="file" type="file">
            </div>
        </div>

        <button type="submit" class="button is-primary">Upload</button>
    </form>

    <hr>
    
    <h4 class="title is-4">Media Library</h4>

    <div class="media-library">
        @foreach ($mediaLibrary as $media)
            <div class="preview-box">
                <a href="/admin/media/{{ $media->id }}" title="{{ $media->file_name }}">
                    @if (str_contains($media->mime_type, 'image'))
                        <img style="max-height:100px;max-width:100px;" src="{{ $media->getPath() }}" alt="">
                    @else
                        <div class="text-label">{{ $media->file_name }}</div>
                    @endif
                </a>
            </div>
        @endforeach
    </div>
@endsection