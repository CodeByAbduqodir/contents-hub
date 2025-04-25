<!DOCTYPE html>
<html>
<head>
    <title>View Content</title>
</head>
<body>
    <h1>{{ $content->title }}</h1>

    <p><strong>Type:</strong> {{ $content->type }}</p>
    <p><strong>Description:</strong> {{ $content->description ?? 'N/A' }}</p>
    <p><strong>URL:</strong> {{ $content->url ?? 'N/A' }}</p>
    <p><strong>Authors:</strong> {{ $content->authors->pluck('name')->implode(', ') }}</p>
    <p><strong>Genres:</strong> {{ $content->genres->pluck('name')->implode(', ') }}</p>
    <p><strong>Societies:</strong> {{ $content->societies->pluck('name')->implode(', ') }}</p>

    <a href="{{ route('contents.index') }}">Back to List</a>
</body>
</html>