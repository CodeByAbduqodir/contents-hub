<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Content</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1>Create New Content</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contents.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="book" {{ old('type') == 'book' ? 'selected' : '' }}>Book</option>
                        <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                </div>

                <div class="col-md-6">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="url" class="form-label">URL (optional):</label>
                    <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}">
                </div>

                <div class="col-md-4">
                    <label for="authors" class="form-label">Authors:</label>
                    <select name="authors[]" id="authors" class="form-select @error('authors') is-invalid @enderror" multiple>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', [])) ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="genres" class="form-label">Genres:</label>
                    <select name="genres[]" id="genres" class="form-select @error('genres') is-invalid @enderror" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="societies" class="form-label">Societies:</label>
                    <select name="societies[]" id="societies" class="form-select @error('societies') is-invalid @enderror" multiple>
                        @foreach ($societies as $society)
                            <option value="{{ $society->id }}" {{ in_array($society->id, old('societies', [])) ? 'selected' : '' }}>
                                {{ $society->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create Content</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>