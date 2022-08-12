<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookObserver
{
    /**
     * Handle the Books "created" event.
     *
     * @param  \App\Models\Book  $books
     * @return void
     */
    public function created(Book $books)
    {
        Cache::forget('books');

    }

    /**
     * Handle the Book "updated" event.
     *
     * @param  \App\Models\Book  $books
     * @return void
     */
    public function updated(Book $books)
    {
        Cache::forget('books');
    }

    /**
     * Handle the Book "deleted" event.
     *
     * @param  \App\Models\Book  $books
     * @return void
     */
    public function deleted(Book $books)
    {
        Cache::forget('books');
    }

}
