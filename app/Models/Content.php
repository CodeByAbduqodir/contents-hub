<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ContentFactory;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'url'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_content', 'content_id', 'author_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'content_genre', 'content_id', 'genre_id');
    }

    public function societies()
    {
        return $this->belongsToMany(Society::class, 'content_society', 'content_id', 'society_id');
    }

    /**
     * Get the factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ContentFactory::new();
    }
}