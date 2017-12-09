<?php
/**
 * Created by PhpStorm.
 * User: SX-PC
 * Date: 2017/12/08
 * Time: 11:25
 */

namespace App\Game;


use App\Game\Traits\getFrom360;

class Pc28 implements GameInterface
{
    Const URL = 'http://cp.360.cn/kl8/?menu&r_a=JZFvaq';
    Const NAME = '北京幸运28';

    use getFrom360;

    public function lottery($code)
    {
        // TODO: Implement lottery() method.
    }

    public function getCodes()
    {
        $request = \Requests::request(self::URL);

        return $this->parse($request->body);

    }


    public function name()
    {
        return self::NAME;
    }


}