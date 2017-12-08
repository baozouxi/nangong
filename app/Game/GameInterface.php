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
    /**
     * 开奖算法
     * @param $code 开奖结果
     * @return mixed
     *
     */
    public function lottery($code);


}