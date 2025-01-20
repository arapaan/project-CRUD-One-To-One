<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['author','birth'];

    function book()
    {
        return $this->hasOne(Book::class);
    }


}
