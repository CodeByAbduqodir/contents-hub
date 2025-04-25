<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
    <style>
        .auth-links { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="auth-links">
        @auth
            <span>Welcome, {{ Auth::user()->name }}!</span>
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a> |
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>

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

        <div>
            <label for="authors">Authors:</label>
            <select name="authors[]" id="authors" multiple required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ $content->authors->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="genres">Genres:</label>
            <select name="genres[]" id="genres" multiple required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $content->genres->contains($genre->id) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="societies">Societies:</label>
            <select name="societies[]" id="societies" multiple required>
                @foreach ($societies as $society)
                    <option value="{{ $society->id }}" {{ $content->societies->contains($society->id) ? 'selected' : '' }}>
                        {{ $society->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('contents.index') }}">Back to List</a>
</body>
</html>