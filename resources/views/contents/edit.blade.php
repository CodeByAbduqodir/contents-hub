<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto mt-8 px-4">
        <div class="bg-white p-8 rounded-lg shadow-md border border-[#d4af37]">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Content: {{ $content->title }}</h1>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contents.update', $content->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type:</label>
                        <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('type') border-red-500 @enderror">
                            <option value="video" {{ old('type', $content->type) == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="book" {{ old('type', $content->type) == 'book' ? 'selected' : '' }}>Book</option>
                            <option value="audio" {{ old('type', $content->type) == 'audio' ? 'selected' : '' }}>Audio</option>
                        </select>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title:</label>
                        <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" value="{{ old('title', $content->title) }}">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                        <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $content->description) }}</textarea>
                    </div>

                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL (optional):</label>
                        <input type="url" name="url" id="url" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('url') border-red-500 @enderror" value="{{ old('url', $content->url) }}">
                    </div>

                    <div>
                        <label for="authors" class="block text-sm font-medium text-gray-700 mb-1">Authors:</label>
                        <select name="authors[]" id="authors" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('authors') border-red-500 @enderror" multiple>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', $content->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="genres" class="block text-sm font-medium text-gray-700 mb-1">Genres:</label>
                        <select name="genres[]" id="genres" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('genres') border-red-500 @enderror" multiple>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', $content->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="societies" class="block text-sm font-medium text-gray-700 mb-1">Societies:</label>
                        <select name="societies[]" id="societies" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('societies') border-red-500 @enderror" multiple>
                            @foreach ($societies as $society)
                                <option value="{{ $society->id }}" {{ in_array($society->id, old('societies', $content->societies->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $society->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex space-x-2">
                    <button type="submit" class="btn-primary px-4 py-2 rounded-md">Update Content</button>
                    <a href="{{ route('contents.index') }}" class="btn-secondary px-4 py-2 rounded-md">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>