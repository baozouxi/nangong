<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2018/1/2
 * Time: 14:47
 */

namespace App\Game;


use App\Game\Traits\CheckOpen;
use App\Game\Traits\GetFromForien;

class Canadav25 extends Pc28v25
{
    Const CODE_URL = 'http://lotto.bclc.com/services2/keno/draw/latest/today';
    Const NAME = '加拿大幸运28-2.5倍场';

    use GetFromForien,CheckOpen;

}