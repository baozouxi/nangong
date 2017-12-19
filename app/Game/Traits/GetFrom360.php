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
     *
     * @return array 解析结果
     */
    protected function parse($body)
    {


        $str = substr($body, strpos($body, '<tbody id=\'data-tab\'>'), 901);



        $str = str_replace(["\r\n", ' ','&nbsp;', "\t"], '', $str);
        $pattern = '/<tr><td>1<\/td><td>(\d+)<\/td><td><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><spanclass=\'kl8_ball\'>(\d+)<\/span><\/td><td><spanclass=\'blue\'>(\d+)<\/span><\/td><td>--<\/td><td>([^<]+)<\/td><\/tr>/';



        $match = [];
        preg_match_all($pattern, $str, $match, PREG_SET_ORDER);


        if (empty($match)) {
            return;
        }

        $match = array_shift($match);
        $open_time = date('Y-m-d H:i:s', strtotime(array_pop($match)));

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
        $result['open_time'] = $open_time;

        return $result;
    }

}