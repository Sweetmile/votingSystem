<?php
/**
 * 投票选项log
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/12
 * Time: 22:35
 */
namespace app\index\model;

use think\Model;

class OptionLog extends Model {

    /**
     * 添加选项记录
     * @param array $postVoting
     * @param string $username
     */
    public function addLog(array $postVoting, string $username) {
        $data = [];
        foreach ($postVoting as $item) {
            $data[] = [
                'op_time' => date("Y-m-d H:i:s"),
                'log' => $item,
                'username' => $username
            ];
        }
        $this->saveAll($data);
    }

    public function getResult(array $optionIds) : array {
        $newResult = [];
        foreach ($optionIds as $value) {
            $newResult[$value] = $this->where("log", $value)->column("username");
        }
        return $newResult;
    }

}