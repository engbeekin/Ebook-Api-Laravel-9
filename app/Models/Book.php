<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * every book has one language
     * one to many relationship between languages and books
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * every book has many categories
     * many to many relationship between books and  Categories
     *
     * @return belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(category::class);
    }

    /**
     * every book has many Authors
     * many to many relationship between books and Authors
     *
     * @return belongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
