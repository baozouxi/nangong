<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/23
 * Time: 11:50
 */

namespace App\Game;


class Canada extends Pc28
{
    Const CODE_URL = 'http://lotto.bclc.com/services2/keno/draw/latest/today';
    Const NAME = '加拿大幸运28';

    public function lottery($code)
    {
        return parent::lottery($code); // TODO: Change the autogenerated stub
    }

    public function getCodes()
    {
        return parent::getCodes(); // TODO: Change the autogenerated stub
    }




}