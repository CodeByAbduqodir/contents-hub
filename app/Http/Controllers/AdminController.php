<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $contents = Content::with(['authors', 'genres', 'societies'])->paginate(10);
        $authors = Author::paginate(10);
        $genres = Genre::paginate(10);
        $societies = Society::paginate(10);

        return view('admin.dashboard', compact('contents', 'authors', 'genres', 'societies'));
    }

    public function storeAuthor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        Author::create($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Author created successfully.');
    }

    public function destroyAuthor(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Author deleted successfully.');
    }

    public function storeGenre(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create($request->only(['name']));
        return redirect()->route('admin.dashboard')->with('success', 'Genre created successfully.');
    }

    public function destroyGenre(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Genre deleted successfully.');
    }

    public function storeSociety(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        Society::create($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Society created successfully.');
    }

    public function destroySociety(Society $society)
    {
        $society->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Society deleted successfully.');
    }
}