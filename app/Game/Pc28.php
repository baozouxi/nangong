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
    Const CODE_URL = 'http://www.bwlc.net/';
    Const NAME = '北京幸运28';

    use GetFrom360, CheckOpen;


    public function lottery($code)
    {

    }


    public function getCodes()
    {
        $request = \Requests::request(self::CODE_URL);

        $result = $this->parse($request->body);

        $this->checkOpen($result);

        return $result;

    }


    public function name()
    {
        return self::NAME;
    }






}