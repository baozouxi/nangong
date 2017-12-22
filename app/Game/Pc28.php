<?php
/**
 * Created by PhpStorm.
 * User: SX-PC
 * Date: 2017/12/08
 * Time: 11:25
 */

namespace App\Game;


use App\Bet;
use App\Game\Traits\CheckOpen;
use App\Game\Traits\GetFrom360;
use App\OpenCode;
use Illuminate\Support\Facades\Auth;

class Pc28 implements GameInterface
{
    Const CODE_URL = 'http://www.bwlc.net/';
    Const NAME = '北京幸运28';

    use GetFrom360, CheckOpen;


    public function lottery($code)
    {
        $code_arr = [];

        $code_arr = explode(',', $code);
        if (empty($code_arr)) {
            throw new GameException(self::NAME.'开奖结果错误');
        }
        //初始化结果 防止出错
        $code_arr['num'] = null;
        $code_arr['jizhi'] = null;
        $code_arr['daxiao'] = null;
        $code_arr['zuhe'] = null;
        $code_arr['danshuang'] = null;
        $sum = array_sum($code_arr);

        if ($sum > 27) {
            throw new GameException(self::NAME.'开奖结果错误');
        }

        $code_arr['num'] = $sum;

        if ($sum <= 13) {
            $code_arr['daxiao'] = '小';

            //组合
            if ($sum % 2 == 0) {
                $code_arr['zuhe'] = '小双';
            } else {
                $code_arr['zuhe'] = '小单';
            }

            //极值
            if ($sum <= 5) {
                $code_arr['jizhi'] = '极小';
            }


        } else {
            $code_arr['daxiao'] = '大';

            if ($sum % 2 == 0) {

                $code_arr['zuhe'] = '大双';
            } else {
                $code_arr['zuhe'] = '大单';
            }


            //极值
            if ($sum >= 22) {
                $code_arr['jizhi'] = '极大';
            }
        }

        if ($sum % 2 == 0) {
            $code_arr['danshuang'] = '双';
        } else {
            $code_arr['danshuang'] = '单';
        }


        return $code_arr;

    }


    //根据投注 计算倍数
    public function rule($bet, $open_num, $code_info_arr)
    {
        $lottery = $this->lottery($open_num);
        $time = 0;
        if (is_numeric($bet)) {
            if ($bet == $lottery['num']) {
                $time = 10;
            }
        } else {

            switch ($bet) {
                case '单' :
                case '双' :
                    if ($bet == $lottery['danshuang']) {
                        $time = 2;
                    }
                    if ($bet == '单' && $lottery['num'] == 13) {
                        $time = 1.6;
                    }
                    if ($bet == '双' && $lottery['num'] == 14) {
                        $time = 1.6;
                    }
                    break;
                case '小单' :
                case '小双' :
                case '大单' :
                case '大双' :
                    if ($bet == $lottery['zuhe']) {
                        if ($bet == '小单' || $bet == '大双') {
                            $time = 4.7;
                        } else {
                            $time = 4.2;
                        }
                    }
                    break;
                case '大' :
                case '小' :
                    if ($bet == $lottery['daxiao']) {
                        $time = 2;
                    }
                    if ($bet == '大' && $lottery['num'] == 14) {
                        $time = 1;
                    }
                    if ($bet == '小' && $lottery['num'] == 13) {
                        $time = 1;
                    }


                    break;
                case '极大' :
                case '极小' :
                    if ($bet == $lottery['jizhi']) {
                        $time = 10;
                    }
                    break;
            }

        }

        return $time;


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
        return static::NAME;
    }

    //过滤下注数组
    public function checkSubmitBet($bet_arr)
    {
        $game = \App\Game::where('name',self::NAME)->first();
        $openCode = new OpenCode();
        $current_expect = $openCode->currentExpect($game->id);


        if ($bet_arr['tp101'] && $bet_arr['tp102']) {
            throw new GameException('不能同时下注大小');
        }
        if ($bet_arr['tp103'] && $bet_arr['tp104']) {
            throw new GameException('不能同时下注单双');
        }

        if ($bet_arr['tp101']) {
            $bet = Bet::where('user_id', Auth::user()->id)->where('actionNo',$current_expect)->where('game_id',$game->id)->where('code', '大')->first();
            if ($bet != null) {
                throw new GameException('已经下注大，不能再下注小');
            }

        }

        if ($bet_arr['tp102']) {
            $bet = Bet::where('user_id', Auth::user()->id)->where('actionNo',$current_expect)->where('game_id',$game->id)->where('code', '小')->first();
            if ($bet != null) {
                throw new GameException('已经下注小，不能再下注大');
            }

        }


        if ($bet_arr['tp103']) {
            $bet = Bet::where('user_id', Auth::user()->id)->where('actionNo',$current_expect)->where('game_id',$game->id)->where('code', '双')->first();
            if ($bet != null) {
                throw new GameException('已经下注双，不能再下注单');
            }

        }

        if ($bet_arr['tp104']) {
            $bet = Bet::where('user_id', Auth::user()->id)->where('actionNo',$current_expect)->where('game_id',$game->id)->where('code', '单')->first();
            if ($bet != null) {
                throw new GameException('已经下注单，不能再下注双');
            }

        }


    }

}