<?php

/**
 * 给接口文件提供辅助方法
 */
namespace Api\Controller;
use Think\Controller;

class FunController extends Controller
{

    public $r;
    // 日志级别 从上到下，由低到高
    const EMERG = 'EMERG';
    // 严重错误: 导致系统崩溃无法使用
    const ALERT = 'ALERT';
    // 警戒性错误: 必须被立即修改的错误
    const CRIT = 'CRIT';
    // 临界值错误: 超过临界值的错误，例如一天24小时，而输入的是25小时这样
    const ERR = 'ERR';
    // 一般错误: 一般性错误
    const WARN = 'WARN';
    // 警告性错误: 需要发出警告的错误
    const NOTICE = 'NOTIC';
    // 通知: 程序可以运行但是还不够完美的错误
    const INFO = 'INFO';
    // 信息: 程序输出信息
    const DEBUG = 'DEBUG';
    // 调试: 调试信息
    const SQL = 'SQL';
    // SQL：SQL语句 注意只在调试模式开启时有效
    // 日志记录方式
    const SYSTEM = 0;

    const MAIL = 1;

    const FILE = 3;

    const SAPI = 4;
    // 日志信息
    static $log = array();
    // 日期格式
    static $format = '[ c ]';

    static function write ($message, $level = self::ERR, $type = '', $destination = '', 
            $extra = '')
    {
        $now = date(self::$format);
        $type = $type ? $type : C('LOG_TYPE');
        if (self::FILE == $type) { // 文件方式记录日志
            if (empty($destination))
                $destination = LOG_PATH . date('y_m_d') . '.log';
                // 检测日志文件大小，超过配置大小则备份日志文件重新生成
            if (is_file($destination) &&
                     floor(C('LOG_FILE_SIZE')) <= filesize($destination))
                rename($destination, 
                        dirname($destination) . '/' . time() . '-' .
                         basename($destination));
        } else {
            $destination = $destination ? $destination : C('LOG_DEST');
            $extra = $extra ? $extra : C('LOG_EXTRA');
        }
        error_log(
                "{$now} " . $_SERVER['REQUEST_URI'] .
                         " | {$level}: {$message}\r\n", $type, $destination, 
                        $extra);
        // clearstatcache();
    }

    public function getIP()
    {
        $ip=getenv('REMOTE_ADDR');
        $ip_ = getenv('HTTP_X_FORWARDED_FOR');
        if (($ip_ != "") && ($ip_ != "unknown"))
        {
            $ip=$ip_;
        }
        return $ip;
    }

    /**
     * 是否有下级分类
     *
     * @param int $tasktypeID
     *            类型ID
     * @return string 返回SQL中IN所使用ID字符串
     */
    public function getTaskTypeId ($tasktypeID = 1)
    {
        // echo $tasktypeID;
        $tasktype = M('tasktype'); // 实例化任务类型表
        $re = $tasktype->where('F_PARENTID=' . $tasktypeID)
            ->field('F_TYPEID')
            ->select();
        // echo $tasktype->getLastsql();
        // pt($re);
        if (count($re) == 0) {
            return $tasktypeID;
        } else {
            foreach ($re as $key => $val) {
                foreach ($val as $k => $v) {
                    $this->r .= $v[0] . ",";
                }
            }
            $this->r = rtrim($this->r, ",");
            return $this->r;
        }
    }

    public function getTypeName ($type = 'json')
    {
        $tasktype = M('tasktype'); // 实例化任务类型表
        $re = $tasktype->where('F_PARENTID=0')->select();
        if ($type == 'json') {
            echo json_encode($re);
        } else {
            return $re;
        }
    }
    
    // 取连续签到的次数
    public function getcheckinssum ($userid)
    {
        $s = strtotime(date('Y-m-d 23:59:59', strtotime("-6 day")));
        $e = time();
        if (date('m', $s) != date('m', $e)) {
            $s = strtotime(date('Y-m-01 00:00:00'));
        }
        $map['f_strats'] = 0;
        $map['f_userid'] = $userid;
        $map['f_datetime'] = array(
                array(
                        'egt',
                        $s
                ),
                array(
                        'elt',
                        $e
                )
        );
        $re = M('checkins')->where($map)->count();
        // echo $re;
        if ($re >= 6) {
            $map_1['f_strats'] = 1;
            M('checkins')->where($map)->save($map_1);
            // echo M('checkins')->getLastsql();
        }
        // echo M('checkins')->getLastsql();
        // pt($map['f_datetime']);
        return $re;
    }
    
    // 加减抽奖次数
    public function lotterysum ($userid, $sum = 1, $addtype = 1)
    {
        $m['f_userid'] = $userid;
        $re = M('lottery')->where($m)->count();
        if ($re == 0) {
            $m['f_lottery_sum'] = 1;
            $m['f_datetime'] = time();
            M('lottery')->add($m);
        } else {
            if ($addtype == 1) {
                M('lottery')->where('f_userid=' . $userid)->setInc(
                        'f_lottery_sum', $sum);
            } else {
                M('lottery')->where('f_userid=' . $userid)->setDec(
                        'f_lottery_sum', $sum);
            }
        }
        // echo M('lottery')->getLastsql();
    }

    /**
     * ************************************************************
     *
     * 使用特定function对数组中所有元素做处理
     *
     * @param
     *            string &$array 要处理的字符串
     * @param string $function
     *            要执行的函数
     * @return boolean $apply_to_keys_also 是否也应用到key上
     * @access public
     *         ***********************************************************
     */
    function arrayRecursive (&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++ $recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key], $function, 
                        $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }
            
            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter --;
    }

    /**
     * ************************************************************
     * 将数组转换为JSON字符串（兼容中文）
     *
     * @param array $array
     *            要转换的数组
     * @return string 转换得到的json字符串
     * @access public
     *         ***********************************************************
     */
    public function JSON ($array)
    {
        $this->arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    }

    /**
     * ************************************************************
     * 分享数据的判定
     *
     * @param
     *            int userid 用户ID
     * @param
     *            int taskid 任务ID
     * @return string 是否
     *         ***********************************************************
     */
    function isShare ($userid, $taskid)
    {
        $map['f_userid'] = $userid;
        $map['f_taskid'] = $taskid;
        $map['f_shopingtype'] = 1;
        $sum = M('share')->where($map)->count();
        if ($sum > 1) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * ************************************************************
     * PHP判断用户权限
     *
     * @param int $classaccess
     *            栏目权限
     * @param int $actionaccess
     *            功能权限
     * @return bool 是否
     *         ***********************************************************
     */
    function isAccess ($classaccess, $actionaccess = '000000')
    {
        // var_dump(session('accessvalue')) ;
        // var_dump($classaccess) ;
        // exit;
        $checkaccess_key = "";
        if (strstr(session('accessvalue'), $classaccess)) {
            // 有权限
            if ($actionaccess != '000000') { // 看操作的是不是栏目
                                             // 否：继续查找功能权限
                $caccess = explode("{||}", session('accessvalue')); // 进行第一次分组
                                                                    // dump($caccess);
                foreach ($caccess as $key => $val) {
                    $checkaccess = explode("|", $val); // 进行第二次分组
                                                       // $checkaccess_key =
                                                       // array_search($classaccess,$checkaccess);
                    if (in_array($classaccess, $checkaccess)) {
                        $checkaccess_key = $key;
                    }
                }
                if (! strstr($caccess[$checkaccess_key], $actionaccess)) {
                    $this->error('你无权使用此功能，如需使用联系管理员');
                }
            }
        } else {
            $this->error('你无权查看本栏目，如需使用联系管理员');
        }
    }

    /**
     * ************************************************************
     * JS判断用户权限
     *
     * @param int $classaccess
     *            栏目权限
     * @param int $actionaccess
     *            功能权限
     * @return bool 是否
     *         ***********************************************************
     */
    function isJsAccess ()
    {
        // echo session('accessvalue');
        // exit;
        $classaccess = I('get.classaccess');
        $actionaccess = I('get.actionaccess', '000000');
        $checkaccess_key = "";
        
        if (strstr(session('accessvalue'), $classaccess)) {
            // echo $classaccess.$actionaccess.session('accessvalue');
            // 有权限
            if ($actionaccess != '000000') { // 看操作的是不是栏目
                                             // 否：继续查找功能权限
                $caccess = explode("{||}", session('accessvalue')); // 进行第一次分组
                foreach ($caccess as $key => $val) {
                    $checkaccess = explode("|", $val); // 进行第二次分组
                    if (in_array($classaccess, $checkaccess)) {
                        $checkaccess_key = $key;
                    }
                }
                if (! strstr($caccess[$checkaccess_key], $actionaccess)) {
                    // echo 'a';
                    echo "0";
                } else {
                    echo "1";
                }
            }
        } else {
            // echo 'b';
            echo "0";
        }
    }

    /**
     * 认证token
     *
     * @return bool
     */
    public function verifytoken ($retoken, $retime)
    {
        $clientid = "17804ac281e6ddda";
        $clientkey = $this->getKey($clientid);
        $mobile_version = "2015-10-01";
        // echo md5($clientid.$clientkey.$mobile_version.$retime);
        $cToken = md5($clientid . $clientkey . $mobile_version . $retime);
        return $cToken == $retoken ? true : false;
    }

    /**
     * 通过id查找对应的key
     *
     * @param
     *            $clientid
     * @return int
     */
    public function getKey ($clientid)
    {
        $re = M("token")->field("f_clientkey")
            ->where("f_clientid='" . $clientid . "'")
            ->find();
        return $re['f_clientkey'];
    }


    //创蓝短信
    static public function cl_sms($map)
    {
        $data = "您的验证码为" . $map['F_VOICECODE'] . "，请于30分钟内正确输入验证码";
        $post_data = array();
        $post_data['account'] = iconv('GB2312', 'GB2312', "lkx2015");
        $post_data['pswd'] = iconv('GB2312', 'GB2312', "Lkx20150101");
        $post_data['mobile'] = $map['F_VOICEPHONE'];
        $post_data['msg'] = mb_convert_encoding("$data", 'UTF-8', 'UTF-8');
        $post_data['needstatus'] = 'true';
        $url = 'http://222.73.117.158/msg/HttpBatchSendSM?';
        foreach ($post_data as $k => $v) {
            $o .= "$k=" . urlencode($v) . "&";
        }
        $post_data = substr($o, 0, -1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $co = substr($result, 15, 1);
        if ($co == '0'){
            M('voicecode')->add($map);
            $out_arr['error_code'] = "success";
            $out_arr['error_text'] = "短信发送成功";
        }else{
            $out_arr['error_code'] = substr($result, 15, 3);
            $out_arr['error_text'] = "短信发送失败";
        }
        return $out_arr;
    }
}
