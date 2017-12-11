<?php
/**
 * Created by PhpStorm.
 * User: SX-PC
 * Date: 2017/12/08
 * Time: 11:25
 */

namespace App\Game;


use App\Game\Traits\CheckOpen;
use App\Game\Traits\GetFrom360;

class Pc28 implements GameInterface
{
    Const URL = 'http://www.bwlc.net/';
    Const NAME = '北京幸运28';

    use GetFrom360, CheckOpen;


    public function lottery($code)
    {
        // TODO: Implement lottery() method.
    }


    public function getCodes()
    {
        $request = \Requests::request(self::URL);

        $result = $this->parse($request->body);

        $this->checkOpen($result);

        return $result;

    }


    public function name()
    {
        return self::NAME;
    }



}