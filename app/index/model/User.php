<?php
/**
 * User Model
 * Created by PhpStorm.
 * User: Jehu
 * Date: 2017/1/10
 * Time: 17:58
 */
namespace app\index\model;

use think\Model;

class User extends Model {

    /**
     * 添加用户
     * @param array $postMessage
     */
    public function addUser(array $postMessage) {
        $newUser = [
            "username" => $postMessage['username'],
            "pwd" => $postMessage['pwd1'],
            "grade" => $postMessage['grade'],
            "admin" => $postMessage['admin']
        ];
        $this->save($newUser);
    }

    /**
     * 登陆检查
     * @param string $cUserName
     * @param string $cPwd
     * @return int 返回符合条件的数目，0即表示没有，登录失败
     */
    public function loginCheck(string $cUserName, string $cPwd) : int {
        $where = array(
            "username" => $cUserName,
            "pwd" => $cPwd
        );
        return $this->where($where)->count();
    }

    /**
     * 根据姓名判断用户是否存在
     * @param string $username
     * @return bool
     */
    public function hasUser(string $username) : bool  {
        $where = array(
            "username" => $username,
        );
        return $this->where($where)->count();
    }

    /**
     * 返回个人信息
     * @param string $gUserName
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getUser(string $gUserName) {
        $where = array(
            "username" => $gUserName
        );
        $result = $this->where($where)->select();
        return $result[0]->data;
    }

    /**
     * 更具用户名判断是否是管理员
     * @param string $username
     * @return bool
     */
    public function isAdmin(string $username) : bool {
        $where = [
            "username" => $username
        ];
        $result = $this->where($where)->column("admin");
        return $result[0];
    }






}