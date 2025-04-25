<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with(['authors', 'genres', 'societies'])->paginate(10);
        return view('contents.index', compact('contents'));
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
            'genres' => 'required|array',
            'societies' => 'required|array',
        ]);

        $content = Content::create($request->only(['type', 'title', 'description', 'url']));
        $content->authors()->attach($request->input('authors'));
        $content->genres()->attach($request->input('genres'));
        $content->societies()->attach($request->input('societies'));

        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }

    public function show(Content $content)
    {
        return view('contents.show', compact('content'));
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
            'genres' => 'required|array',
            'societies' => 'required|array',
        ]);

        $content->update($request->only(['type', 'title', 'description', 'url']));
        $content->authors()->sync($request->input('authors'));
        $content->genres()->sync($request->input('genres'));
        $content->societies()->sync($request->input('societies'));

        return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
    }
}