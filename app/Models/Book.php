<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'published_at',
        'cover_image',
        'author_id'
    ];

    protected $casts = [
        'published_at' => 'date'
    ];

    /**
     * Get the author that owns the book
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the author's name or return 'Unknown' if no author is set
     */
    public function getAuthorNameAttribute()
    {
        return $this->author ? $this->author->name : 'Unknown';
    }

    /**
     * Get the author_id directly from the books table
     */
    public function getAuthorIdAttribute()
    {
        return $this->attributes['author_id'] ?? null;
    }
}
