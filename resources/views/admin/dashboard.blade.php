<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            @auth
                <span>Welcome, {{ Auth::user()->name }}!</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
            @endauth
        </div>

        <h1 class="mb-4">Admin Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-5">
            <h2 class="mb-3">Manage Content</h2>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
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
                            @foreach ($allAuthors as $author)
                                <option value="{{ $author->id }}" {{ in_array($author->id, request('authors', [])) ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="genres" class="form-label">Genres:</label>
                        <select name="genres[]" id="genres" class="form-select" multiple>
                            @foreach ($allGenres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="societies" class="form-label">Societies:</label>
                        <select name="societies[]" id="societies" class="form-select" multiple>
                            @foreach ($allSocieties as $society)
                                <option value="{{ $society->id }}" {{ in_array($society->id, request('societies', [])) ? 'selected' : '' }}>
                                    {{ $society->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <a href="{{ route('contents.create') }}" class="btn btn-primary mb-3">Add New Content</a>
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
                                        <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
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

        <div class="mb-5">
            <h2 class="mb-3">Manage Authors</h2>
            <form action="{{ route('admin.authors.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="author_name" class="form-label">Name:</label>
                        <input type="text" name="name" id="author_name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="author_url" class="form-label">URL (optional):</label>
                        <input type="url" name="url" id="author_url" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success">Add Author</button>
                    </div>
                </div>
            </form>

            @if ($authors->isEmpty())
                <p class="text-muted">No authors found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
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
                                        <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $authors->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        <div class="mb-5">
            <h2 class="mb-3">Manage Genres</h2>
            <form action="{{ route('admin.genres.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="genre_name" class="form-label">Name:</label>
                        <input type="text" name="name" id="genre_name" class="form-control" required>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success">Add Genre</button>
                    </div>
                </div>
            </form>

            @if ($genres->isEmpty())
                <p class="text-muted">No genres found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
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
                                        <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $genres->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        <div class="mb-5">
            <h2 class="mb-3">Manage Societies</h2>
            <form action="{{ route('admin.societies.store') }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="society_name" class="form-label">Name:</label>
                        <input type="text" name="name" id="society_name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="society_url" class="form-label">URL (optional):</label>
                        <input type="url" name="url" id="society_url" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success">Add Society</button>
                    </div>
                </div>
            </form>

            @if ($societies->isEmpty())
                <p class="text-muted">No societies found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
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
                                        <a href="{{ route('admin.societies.edit', $society->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.societies.destroy', $society->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $societies->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>