@extends('layouts.app')

   @section('content')
       <div class="container mx-auto py-8">
           <h1 class="text-3xl font-bold mb-6">Welcome to Contents Hub</h1>

           <form method="GET" action="{{ route('welcome') }}" class="mb-8">
               <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                   <div>
                       <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                       <select name="type" id="type" class="mt-1 block w-full border rounded-lg p-2">
                           <option value="">All Types</option>
                           <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                           <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Book</option>
                           <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                       </select>
                   </div>

                   <div>
                       <label for="authors" class="block text-sm font-medium text-gray-700">Authors</label>
                       <select name="authors[]" id="authors" class="mt-1 block w-full border rounded-lg p-2" multiple>
                           @foreach ($authors as $author)
                               <option value="{{ $author->id }}" {{ in_array($author->id, request('authors', [])) ? 'selected' : '' }}>
                                   {{ $author->name }}
                               </option>
                           @endforeach
                       </select>
                   </div>

                   <div>
                       <label for="genres" class="block text-sm font-medium text-gray-700">Genres</label>
                       <select name="genres[]" id="genres" class="mt-1 block w-full border rounded-lg p-2" multiple>
                           @foreach ($genres as $genre)
                               <option value="{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'selected' : '' }}>
                                   {{ $genre->name }}
                               </option>
                           @endforeach
                       </select>
                   </div>

                   <div>
                       <label for="societies" class="block text-sm font-medium text-gray-700">Societies</label>
                       <select name="societies[]" id="societies" class="mt-1 block w-full border rounded-lg p-2" multiple>
                           @foreach ($societies as $society)
                               <option value="{{ $society->id }}" {{ in_array($society->id, request('societies', [])) ? 'selected' : '' }}>
                                   {{ $society->name }}
                               </option>
                           @endforeach
                       </select>
                   </div>
               </div>
               <button type="submit" class="mt-4 btn btn-primary">Filter</button>
           </form>

           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
               @foreach ($contents as $content)
                   <div class="card p-6">
                       <h2 class="text-xl font-semibold mb-2">{{ $content->title }}</h2>
                       <p class="text-gray-600 mb-4">{{ $content->description }}</p>
                       <p class="text-sm text-gray-500">
                           Author: {{ $content->author ? $content->author->name : 'N/A' }} |
                           Genre: {{ $content->genre ? $content->genre->name : 'N/A' }} |
                           Society: {{ $content->society ? $content->society->name : 'N/A' }}
                       </p>
                   </div>
               @endforeach
           </div>

           <div class="mt-6">
               {{ $contents->links('vendor.pagination.custom') }}
           </div>
       </div>
   @endsection