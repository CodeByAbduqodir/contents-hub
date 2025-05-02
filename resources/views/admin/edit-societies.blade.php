@extends('layouts.app')

   @section('content')
       <div class="container mx-auto py-8">
           <h1 class="text-3xl font-bold mb-6">Edit Societies</h1>

           <form action="{{ route('admin.storeSociety') }}" method="POST" class="mb-8">
               @csrf
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                   <div>
                       <label for="name" class="block text-sm font-medium text-gray-700">Society Name</label>
                       <input type="text" name="name" id="name" class="mt-1 block w-full border rounded-lg p-2" required>
                       @error('name')
                           <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                       @enderror
                   </div>
               </div>
               <button type="submit" class="mt-4 btn btn-success">Add Society</button>
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
                   @foreach ($societies as $society)
                       <tr class="table-row">
                           <td class="py-2 px-4 border-b">{{ $society->id }}</td>
                           <td class="py-2 px-4 border-b">{{ $society->name }}</td>
                           <td class="py-2 px-4 border-b">
                               <form action="{{ route('admin.destroySociety', $society->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
               {{ $societies->links('vendor.pagination.custom') }}
           </div>
       </div>
   @endsection