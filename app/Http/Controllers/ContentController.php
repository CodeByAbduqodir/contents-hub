<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::with(['authors', 'genres', 'societies']);

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->has('authors') && is_array($request->authors)) {
            $query->whereHas('authors', function ($q) use ($request) {
                $q->whereIn('authors.id', $request->authors);
            });
        }

        if ($request->has('genres') && is_array($request->genres)) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('genres.id', $request->genres);
            });
        }

        if ($request->has('societies') && is_array($request->societies)) {
            $query->whereHas('societies', function ($q) use ($request) {
                $q->whereIn('societies.id', $request->societies);
            });
        }

        $contents = $query->paginate(10);

        $authors = Author::all();
        $genres = Genre::all();
        $societies = Society::all();

        return view('welcome', compact('contents', 'authors', 'genres', 'societies'));
    }

    public function show(Content $content)
    {
        $content->load(['authors', 'genres', 'societies']);
        return view('contents.show', compact('content'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        $societies = Society::all();
        return view('contents.create', compact('authors', 'genres', 'societies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:video,book,audio',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'societies' => 'required|array',
            'societies.*' => 'exists:societies,id',
        ]);

        $content = Content::create($request->only(['type', 'title', 'description', 'url']));
        $content->authors()->sync($request->authors);
        $content->genres()->sync($request->genres);
        $content->societies()->sync($request->societies);

        return redirect()->route('home')->with('success', 'Content created successfully.');
    }

    public function edit(Content $content)
    {
        $authors = Author::all();
        $genres = Genre::all();
        $societies = Society::all();
        return view('contents.edit', compact('content', 'authors', 'genres', 'societies'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'type' => 'required|in:video,book,audio',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'societies' => 'required|array',
            'societies.*' => 'exists:societies,id',
        ]);

        $content->update($request->only(['type', 'title', 'description', 'url']));
        $content->authors()->sync($request->authors);
        $content->genres()->sync($request->genres);
        $content->societies()->sync($request->societies);

        return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
    }
}