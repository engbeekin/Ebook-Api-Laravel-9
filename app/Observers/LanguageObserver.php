<?php

namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function created(Language $language)
    {
        Cache::forget('languages');
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function updated(Language $language)
    {
        Cache::forget('languages');

    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function deleted(Language $language)
    {
        Cache::forget('languages');

    }
}
