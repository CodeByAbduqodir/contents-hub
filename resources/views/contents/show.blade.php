<!DOCTYPE html>
<html>
<head>
    <title>View Content</title>
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

    <h1>{{ $content->title }}</h1>

    <p><strong>Type:</strong> {{ $content->type }}</p>
    <p><strong>Description:</strong> {{ $content->description ?? 'N/A' }}</p>
    <p><strong>URL:</strong> {{ $content->url ?? 'N/A' }}</p>
    <p><strong>Authors:</strong> {{ $content->authors->pluck('name')->implode(', ') }}</p>
    <p><strong>Genres:</strong> {{ $content->genres->pluck('name')->implode(', ') }}</p>
    <p><strong>Societies:</strong> {{ $content->societies->pluck('name')->implode(', ') }}</p>

    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>