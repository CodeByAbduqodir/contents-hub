<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            @auth
                <span>Welcome, {{ Auth::user()->name }}!</span>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary me-2">Admin Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
            @endauth
        </div>

        <h1 class="mb-4">Content Hub </h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('home') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-select">
                        <option value="">All</option>
                        <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Book</option>
                        <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="authors" class="form-label">Authors:</label>
                    <select name="authors[]" id="authors" class="form-select" multiple>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ in_array($author->id, request('authors', [])) ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="genres" class="form-label">Genres:</label>
                    <select name="genres[]" id="genres" class="form-select" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="societies" class="form-label">Societies:</label>
                    <select name="societies[]" id="societies" class="form-select" multiple>
                        @foreach ($societies as $society)
                            <option value="{{ $society->id }}" {{ in_array($society->id, request('societies', [])) ? 'selected' : '' }}>
                                {{ $society->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @auth
            <div class="mb-3">
                <a href="{{ route('contents.create') }}" class="btn btn-primary">Add New Content</a>
            </div>
        @endauth

        @if ($contents->isEmpty())
            <p class="text-muted">No content found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
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
                                    <a href="{{ route('contents.show', $content->id) }}" class="btn btn-sm btn-info">View</a>
                                    @auth
                                        <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $contents->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</body>
</html>