<?php

namespace App\Observers;

use App\Models\category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\category  $category
     * @return void
     */
    public function created(category $category)
    {
        Cache::forget('categories');
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\category  $category
     * @return void
     */
    public function updated(category $category)
    {
        Cache::forget('categories');

    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\category  $category
     * @return void
     */
    public function deleted(category $category)
    {
        Cache::forget('categories');

    }
}
