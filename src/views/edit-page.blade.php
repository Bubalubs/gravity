<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    </head>
    <body>
        <section class="section">
            <div class="container">
                <h2 class="title is-2">
                    <a href="/admin">
                        {{ config('app.name') }}
                    </a>
                </h2>

                <div class="columns">
                    <div class="column is-2">
                        @include('laravel-gravity::partials.sidebar')
                    </div>
                    <div class="column is-10">
                        <h4 class="title is-4">Edit Page</h4>

                        <h6 class="subtitle is-6">Page: {{ $page->name }}</h6>

                        <form method="post" action="/admin/pages/{{ $page->name }}/update" enctype="multipart/form-data">
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
                                            <textarea class="textarea" name="{{ $field->name }}" placeholder="{{ $field->displayName }}">{{ $data[$field->name] ?? '' }}</textarea>
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
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>