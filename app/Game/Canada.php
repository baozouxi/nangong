<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/23
 * Time: 11:50
 */

namespace App\Game;


use App\Game\Traits\CheckOpen;
use App\Game\Traits\GetFromForien;

class Canada extends Pc28
{
    Const CODE_URL = 'http://lotto.bclc.com/services2/keno/draw/latest/today';
    Const NAME = '加拿大幸运28';

    use GetFromForien,CheckOpen;


}