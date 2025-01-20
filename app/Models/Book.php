<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['name', 'date', 'author_id'];

    function author()
    {
        return $this->belongsTo(Author::class);
    }
}