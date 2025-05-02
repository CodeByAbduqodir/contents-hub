<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Content;
use App\Models\Genre;
use App\Models\Society;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::query();

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->has('authors')) {
            $query->whereIn('author_id', $request->authors);
        }

        if ($request->has('genres')) {
            $query->whereIn('genre_id', $request->genres);
        }

        if ($request->has('societies')) {
            $query->whereIn('society_id', $request->societies);
        }

        $contents = $query->with(['author', 'genre', 'society'])->paginate(10);

        $authors = Author::all();
        $genres = Genre::all();
        $societies = Society::all();

        return view('welcome', compact('contents', 'authors', 'genres', 'societies'));
    }
}