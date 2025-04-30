<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contents Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Contents Hub</h1>
            <div>
                @auth
                    <span class="text-white mr-4">Welcome, {{ Auth::user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-200">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <form method="GET" action="{{ route('home') }}">
                <div class="flex flex-wrap gap-4">
                    <!-- Dropdown для Type -->
                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open = !open" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                            Type <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="dropdown-menu absolute mt-2 w-48 bg-white rounded-lg shadow-lg z-10">
                            <div class="p-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type:</label>
                                <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" @change="open = false; $el.closest('form').submit()">
                                    <option value="">All</option>
                                    <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                                    <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Book</option>
                                    <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open = !open" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                            Authors <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="dropdown-menu absolute mt-2 w-48 bg-white rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                            <div class="p-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Authors:</label>
                                <select name="authors[]" id="authors" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" multiple @change="open = false; $el.closest('form').submit()">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}" {{ in_array($author->id, request('authors', [])) ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open = !open" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                            Genres <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="dropdown-menu absolute mt-2 w-48 bg-white rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                            <div class="p-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Genres:</label>
                                <select name="genres[]" id="genres" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" multiple @change="open = false; $el.closest('form').submit()">
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open = !open" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                            Societies <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="dropdown-menu absolute mt-2 w-48 bg-white rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                            <div class="p-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Societies:</label>
                                <select name="societies[]" id="societies" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" multiple @change="open = false; $el.closest('form').submit()">
                                    @foreach ($societies as $society)
                                        <option value="{{ $society->id }}" {{ in_array($society->id, request('societies', [])) ? 'selected' : '' }}>
                                            {{ $society->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="btn-secondary px-4 py-2 rounded-md">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        @auth
            <a href="{{ route('contents.create') }}" class="btn-success inline-block px-4 py-2 rounded-md mb-4">Add New Content</a>
        @endauth

        @if ($contents->isEmpty())
            <p class="text-gray-600">No content found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($contents as $content)
                    <div class="card p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $content->title }}</h3>
                        <p class="text-gray-600 mb-2"><strong>Type:</strong> {{ $content->type }}</p>
                        <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $content->description ?? 'N/A' }}</p>
                        @if ($content->url)
                            <p class="text-gray-600 mb-2"><strong>URL:</strong> <a href="{{ $content->url }}" class="text-blue-600 hover:underline" target="_blank">{{ $content->url }}</a></p>
                        @endif
                        <p class="text-gray-600 mb-2"><strong>Authors:</strong> {{ $content->authors->pluck('name')->implode(', ') }}</p>
                        <p class="text-gray-600 mb-2"><strong>Genres:</strong> {{ $content->genres->pluck('name')->implode(', ') }}</p>
                        <p class="text-gray-600 mb-4"><strong>Societies:</strong> {{ $content->societies->pluck('name')->implode(', ') }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('contents.show', $content->id) }}" class="btn-primary px-3 py-1 rounded-md">View</a>
                            @auth
                                <a href="{{ route('contents.edit', $content->id) }}" class="btn-primary bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</a>
                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger px-3 py-1 rounded-md" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-center">
                {{ $contents->appends(request()->query())->links('pagination::custom') }}
            </div>
        @endif

        @auth
            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="btn-primary inline-block px-4 py-2 rounded-md">Go to Admin Dashboard</a>
            </div>
        @endauth
    </div>
</body>
</html>