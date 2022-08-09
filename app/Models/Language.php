<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * every language has many books
     * one to many relationship between languages and books
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'language_id', 'id');
    }
}
