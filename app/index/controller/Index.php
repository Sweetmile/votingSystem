<?php
namespace app\index\controller;

use app\index\model\Option;
use app\index\model\OptionLog;
use app\index\model\User;
use app\index\model\Vote;
use app\index\model\VoteLog;
use think\Controller;
use think\Request;
use think\Session;

class Index  extends Controller {

    public function index() {
        return $this->fetch('login', ['footer' => footer()]);
    }


    /**
     * 登陆检查
     * @return string
     */
    public function loginCheck() : string {
        $user = new User();
        $status = "error";
        $message = "";
        $postData = Request::instance()->post("");
        if (isset($postData['account']) && isset($postData['pwd']) && isset($postData['captcha'])) {
            $captchaJudge = $this->validate(array('captcha' => $postData['captcha']), ['captcha|验证码'=>'require|captcha']);
            if ($captchaJudge === true) {
                if ($user->loginCheck($postData['account'], $postData['pwd'])) {
                    $status = "success";
                    $message = "";
                    Session::set("name", $postData['account']);
                } else {
                    $status = "error";
                    $message = "账号或者密码错误";
                }
            } else {
                $status = "error";
                $message = "验证码错误";
            };

        } else {
            $status = "error";
            $message = "请完整填写登录信息";
        }
        return json_encode(["message" => $message, "status" => $status]);
    }

    /**
     * 登出
     * @return string
     */
    public function logout() : string {
        if (Session::has("name")) {
            Session::delete("name");
            return json_encode(["status" => "success", "message" => "登出成功"]);
        } else {
            return json_encode(["status" => "error", "message" => "登出失败，你还没登陆"]);
        }
    }


    /**
     * 显示所有投票
     * @return mixed
     */
    public function votePage() {
        $user = new User();
        $vote = new Vote();
        if ($this->isLogin()) {
            $name = Session::get("name");
            $userInfor = $user->getUser($name);
            $grade = $userInfor['grade'];
            $admin = $userInfor['admin'];
        } else {
            $grade = 0;
            $admin = 0;
            $name = "";
        }
        $voteList = $vote->getVoteByGrade($grade);
        return $this->fetch('votePage', ['list' => $voteList, 'header' => getHeader("投票系统"), 'footer' => footer(), 'user' => ['name' => $name, 'admin' => $admin]]);
    }

    /**
     * 显示添加投票页面
     * @return mixed
     */
    public function createVote() {
        $user = new User();
        if ($this->isLogin()) {
            $name = Session::get("name");
            $userInfor = $user->getUser($name);
            $grade = $userInfor['grade'];
            $admin = $userInfor['admin'];
        } else {
            $name = "";
            $admin = 0;
            $grade = 0;
            $this->error('登陆后方可发起投票', 'index');
        }
        return $this->fetch('addVote', ['header' => getHeader("发起投票—投票系统"), 'footer' => footer(), 'user' => ['name' => $name, 'admin' => $admin, 'grade' => $grade]]);
    }

    /**
     * 添加投票，数据处理
     * @return string
     */
    public function addVote(){
        $status = "error";
        $message = "操作失败";
        if ($this->isLogin()) {
            $imgOption = request()->file();
            $postMessage = Request::instance()->post();
            $imgOption == null ? $imgOption = array() : null;
            if ($this->isVote($postMessage)) {
                $status = "success";
            } else {
                $status = "error";
                $message = "信息不完整";
            }
            if ($status == "success") {
                $captchaJudge = $this->validate(array('captcha' => $postMessage['captcha']), ['captcha|验证码'=>'require|captcha']);
                if ($captchaJudge === true) {
                    $result = $this->saveVote($postMessage);
                    if ($result['status']) {
                        $result = $this->saveOption($result['voteId'], $imgOption, $postMessage['option']);
                    }
                    $status = $result['status'] ? "success" : "error";
                    $message = $result['message'];
                } else {
                    $message = "验证码错误";
                }
            }
        } else {
            $message = "还未登录,不能进行此操作";
        }
        return json_encode(['status' => $status, 'message' => $message]);
    }

    /**
     * 根据发送所来的信息判断是否符合一个投票的要求
     * @param array $postMessage
     * @return bool
     */
    private function isVote(array $postMessage) : bool {
        $is = false;
        $requireMessage = ["title", "endTime", "ano", "number", "captcha", "intro", "grade", "option"];
        foreach ($postMessage as $key => $value) {
            if (in_array($key, $requireMessage) && $value != "") {
                $is = true;
                continue;
            } else {
                $is = false;
                break;
            }
        }
        return $is;
    }

    /**
     * 保存投票
     * @param array $postVote
     * @return array 包含新增投票id，是否增加成功
     */
    private function saveVote(array $postVote) : array {
        $user = new User();
        $vote = new Vote();
        $userInfor = $user->getUser(Session::get("name"));
        if ($userInfor['grade'] < $postVote['grade']) {
            return ['status' => false, 'message' => "发起的投票等级比用户等级高"];
        }
        $newVote = [
            "create_time" => date('Y-m-d H:i:s'),
            "title" => $postVote['title'],
            "introduction" => $postVote['intro'],
            "grade" => $postVote['grade'],
            "end_time" => $postVote['endTime'],
            "create_name" => Session::get("name"),
            "anonymity" => $postVote['ano'],
            "vote_number" => $postVote['number']
        ];
        $id = $vote->addVote($newVote);
        return ['status' => true, 'voteId' => $id];
    }

    /**
     * 保存选项
     * @param int $voteId 添加选项的投票id
     * @param array $imgOption 图片选项
     * @param string $textOption 文字选项
     * @return array ['status' => , 'message' =>]
     */
    private function saveOption(int $voteId, array $imgOption, string $textOption) : array {
        $textOption = (Array)json_decode(htmlspecialchars_decode($textOption), true);
        $newOption = [];
        foreach ($textOption as $key => $value) {
            if ($key != "" && $value != "") {
                $newOption[] = [
                    "vote_id" => $voteId,
                    "img" => "null",
                    "content" => $value
                ];
            }
        }
        if (count($imgOption) > 0) {
            foreach($imgOption as $key => $file){
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['size' => 2048 * 1024])->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $newOption[] = [
                        "content" => explode("_", $key)[0] == "null0" ? "null0_" : $key,
                        "vote_id" => $voteId,
                        "img" => $info->getSaveName(),
                    ];
                }else{
                    // 上传失败获取错误信息
                    $newOption[] = [
                        "content" => explode("_", $key)[0] == "null0" ? "null0_" : $key,
                        "vote_id" => $voteId,
                        "img" => "",
                    ];
                }
            }
        }
        $option = new Option();
        $option->addOption($newOption);
        return ['status' => true, 'message' => "成功发起投票"];
    }

    /**
     * 显示投票界面
     * @return mixed
     */
    public function votingPage() {
        if ($this->isLogin()) {
            $id = Request::instance()->get("id");
            $user = new User();
            $vote = new Vote();
            $option = new Option();
            //投票信息
            $voteInfo = $vote->getVoteById($id);
            $name = Session::get("name");
            //用户信息
            $userInfor = $user->getUser($name);
            $grade = $userInfor['grade'];
            $admin = $userInfor['admin'];
            //选项信息
            $optionInfo = $option->getAllOptionById($id);
            if (!$vote->hasVote($id)) {
                $this->error("投票不存在");
            } elseif ($grade < $voteInfo['grade']) {
                $this->error('等级不够', 'index');
            } elseif ($this->isEnd($id)) {
                $this->error("投票已结束");
            } else  {
                return $this->fetch('votingPage',
                    [
                        'optionList' => $optionInfo,
                        'vote' => $voteInfo,
                        'header' => getHeader("投票"),
                        'footer' => footer(),
                        'user' => ['name' => $name, 'admin' => $admin, 'grade' => $grade]
                    ]);
            }
        } else {
            $name = "";
            $admin = 0;
            $grade = 0;
            $this->error('登陆后方可投票', 'index');
        }
    }

    /**
     * 根据投票id判断投票是否结束
     * @param $voteId
     * @return bool
     */
    private function isEnd($voteId) : bool {
        $vote = new Vote();
        $voteInfo = $vote->getVoteById($voteId);
        return strtotime($voteInfo['end_time']) < time();
    }


    public function voting() {
        $status = "error";
        $message = "操作失败";
        if ($this->isLogin()) {
            $postVoting = Request::instance()->post();
            $voteId = $postVoting['id'];
            unset($postVoting['id']);
            $postVoting = array_unique($postVoting);
            $vote = new Vote();
            $option = new Option();
            $user = new User();
            $voteLog = new VoteLog();
            $optionLog = new OptionLog();
            $username = Session::get("name");
            if (!$vote->hasVote($voteId)) {
                $message = '投票不存在';
            } elseif (!$this->isOption($voteId, $postVoting)) {
                $message = '所选选项不是该投票的';
            } elseif ($this->isEnd($voteId)) {
                $message = '投票已结束';
            } elseif ($voteLog->isVote($voteId, $username)) {
                $message = '已投过票';
            } else {
                $voteInfo = $vote->getVoteById($voteId);
                $userInfo = $user->getUser($username);
                if ($voteInfo['grade'] > $userInfo['grade']) {
                    $message = "等级不够";
                } elseif ($voteInfo['vote_number'] < count($postVoting)) {
                    $message = "投票数超过最大投票数";
                }
                else {
                    $option->addNumber($postVoting);
                    $optionLog->addLog($postVoting, $username);
                    $voteLog->addLog($voteId, $username);
                    $status = "success";
                    $message = "投票成功";
                }
            }
        } else {
            $this->error('登陆后方可投票', 'index');
        }
        return json_encode(['status' => $status, 'message' => $message]);
    }

    /**
     * 判断投票选项是不是对应的投票
     * @param int $voteId
     * @param array $voting
     * @return bool
     */
    private function isOption(int $voteId, array $voting) : bool {
        $option = new Option();
        $optionId = $option->getAllOptionIdByVoteId($voteId);
        $isOption = false;
        foreach ($voting as $key => $value) {
            if (in_array($value, $optionId)) {
                $isOption = true;
                continue;
            } else {
                $isOption = false;
                break;
            }
        }
        return $isOption;
    }

    public function resultPage() {
        if ($this->isLogin()) {
            $id = Request::instance()->get("id");
            $vote = new Vote();
            $user = new User();
            //投票信息
            $voteInfo = $vote->getVoteById($id);
            $name = Session::get("name");
            $userInfo = $user->getUser($name);
            //选项信息
            if (!$vote->hasVote($id)) {
                $this->error("投票不存在");
            } else {
                $option = new Option();
                $optionInfo = $option->getAllOptionById($id);
                if ($voteInfo['anonymity'] == 1) {
                    return $this->fetch('resultPage',
                        [
                            'optionList' => $optionInfo,
                            'vote' => $voteInfo,
                            'header' => getHeader("投票结果"),
                            'footer' => footer(),
                            'user' => ['name' => $name]
                        ]);
                } else if ($voteInfo['grade'] > $userInfo['grade']) {
                    $this->error("等级不够");
                } else {
                    $optionId = $option->getAllOptionIdByVoteId($id);
                    $optionLog = new OptionLog();
                    $optionLogs = $optionLog->getResult($optionId);
                    return $this->fetch('resultPage',
                        [
                            'optionLog' => $optionLogs,
                            'optionList' => $optionInfo,
                            'vote' => $voteInfo,
                            'header' => getHeader("投票结果"),
                            'footer' => footer(),
                            'user' => ['name' => $name]
                        ]);
                }
            }
        } else {
            $this->error('登陆后方可投票', 'index');
        }
    }

    /**
     * 显示添加用户界面
     * @return mixed
     */
    public function addUserPage() {
        $user = new User();
        if (!$this->isLogin()) {
            $this->error('登陆后方可投票', 'index');
        } elseif (!$user->isAdmin(Session::get("name"))) {
            $this->error('只有管理员才可以进行该操作', 'index');
        } else {
            $name = Session::get("name");
            $userInfo = $user->getUser($name);
            return $this->fetch('addUserPage', [
                'user' => ['admin' => 1, 'name' => $name, 'grade' => $userInfo['grade']],
                'header' => getHeader("添加用户"),
                'footer' => footer(),
            ]);
        }
    }

    public function addUser() : string {
        $status = "error";
        $message = "";
        $postMessage = Request::instance()->post();
        $user = new User();
        if (!$this->isLogin()) {
            $message = "还未登录,不能进行此操作";
        } elseif (!$user->isAdmin(Session::get("name"))) {
            $message = "只有管理员才可以进行该操作";
        } elseif (!$this->isAddUser($postMessage)) {
            $message = "信息不完整";
        } elseif ($user->hasUser($postMessage["username"])) {
            $message = "该登录名已被注册";
        } else {
            $captchaJudge = $this->validate(array('captcha' => $postMessage['captcha']), ['captcha|验证码'=>'require|captcha']);
            if ($captchaJudge === true) {
                if (!preg_match('/^(?!_)(?!.*?_$)[a-zA-Z0-9_]+$/', $postMessage['username'])) {
                    $message = "用户名非法";
                } elseif (!preg_match('/^(?!_)(?!.*?_$)[a-zA-Z0-9_]+$/', $postMessage['pwd1'])) {
                    $message = "密码非法";
                } elseif ($postMessage['pwd1'] != $postMessage['pwd2']) {
                    $message = "两次密码不一致";
                } else {
                    $userInfo = $user->getUser(Session::get("name"));
                    if ($userInfo['grade'] < $postMessage['grade']) {
                        $message = "你不能添加该等级用户";
                    } else {
                        $user->addUser($postMessage);
                        $status = "success";
                        $message = "注册成功";
                    }
                }
            } else {
                $message = "验证码错误";
            }
        }
        return json_encode(['status' => $status, 'message' => $message]);
    }

    /**
     * 根据Session判断是否登陆
     * @return bool
     */
    private function isLogin() : bool {
        $user = new User();
        return Session::has("name") && $user->hasUser(Session::get("name"));
    }


    /**
     * 判断是否符合添加用户要求
     * @param array $postMessage
     * @return bool
     */
    private function isAddUser(array $postMessage) : bool {
        $is = false;
        $requireMessage = ["username", "pwd2", "pwd1", "captcha", "admin", "grade"];
        foreach ($postMessage as $key => $value) {
            if (in_array($key, $requireMessage) && $value != "") {
                $is = true;
                continue;
            } else {
                $is = false;
                break;
            }
        }
        return $is;
    }



    public function test() {
//        $user = new User();
//        var_dump($user->isAdmin("admin"));
//        $vote = new Vote();
//        return $vote->getVoteByGrade(0);
//        dump(json_decode('{"" : "w","" : "w"}', true));
//        $files = request()->file();
//        foreach($files as $key => $file){
//            // 移动到框架应用根目录/public/uploads/ 目录下
//            $info = $file->validate(['size' => 2048 * 1024])->move(ROOT_PATH . 'public' . DS . 'uploads');
//            if($info){
//                echo $key;
//                echo $info->getSaveName();
//            }else{
//                // 上传失败获取错误信息
//                echo $file->getError();
//            }
//        }
//        echo date('Y-m-d');
//
//        $arr = [];
//        for ($i = 0; $i < 4; ++$i) {
//            $arr[] = $i;
//        }
//        dump($arr);
//        var_dump(strtotime("2016-2-4 12:3:3")  );
//        var_dump(time());
//        echo "<input type='checkbox' id='1' value='2'><script>alert(document.getElementById('1').value)</script>";
//    var_dump(json_decode("{'1':'23',' ':' '}"));
//        $string = '{"1":"123","": ""}';
//        var_dump($string);
//        $string = {"firstName": "Brett"};
//    var_dump(json_decode( $string, true));
//        $string = "null0_dasdasf";
//        var_dump(explode("_",$string)[0]);
//        $option = new OptionLog();
//        dump($option->addNumber([2 => '13']));
//        echo "<script>alert('' + 1)</script>";
//        $id = "63";
//        dump($option->getResult(['11', '12', '13']));
//        dump(in_array("10",$option->getAllOptionIdByVoteId($id)));
//        $arr = array(
//            "a" => 12,
//        );
//        dump(in_array("12", $arr));
//        $input = ['2' => 3, '3' => 4, '4' => 3];
//        $result = array_unique($input);
//        dump($result);

        echo preg_match('/^(?!_)(?!.*?_$)[a-zA-Z0-9_]+$/',"eqw") ? 'yes' : 'no';

    }
}
