<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['type', 'title', 'description', 'url'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'contents_genres');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_contents');
    }

    public function societies()
    {
        return $this->belongsToMany(Society::class, 'contents_societies');
    }
}