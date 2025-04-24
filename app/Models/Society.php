<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    protected $fillable = ['name', 'url'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'contents_societies');
    }
}