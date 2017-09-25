<?php

namespace App\Listeners;

use App\Events\ModelChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CacheHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ModelChanged  $event
     * @return void
     */
    public function handle(ModelChanged $event)
    {
        if (! taggable()) {
            return \Cache::flush();
        }

        return \Cache::tags($event->cacheTags)->flush();
    }
}
