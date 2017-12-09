<?php

namespace App\Listeners;

use App\Events\GotCodes;
use App\Game;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GotCodesListener
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
     * @param  GotCodes $event
     * @return void
     */
    public function handle(GotCodes $event)
    {
        $model = Game::where(['name' => $event->name])->first();
        


    }
}
