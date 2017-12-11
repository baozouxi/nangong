<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/9
 * Time: 下午3:39
 */

namespace App\Game;

use App\Events\GotCodes;
use Illuminate\Support\Facades\Log;


/**
 * 策略模式
 *
 * gameMaster
 * Class Game
 * @package App\Game
 */
class Game
{

    /**
     * 游戏池
     * @var array
     */
    protected $games = [];


    public function __construct(array $games = array())
    {
        if (!is_null($games)) {
            $this->games = $games;
        }
    }


    /**
     * 游戏入池
     * @param GameInterface $game
     * @return int
     */
    public function addGame(GameInterface $game)
    {
        return array_push($this->games, $game);
    }


    protected function check(array $games)
    {
        foreach ($games as $game) {
            if (!($game instanceof GameInterface)) {
                throw new GameException('非法游戏项目');
            }
        }

        return $games;
    }

    public function getGames()
    {
        return $this->games;
    }


    public function getGame($name)
    {
        if ($this->gameExist($name)) {
            return $this->games[$name];
        }

        throw new GameException('游戏'.$name.'尚未添加');
    }


    public function gameExist($name)
    {
            return isset($this->games[$name]);
    }


    /**
     * 获取所有游戏开奖结果
     * @return array 结果数组
     *
     */
    public function getCodes()
    {
        try {
            $codes = [];
            foreach ($this->games as $game) {
                $current_codes = $game->getCodes();
                $name = $game->name();
                if (!empty($current_codes)) {

                    event(new GotCodes($name, $current_codes)); //获取成功 触发事件

                    $codes[$name] = $current_codes;
                }
            }
        } catch (GameException $exception) {
            Log::error($exception->getMessage());
        }
        return $codes;
    }


}