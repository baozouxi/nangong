<?php
/**
 * Created by PhpStorm.
 * User: sx
 * Date: 2017/12/11
 * Time: 11:58
 */

namespace App\Game\Traits;


use App\Game\GameException;

trait CheckOpen
{
    /**
     * 检查开奖结果
     * @param $result
     * @throws GameException
     */
    protected function checkOpen($result)
    {
        $fields = ['codes', 'actionNo', 'open_time'];

        foreach ($fields as $field) {
            if (!isset($result[$field]) || $result[$field] == '') {
                throw new GameException($this->name() . '开奖结果获取异常');
            }
        }
    }

}