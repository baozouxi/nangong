<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2018/1/2
 * Time: 17:57
 */

namespace App\Game;


use App\Game\Traits\CheckOpen;
use App\Game\Traits\GetFromForien;

class Canadav28 extends Canadav25
{

    Const CODE_URL = 'http://lotto.bclc.com/services2/keno/draw/latest/today';
    Const NAME = '加拿大幸运28-2.8倍场';

    use GetFromForien, CheckOpen;

    //开奖
    public function rule($bet, $open_num, $code_info_arr)
    {
        $lottery = $this->lottery($open_num);
        $time = 0;
        if (is_numeric($bet)) {
            if ($bet == $lottery['num']) {
                $time = 12;
            }
        } else {

            switch ($bet) {
                case '单' :
                case '双' :
                    if ($bet == $lottery['danshuang']) {
                        $time = 2.8;

                        if (in_array('单', $code_info_arr)
                            && in_array('双', $code_info_arr)
                        ) {
                            $time = 2.8;
                            if ($lottery['shunzi'] || $lottery['baozi']
                                || $lottery['duizi']
                            ) {
                                $time = 1;
                            }
                        }
                    }
                    if ($bet == '单' && $lottery['num'] == 13) {
                        $time = 1;
                    }
                    if ($bet == '双' && $lottery['num'] == 14) {
                        $time = 1;
                    }


                    break;
                case '小单' :
                case '小双' :
                case '大单' :
                case '大双' :
                    if ($bet == $lottery['zuhe']) {
                        if ($bet == '小单' || $bet == '大双') {
                            $time = 6;
                        } else {
                            $time = 6;
                        }
                    }
                    if ($lottery['shunzi'] || $lottery['baozi']
                        || $lottery['duizi']
                    ) {
                        $time = 0;
                        if ($bet == '小单' && $lottery['num'] == 13) {
                            $time = 1;
                        }
                        if ($bet == '大双'
                            && $lottery['num'] ==
                            14
                        ) {
                            $time = 1;
                        }

                    }


                    break;
                case '大' :
                case '小' :
                    if ($bet == $lottery['daxiao']) {
                        $time = 2.8;

                        if (in_array('大', $code_info_arr)
                            && in_array('小', $code_info_arr)
                        ) {
                            $time = 2.8;
                            if ($lottery['shunzi'] || $lottery['baozi']
                                || $lottery['duizi']
                            ) {
                                $time = 1;
                            }
                        }
                    }

                    if ($bet == '大' && $lottery['num'] == '14') {
                        $time = 1;
                    }

                    if ($bet == '小' && $lottery['num'] == '13') {
                        $time = 1;
                    }


                    break;
                case '极大' :
                case '极小' :
                    if ($bet == $lottery['jizhi']) {
                        $time = 12;
                    }
                    break;
                case '豹子':
                    if ($bet == $lottery['baozi']) {
                        $time = 60;
                    }
                    break;
                case '顺子':
                    if ($bet == $lottery['shunzi']) {
                        $time = 12;
                    }
                    break;
                case '对子':
                    if ($bet == $lottery['duizi']) {
                        $time = 3;
                    }
                    break;
            }

        }

        return $time;

    }



}