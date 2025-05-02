@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <form action="{{ route('admin.storeContent') }}" method="POST" class="mb-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border rounded-lg p-2" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border rounded-lg p-2" required></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="author_id" class="block text-sm font-medium text-gray-700">Author</label>
                    <select name="author_id" id="author_id" class="mt-1 block w-full border rounded-lg p-2" required>
                        <option value="">Select Author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                    <select name="genre_id" id="genre_id" class="mt-1 block w-full border rounded-lg p-2" required>
                        <option value="">Select Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="society_id" class="block text-sm font-medium text-gray-700">Society</label>
                    <select name="society_id" id="society_id" class="mt-1 block w-full border rounded-lg p-2" required>
                        <option value="">Select Society</option>
                        @foreach ($societies as $society)
                            <option value="{{ $society->id }}">{{ $society->name }}</option>
                        @endforeach
                    </select>
                    @error('society_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="mt-4 btn btn-success">Add Content</button>
        </form>

        <table class="min-w-full bg-white border rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Author</th>
                    <th class="py-2 px-4 border-b">Genre</th>
                    <th class="py-2 px-4 border-b">Society</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                    <tr class="table-row">
                        <td class="py-2 px-4 border-b">{{ $content->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $content->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $content->description }}</td>
                        <td class="py-2 px-4 border-b">{{ $content->author ? $content->author->name : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $content->genre ? $content->genre->name : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $content->society ? $content->society->name : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('admin.destroyContent', $content->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $contents->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection