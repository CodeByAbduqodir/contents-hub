@extends('layouts.app')

   @section('content')
       <div class="container mx-auto py-8">
           <h1 class="text-3xl font-bold mb-6">Edit Genres</h1>
           
           <form action="{{ route('admin.storeGenre') }}" method="POST" class="mb-8">
               @csrf
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                   <div>
                       <label for="name" class="block text-sm font-medium text-gray-700">Genre Name</label>
                       <input type="text" name="name" id="name" class="mt-1 block w-full border rounded-lg p-2" required>
                       @error('name')
                           <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                       @enderror
                   </div>
               </div>
               <button type="submit" class="mt-4 btn btn-success">Add Genre</button>
           </form>

           <table class="min-w-full bg-white border rounded-lg">
               <thead>
                   <tr>
                       <th class="py-2 px-4 border-b">ID</th>
                       <th class="py-2 px-4 border-b">Name</th>
                       <th class="py-2 px-4 border-b">Actions</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($genres as $genre)
                       <tr class="table-row">
                           <td class="py-2 px-4 border-b">{{ $genre->id }}</td>
                           <td class="py-2 px-4 border-b">{{ $genre->name }}</td>
                           <td class="py-2 px-4 border-b">
                               <form action="{{ route('admin.destroyGenre', $genre->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
               {{ $genres->links('vendor.pagination.custom') }}
           </div>
       </div>
   @endsection