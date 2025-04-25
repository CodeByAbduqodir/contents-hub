<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
</head>
<body>
    <h1>Edit Content: {{ $content->title }}</h1>

    <form action="{{ route('contents.update', $content->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="video" {{ $content->type == 'video' ? 'selected' : '' }}>Video</option>
                <option value="book" {{ $content->type == 'book' ? 'selected' : '' }}>Book</option>
                <option value="audio" {{ $content->type == 'audio' ? 'selected' : '' }}>Audio</option>
            </select>
        </div>

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $content->title }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $content->description }}</textarea>
        </div>

        <div>
            <label for="url">URL:</label>
            <input type="url" name="url" id="url" value="{{ $content->url }}">
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('contents.index') }}">Back to List</a>
</body>
</html>