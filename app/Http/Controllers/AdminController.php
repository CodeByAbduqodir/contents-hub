<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Content;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $contents = Content::with(['author', 'genre', 'society'])->paginate(10);
        $authors = Author::all();
        $genres = Genre::all();
        $societies = Society::all();
        return view('admin.dashboard', compact('contents', 'authors', 'genres', 'societies'));
    }

    public function storeContent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'society_id' => 'required|exists:societies,id',
        ]);

        Content::create($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Content created successfully.');
    }

    public function destroyContent($id)
    {
        Content::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Content deleted successfully.');
    }

    public function showAuthors()
    {
        $authors = Author::paginate(10);
        return view('admin.edit-authors', compact('authors'));
    }

    public function storeAuthor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create(['name' => $request->name]);
        return redirect()->route('admin.editAuthors')->with('success', 'Author added successfully.');
    }

    public function destroyAuthor($id)
    {
        $author = Author::findOrFail($id);
        if ($author->contents()->count() > 0) {
            return redirect()->route('admin.editAuthors')->with('error', 'Cannot delete author because they have associated content.');
        }
        $author->delete();
        return redirect()->route('admin.editAuthors')->with('success', 'Author deleted successfully.');
    }

    public function showGenres()
    {
        $genres = Genre::paginate(10);
        return view('admin.edit-genres', compact('genres'));
    }

    public function storeGenre(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create(['name' => $request->name]);
        return redirect()->route('admin.editGenres')->with('success', 'Genre added successfully.');
    }

    public function destroyGenre($id)
    {
        $genre = Genre::findOrFail($id);
        if ($genre->contents()->count() > 0) {
            return redirect()->route('admin.editGenres')->with('error', 'Cannot delete genre because it has associated content.');
        }
        $genre->delete();
        return redirect()->route('admin.editGenres')->with('success', 'Genre deleted successfully.');
    }

    public function showSocieties()
    {
        $societies = Society::paginate(10);
        return view('admin.edit-societies', compact('societies'));
    }

    public function storeSociety(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Society::create(['name' => $request->name]);
        return redirect()->route('admin.editSocieties')->with('success', 'Society added successfully.');
    }

    public function destroySociety($id)
    {
        $society = Society::findOrFail($id);
        if ($society->contents()->count() > 0) {
            return redirect()->route('admin.editSocieties')->with('error', 'Cannot delete society because it has associated content.');
        }
        $society->delete();
        return redirect()->route('admin.editSocieties')->with('success', 'Society deleted successfully.');
    }
}