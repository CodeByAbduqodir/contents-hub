<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <h1>{{ $title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route($route, $entity->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($entity_type === 'author' || $entity_type === 'society')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $entity->name) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="url" class="form-label">URL (optional):</label>
                        <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $entity->url) }}">
                    </div>
                </div>
            @else
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $entity->name) }}">
                    </div>
                </div>
            @endif

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>