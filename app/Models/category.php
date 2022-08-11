<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * every category has many books
     * many to many relationship between  Categories and books
     *
     * @return belongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'category_id', 'id');
    }
}
