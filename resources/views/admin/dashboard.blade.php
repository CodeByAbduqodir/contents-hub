<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
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

        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Content</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <div class="flex flex-wrap gap-4">
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
                                        @foreach ($allAuthors as $author)
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
                                        @foreach ($allGenres as $genre)
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
                                        @foreach ($allSocieties as $society)
                                            <option value="{{ $society->id }}" {{ in_array($society->id, request('societies', [])) ? 'selected' : '' }}>
                                                {{ $society->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="btn-secondary px-4 py-2 rounded-md">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <a href="{{ route('contents.create') }}" class="btn-success inline-block px-4 py-2 rounded-md mb-4">Add New Content</a>

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
                                <a href="{{ route('contents.edit', $content->id) }}" class="btn-primary bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</a>
                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger px-3 py-1 rounded-md" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-center">
                    {{ $contents->appends(request()->query())->links('pagination::custom') }}
                </div>
            @endif
        </div>

        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Authors</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.authors.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="author_name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                            <input type="text" name="name" id="author_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label for="author_url" class="block text-sm font-medium text-gray-700 mb-1">URL (optional):</label>
                            <input type="url" name="url" id="author_url" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror" value="{{ old('url') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn-success px-4 py-2 rounded-md">Add Author</button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($authors->isEmpty())
                <p class="text-gray-600">No authors found.</p>
            @else
                <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($authors as $author)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $author->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $author->url ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button x-data="{ open: false }" @click="open = true" class="btn-primary bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</button>
                                        <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger px-3 py-1 rounded-md" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>

                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
                                            <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
                                            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative border border-[#d4af37]">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Author: {{ $author->name }}</h3>
                                                <form action="{{ route('admin.authors.update', $author->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="author_name_{{ $author->id }}" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                                                        <input type="text" name="name" id="author_name_{{ $author->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name', $author->name) }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="author_url_{{ $author->id }}" class="block text-sm font-medium text-gray-700 mb-1">URL (optional):</label>
                                                        <input type="url" name="url" id="author_url_{{ $author->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror" value="{{ old('url', $author->url) }}">
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Update</button>
                                                        <button type="button" @click="open = false" class="btn-secondary px-4 py-2 rounded-md">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 flex justify-center">
                    {{ $authors->links('pagination::custom') }}
                </div>
            @endif
        </div>

        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Genres</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.genres.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="genre_name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                            <input type="text" name="name" id="genre_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn-success px-4 py-2 rounded-md">Add Genre</button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($genres->isEmpty())
                <p class="text-gray-600">No genres found.</p>
            @else
                <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($genres as $genre)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $genre->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button x-data="{ open: false }" @click="open = true" class="btn-primary bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</button>
                                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger px-3 py-1 rounded-md" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>

                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
                                            <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
                                            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative border border-[#d4af37]">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Genre: {{ $genre->name }}</h3>
                                                <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="genre_name_{{ $genre->id }}" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                                                        <input type="text" name="name" id="genre_name_{{ $genre->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name', $genre->name) }}">
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Update</button>
                                                        <button type="button" @click="open = false" class="btn-secondary px-4 py-2 rounded-md">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 flex justify-center">
                    {{ $genres->links('pagination::custom') }}
                </div>
            @endif
        </div>

        <div class="mb-12">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Societies</h2>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.societies.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="society_name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                            <input type="text" name="name" id="society_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label for="society_url" class="block text-sm font-medium text-gray-700 mb-1">URL (optional):</label>
                            <input type="url" name="url" id="society_url" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror" value="{{ old('url') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn-success px-4 py-2 rounded-md">Add Society</button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($societies->isEmpty())
                <p class="text-gray-600">No societies found.</p>
            @else
                <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($societies as $society)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $society->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $society->url ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button x-data="{ open: false }" @click="open = true" class="btn-primary bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</button>
                                        <form action="{{ route('admin.societies.destroy', $society->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger px-3 py-1 rounded-md" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>

                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
                                            <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
                                            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative border border-[#d4af37]">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Society: {{ $society->name }}</h3>
                                                <form action="{{ route('admin.societies.update', $society->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="society_name_{{ $society->id }}" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                                                        <input type="text" name="name" id="society_name_{{ $society->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" value="{{ old('name', $society->name) }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="society_url_{{ $society->id }}" class="block text-sm font-medium text-gray-700 mb-1">URL (optional):</label>
                                                        <input type="url" name="url" id="society_url_{{ $society->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror" value="{{ old('url', $society->url) }}">
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button type="submit" class="btn-primary px-4 py-2 rounded-md">Update</button>
                                                        <button type="button" @click="open = false" class="btn-secondary px-4 py-2 rounded-md">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 flex justify-center">
                    {{ $societies->links('pagination::custom') }}
                </div>
            @endif
        </div>

        <div class="mb-6">
            <a href="{{ route('home') }}" class="btn-secondary px-4 py-2 rounded-md">Back to Home</a>
        </div>
    </div>
</body>
</html>