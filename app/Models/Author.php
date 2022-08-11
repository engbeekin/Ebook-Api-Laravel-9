<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * every Author has many books
     * many to many relationship between  Authors and books
     *
     * @return belongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_id', 'id');
    }
}
