<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section { margin-bottom: 40px; }
        .form-group { margin-bottom: 15px; }
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

    <h1>Admin Dashboard</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="section">
        <h2>Manage Content</h2>
        <a href="{{ route('contents.create') }}">Add New Content</a>
        @if ($contents->isEmpty())
            <p>No content found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>URL</th>
                        <th>Authors</th>
                        <th>Genres</th>
                        <th>Societies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                        <tr>
                            <td>{{ $content->type }}</td>
                            <td>{{ $content->title }}</td>
                            <td>{{ $content->description ?? 'N/A' }}</td>
                            <td>{{ $content->url ?? 'N/A' }}</td>
                            <td>{{ $content->authors->pluck('name')->implode(', ') }}</td>
                            <td>{{ $content->genres->pluck('name')->implode(', ') }}</td>
                            <td>{{ $content->societies->pluck('name')->implode(', ') }}</td>
                            <td>
                                <a href="{{ route('contents.show', $content->id) }}">View</a> |
                                <a href="{{ route('contents.edit', $content->id) }}">Edit</a> |
                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $contents->links() }}
        @endif
    </div>

    <div class="section">
        <h2>Manage Authors</h2>
        <form action="{{ route('admin.authors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="author_name">Name:</label>
                <input type="text" name="name" id="author_name" required>
            </div>
            <div class="form-group">
                <label for="author_url">URL (optional):</label>
                <input type="url" name="url" id="author_url">
            </div>
            <button type="submit">Add Author</button>
        </form>

        @if ($authors->isEmpty())
            <p>No authors found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->url ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $authors->links() }}
        @endif
    </div>

    <div class="section">
        <h2>Manage Genres</h2>
        <form action="{{ route('admin.genres.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="genre_name">Name:</label>
                <input type="text" name="name" id="genre_name" required>
            </div>
            <button type="submit">Add Genre</button>
        </form>

        @if ($genres->isEmpty())
            <p>No genres found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $genre->name }}</td>
                            <td>
                                <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $genres->links() }}
        @endif
    </div>

    <div class="section">
        <h2>Manage Societies</h2>
        <form action="{{ route('admin.societies.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="society_name">Name:</label>
                <input type="text" name="name" id="society_name" required>
            </div>
            <div class="form-group">
                <label for="society_url">URL (optional):</label>
                <input type="url" name="url" id="society_url">
            </div>
            <button type="submit">Add Society</button>
        </form>

        @if ($societies->isEmpty())
            <p>No societies found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($societies as $society)
                        <tr>
                            <td>{{ $society->name }}</td>
                            <td>{{ $society->url ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.societies.destroy', $society->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $societies->links() }}
        @endif
    </div>

    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>