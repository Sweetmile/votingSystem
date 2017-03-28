<?php
/**
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/11
 * Time: 20:26
 */
namespace app\index\model;

use think\Model;

class Option extends Model {

    /**
     * 添加选项
     * @param array $options
     */
    public function addOption(array $options) {
        $this->saveAll($options);
    }

    public function getAllOptionById(int $id) : array {
        $where = array(
            "vote_id" => $id,
        );
        $result = $this->where($where)->select();
        $newResult = [];
        //总的票数
        $totalNumber = 0;
        if (count($result) > 0) {
            foreach ($result as $value) {
                $newResult[] = $value->data;
                $totalNumber += $value->data['number'];
            }
            foreach ($newResult as $key => $value) {
                if ($totalNumber == 0) {
                    $newResult[$key]['percent'] = 0;
                } else {
                    $newResult[$key]['percent'] = round($newResult[$key]['number'] * 100 / $totalNumber, 1);
                }
            }
        }
        return $newResult;
    }

    /**
     * 根据投票id获取所有的选项id
     * @param int $voteId
     * @return array
     */
    public function getAllOptionIdByVoteId(int $voteId) : array {
        $where = array(
            "vote_id" => $voteId,
        );
        $result = $this->where($where)->column('id');
        return $result;
    }


    /**
     * 未选择的选项number+1
     * @param $postVoting
     */
    public function addNumber($postVoting) {
        foreach ($postVoting as $item) {
            $option = $this->getOneOptionById($item);
            $number = $option['number'] + 1;
            unset($option['number']);
            $this->where($option)->update(['number' => $number]);
        }
    }

    /**根据id获取该选项
     * @param int $optionId
     * @return mixed
     */
    public function getOneOptionById(int $optionId) : array {
        $where = array(
            "id" => $optionId,
        );
        $result = $this->where($where)->select();
        return $result[0]->data;
    }
}