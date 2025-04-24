<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'url'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'authors_contents');
    }
}