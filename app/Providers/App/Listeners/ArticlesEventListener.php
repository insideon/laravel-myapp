<?php

namespace App\Providers\App\Listeners;

use App\Providers\App\Events\ArticlesEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlesEventListener
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
     * @param  ArticlesEvent  $event
     * @return void
     */
    public function handle(ArticlesEvent $event)
    {
        //
    }
}
