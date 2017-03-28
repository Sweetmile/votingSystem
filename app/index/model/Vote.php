<?php
/**
 * Vote Model
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/11
 * Time: 0:06
 */


namespace app\index\model;


use think\Model;

define("PAGE_NUMBER", 10);

class Vote extends Model {

    public function getVoteByGrade(int $grade) {
        $grade = $grade + 1;
        return $this->where("grade", "<", $grade)->order("create_time desc")->paginate(PAGE_NUMBER);
    }

    /**
     * 增加投票
     * @param array $vote
     * @return int 返回新添加的投票的id
     */
    public function addVote(array $vote) : int {
        $this->save($vote);
        $result = $this->where($vote)->select();
        return ($result[0]->data)['id'];
    }

    /**
     * 根据id判断投票是否存在
     * @param int $id
     * @return bool
     */
    public function hasVote(int $id) : bool {
        $where = array(
            "id" => $id,
        );
        $result = $this->where($where)->select();
        return count($result) > 0;
    }

    public function getVoteById(int $id) : array {
        $where = array(
            "id" => $id,
        );
        $result = $this->where($where)->select();
        return  $result[0]->data;
    }

}