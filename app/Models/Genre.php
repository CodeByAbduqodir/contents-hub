<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'contents_genres');
    }
}