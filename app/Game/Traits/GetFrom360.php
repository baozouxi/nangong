<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/9
 * Time: 下午4:13
 */

namespace App\Game\Traits;


trait getFrom360
{

    /**
     *
     * @param $body
     * @return array 解析结果
     */
    protected function parse($body)
    {

        $str = substr($body, strpos($body, '<!--start 快乐8-->'), 900);
        $str = str_replace(["\r\n", ' ', "\t"], '', $str);
        $pattern = '/<spanclass="ml10bredfaf14">(\d+)<\/span>.*<ulclass="dib"><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><li>(\d+)<\/li><\/ul>/';

        $match = [];
        preg_match_all($pattern, $str, $match, PREG_SET_ORDER);

        if (empty($match)) return;

        $match = array_shift($match);
        $codes = '';
        array_shift($match);
        $actionNo = array_shift($match);
        $match = array_sort($match);

        //计算中奖号码
        $sum_arr = [];
        for ($i = 1; $i <= 3; $i++) {
            $sum = 0;
            for ($j = 1; $j <= 6; $j++) {
                $sum += array_shift($match);
            }
            array_push($sum_arr, substr((string)$sum, -1, 1));
        }

        $codes = implode(',', $sum_arr);


        $result['codes'] = $codes;
        $result['actionNo'] = $actionNo;
        $result['open_time'] = date('Y-m-d H:i:s', time());

        return $result;
    }

}