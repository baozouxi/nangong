<?php
/**
 * Created by PhpStorm.
 * User: SX-PC
 * Date: 2017/12/08
 * Time: 11:26
 */

namespace App\Game;


interface GameInterface
{

    //游戏名


    /**
     * 开奖结果
     * @param $code 开奖号码
     * @return float 奖励倍数
     *
     */
    public function lottery($code);


    /**
     * 获取开奖号码
     * @return array 开奖号码
     */
    public function getCodes();

    /**
     * 返回游戏名
     * @return string
     */
    public function name();



}