<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/28
 * Time: 14:21
 */

namespace App\Game\Traits;


trait GetFromForien
{

    //从国外官网采集
    public function parse($body)
    {
        $codes_list = json_decode($body, true);

        $codes = array_shift($codes_list);

        $codes['drawNbrs'] = array_sort($codes['drawNbrs']);

        $temp_arr = [];
        $temp_arr[0] = 0;
        $temp_arr[1] = 0;
        $temp_arr[2] = 0;
        for ($i=0; $i<3; $i++) {
            $current = $i+1;
            for ($j=0;$j<=5;$j++) {
                $temp_arr[$i] += $codes['drawNbrs'][$current];
                $current += 3;
            }
            $temp_arr[$i] = substr((string)$temp_arr[$i], -1, 1);
        }


        $result = [];
        $result['codes'] = implode(',', $temp_arr);
        $result['actionNo'] = $codes['drawNbr'];
        $result['open_time'] = date('Y-m-d H:i:s', time());

        return $result;
    }

}