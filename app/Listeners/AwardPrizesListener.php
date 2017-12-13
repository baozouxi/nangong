<?php

namespace App\Listeners;

use App\Bet;
use App\Capital;
use App\Events\AwardPrizes;
use App\Game;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AwardPrizesListener
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
     * @param  AwardPrizes $event
     *
     * @return void
     */
    public function handle(AwardPrizes $event)
    {
        Log::info($event->result);
        $gameModel = Game::where('name', $event->name)->first();
        $game = app()->make(Game\Game::class)->getGame($gameModel->name);
        $bets = Bet::where('game_id', $gameModel->id)->where('actionNo',
            $event->result['actionNo'])->where('lotteried', 0)->get();
        $actionNo = $event->result['actionNo'];
        $game_id = $gameModel->id;

        foreach ($bets as $bet) {

            $time = $game->rule($bet->code, $event->result['codes']); //根据结果计算倍数
            if ($time > 0) {
                try {
                    DB::transaction(function () use ($bet, $time,$actionNo,$game_id) {

                        //更新状态
                        Bet::where('actionNo',$actionNo)->where('game_id',$game_id)->update(['lotteried'=>1]);

                        $capital = Capital::findOrFail($bet->user_id);
                        $profit = bcmul($bet->money, $time);
                        $capital->money = bcadd($capital->money, $profit);
                        $capital->save();
                        $bet->profit = $profit;
                        $bet->lotteried = 1;
                        $bet->save();
                    });
                } catch (\Throwable $e) {

                    dd($e->getMessage());
                }
            }
        }



    }
}
