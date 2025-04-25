<!DOCTYPE html>
<html>
<head>
    <title>Content List</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions { margin-top: 10px; }
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

    <h1>Content List</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <div class="actions">
            <a href="{{ route('contents.create') }}">Add New Content</a>
        </div>
    @endauth

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
                            <a href="{{ route('contents.show', $content->id) }}">View</a>
                            @auth
                                | <a href="{{ route('contents.edit', $content->id) }}">Edit</a> |
                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $contents->links() }}
    @endif

    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>