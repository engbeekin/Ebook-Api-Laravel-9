<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * every Author has many books
     * many to many relationship between  Authors and books
     * @return belongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_id', 'id');
    }
}
