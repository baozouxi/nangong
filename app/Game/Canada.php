<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/23
 * Time: 11:50
 */

namespace App\Game;


class Canada implements GameInterface
{
    Const CODE_URL = 'http://lotto.bclc.com/services2/keno/draw/latest/today';
    Const NAME = '加拿大幸运28';


    public function lottery($code)
    {
        // TODO: Implement lottery() method.
    }



    public function getCodes()
    {

    }

    public function name()
    {
        // TODO: Implement name() method.
    }


    public function parse($body)
    {

    }


}