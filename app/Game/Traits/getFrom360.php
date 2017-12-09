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
        $codes = [];

        $str = substr($body, strpos($body, '<dl class="kl8-lastestnum" bcnt="103" ubcnt="76">'), 500);

        return $codes;
    }

}