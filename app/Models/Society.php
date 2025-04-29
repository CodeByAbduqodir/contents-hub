<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\SocietyFactory;

class Society extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_society', 'society_id', 'content_id');
    }

    /**
     * Get the factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SocietyFactory::new();
    }
}