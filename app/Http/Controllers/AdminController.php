<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $contentQuery = Content::with(['authors', 'genres', 'societies']);
        if ($request->has('type') && $request->type !== '') {
            $contentQuery->where('type', $request->type);
        }
        if ($request->has('authors') && is_array($request->authors)) {
            $contentQuery->whereHas('authors', function ($q) use ($request) {
                $q->whereIn('authors.id', $request->authors);
            });
        }
        if ($request->has('genres') && is_array($request->genres)) {
            $contentQuery->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('genres.id', $request->genres);
            });
        }
        if ($request->has('societies') && is_array($request->societies)) {
            $contentQuery->whereHas('societies', function ($q) use ($request) {
                $q->whereIn('societies.id', $request->societies);
            });
        }
        $contents = $contentQuery->paginate(10);

        $authors = Author::paginate(10);
        $genres = Genre::paginate(10);
        $societies = Society::paginate(10);

        $allAuthors = Author::all();
        $allGenres = Genre::all();
        $allSocieties = Society::all();

        return view('admin.dashboard', compact('contents', 'authors', 'genres', 'societies', 'allAuthors', 'allGenres', 'allSocieties'));
    }

    public function storeAuthor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        Author::create($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Author created successfully.');
    }

    public function editAuthor(Author $author)
    {
        return view('admin.edit-content-data', [
            'entity' => $author,
            'entity_type' => 'author',
            'route' => 'admin.authors.update',
            'title' => 'Edit Author: ' . $author->name,
        ]);
    }

    public function updateAuthor(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $author->update($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Author updated successfully.');
    }

    public function destroyAuthor(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Author deleted successfully.');
    }

    public function storeGenre(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create($request->only(['name']));
        return redirect()->route('admin.dashboard')->with('success', 'Genre created successfully.');
    }

    public function editGenre(Genre $genre)
    {
        return view('admin.edit-content-data', [
            'entity' => $genre,
            'entity_type' => 'genre',
            'route' => 'admin.genres.update',
            'title' => 'Edit Genre: ' . $genre->name,
        ]);
    }

    public function updateGenre(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($request->only(['name']));
        return redirect()->route('admin.dashboard')->with('success', 'Genre updated successfully.');
    }

    public function destroyGenre(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Genre deleted successfully.');
    }

    public function storeSociety(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        Society::create($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Society created successfully.');
    }

    public function editSociety(Society $society)
    {
        return view('admin.edit-content-data', [
            'entity' => $society,
            'entity_type' => 'society',
            'route' => 'admin.societies.update',
            'title' => 'Edit Society: ' . $society->name,
        ]);
    }

    public function updateSociety(Request $request, Society $society)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $society->update($request->only(['name', 'url']));
        return redirect()->route('admin.dashboard')->with('success', 'Society updated successfully.');
    }

    public function destroySociety(Society $society)
    {
        $society->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Society deleted successfully.');
    }
}