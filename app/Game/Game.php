<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/9
 * Time: 下午3:39
 */

namespace App\Game;


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
        return array_push($game);
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


    /**
     * 获取所有游戏开奖结果
     * @return array 结果数组
     *
     */
    public function getCodes()
    {
        $codes = [];
        foreach ($this->games as $game) {
            $codes[$game->name()] = $game->getCodes();
        }

        return $codes;
    }




}