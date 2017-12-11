<?php

namespace App\Listeners;

use App\Events\GotCodes;
use App\Game;
use App\Game\GameException;
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
        if (!$gameModel = Game::where('name', $event->name)->withCount(['openCodes' => function ($query) use ($event) {
            return $query->where('actionNo',$event->result['actionNo']);
        }])->firstOrFail()) {
            throw new GameException('游戏' . $event->name . '在数据库中不存在');
        }


        //是否存在
        if ($gameModel->open_codes_count > 0) {
            return;
        }


        if (!$gameModel->openCodes()->create([
            'open_time' => $event->result['open_time'],
            'actionNo' => $event->result['actionNo'],
            'codes' => $event->result['codes']

        ])) {
            throw new GameException('游戏' . $event->name . '第' . $event->result['actionNo'] . '开奖数据写入失败');
        }


    }
}
