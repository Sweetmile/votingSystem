<?php
/**
 * 投票log
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/12
 * Time: 22:31
 */
namespace app\index\model;

use think\Model;

class VoteLog extends Model {

    /**
     * 添加用户投票记录
     * @param int $voteId
     * @param string $opName
     */
    public function addLog(int $voteId, string $opName) {
        $data = [
            'log' => $voteId,
            'vote_time' => date("Y-m-d H:i:s"),
            'username' => $opName
        ];
        $this->save($data);
    }

    /**
     * 判断是否已经投过票
     * @param int $voteId
     * @param string $opName
     * @return bool
     */
    public function isVote(int $voteId, string $opName) : bool {
        $where = [
            'log' => $voteId,
            'username' => $opName
        ];
        return $this->where($where)->count();
    }

}