<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;

    /**
     * every category has many books
     * many to many relationship between  Categories and books
     * @return belongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class,'category_id','id');
    }
}
