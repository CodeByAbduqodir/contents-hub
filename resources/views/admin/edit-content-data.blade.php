<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .auth-links { margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
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

    <h1>{{ $title }}</h1>

    <form action="{{ route($route, $entity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $entity->name }}" required>
        </div>

        @if ($entity_type === 'author' || $entity_type === 'society')
            <div class="form-group">
                <label for="url">URL (optional):</label>
                <input type="url" name="url" id="url" value="{{ $entity->url }}">
            </div>
        @endif

        <button type="submit">Update {{ ucfirst($entity_type) }}</button>
    </form>

    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
</body>
</html>