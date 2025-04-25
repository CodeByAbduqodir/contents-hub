<!DOCTYPE html>
<html>
<head>
    <title>Create Content</title>
    <style>
        .auth-links { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="auth-links">
        @auth
            <span>Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>

    <h1>Create New Content</h1>

    <form action="{{ route('contents.store') }}" method="POST">
        @csrf

        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="video">Video</option>
                <option value="book">Book</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="url">URL:</label>
            <input type="url" name="url" id="url">
        </div>

        <div>
            <label for="authors">Authors:</label>
            <select name="authors[]" id="authors" multiple required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="genres">Genres:</label>
            <select name="genres[]" id="genres" multiple required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="societies">Societies:</label>
            <select name="societies[]" id="societies" multiple required>
                @foreach ($societies as $society)
                    <option value="{{ $society->id }}">{{ $society->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Create</button>
    </form>

    <a href="{{ route('contents.index') }}">Back to List</a>
</body>
</html>