<?php
namespace Api\Controller;
use Think\Controller;

// 运营用JAVA接口的Servlet常量
define('YY_NOTICE_URL', 'NoticeServlet');                  // 公告
define('YY_WORK_REPORT_URL', 'WorkReportServlet');         // 工作报告
define('YY_GPS_URL', 'GpsServlet');                        // 签到
define('YY_USER_CONTACTS_URL', 'UserContactsServlet');     // 通讯录
define('YY_CUSTOMER_URL', 'CustomerServlet');              // 客户管理
define('YY_CUSTOMER_CLIENT_URL', 'CustomerClientServlet'); // 客户联系人
define('YY_DICT_URL', 'DictServlet');                      // 字典
define('YY_COMMON_PERSONAL_URL', 'CommonPersonalServlet'); // 常用客户类型所属人维护
define('YY_NOTICE_BOARD_URL', 'NoticeBoardServlet');       // 公告栏目管理
define('YY_ATTACHMENT_URL', 'AttachmentServlet');          // 附件记录操作
define('YY_SIGN_ADDRESS_URL', 'SignAddressServlet');       // 签到地址操作
define('YY_ADDRESS_URL', 'AddressServlet');                // 地址操作
define('YY_PROCESS_URL', 'ProcessServlet');                // 附件记录操作
define('YY_MESSAGE_URL', 'MessageServlet');                // 消息操作
define('YY_INTERGRALSERVLET_URL', 'IntegralServlet');      // 地址操作
define('YY_SCHEDULE_URL', 'ScheduleServlet');              // 日程操作
define('YY_BIZ_URL', 'BizServlet');                        // 商机操作
define('YY_VISITPLAN_URL', 'VisitPlanServlet');            // 拜访计划操作
define('YY_VISITRECORD_URL', 'VisitRecordServlet');        // 拜访记录操作
define('YY_CONTRACT_URL', 'ContractServlet');              // 合同操作
define('YY_PAYRECORD_URL', 'PayrecordServlet');            // 回款操作
define('YY_OMS_URL', 'oms');                               // 分销操作
define('YY_DASHBOARD_URL','DashboardServlet');             //业绩看板
define('YY_METTING_URL','MakeMettingServlet');             //电话会议
/**
 * 智慧运营平台请求转发控制器
 *
 * @author zhoushuangsheng
 * @since  1.0 2015/08/25
 */
class YYInfoController extends Controller {
    private $in_arr,$in_file,$out_arr,$resp,$token;
    //=================通过接口方法=========================================================
    function conf($data=null) {
        header("Content-Type: text/html;charset=utf-8");
        if ($data == null)
        {
        	$this->in_arr = array_merge($_GET,$_POST);
        }else {
        	$this->in_arr = $data;
        
            foreach ($this->in_arr as $key=>$age) {
                if(is_array($this->in_arr[$key])) {
                    $this->in_arr[$key] = ($this->in_arr[$key]);
                    foreach ($this->in_arr[$key] as $key1=>$age1) {
                        if(is_array($this->in_arr[$key][$key1])) {
                            $this->in_arr[$key][$key1] = urlencode($this->in_arr[$key][$key1]);
                        } else {
                            $this->in_arr[$key][$key1] = urlencode((string)$this->in_arr[$key][$key1]);
                        }
                    }
                } else {
                    $this->in_arr[$key] = urlencode((string)$this->in_arr[$key]);
                }
            }
        }

//        echo json_encode($this->in_arr);

        //将json转化为array
        foreach ($this->in_arr as $key => $value) {
        	$arrayValue = json_decode($this->in_arr[$key]);
        	if ($arrayValue != "" && !is_numeric($arrayValue)) {
        		$this->in_arr[$key] = $this->object_array($arrayValue);
        	}
        }

        //写入日志
        \Think\Log::write("YY_IN:::".json_encode($this->in_arr),"NOTICE");
        
        $this->in_file = $_FILES;
        if (isset($this->in_arr['debugin'])) {
            pt($this->in_arr);
            if (!empty($this->in_file)) {
                pt($this->in_file);
            }
        } else {
            //处理COMMAND
            switch ($this->in_arr['command']) {
                //==============0.1企业登录,获取企业列表======================
                case 'companylogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->companylogin($this->in_arr['mobile'],$this->in_arr['password']);
                    $this->out_arr = json_decode($re, true);
                    break;
                //==============0.2企业登录,获取用户登录信息======================
                case 'userlogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->userlogin($this->in_arr['companyId'],$this->in_arr['mobile']);
                    $this->out_arr = json_decode($re, true);
                    if((int)$this->out_arr["list"]["user"]["headLogo"]==0){
                        $this->out_arr['list']["user"]["imgUrl"] = "";
                    }else{
                        $headlogo = $this->out_arr["list"]["user"]["headLogo"];
                        $re = M("files")->where("f_id=".$headlogo)->find();
                        $this->out_arr['list']["user"]["imgUrl"] = $re["f_filepath"].$re["f_filename"];
                    }
                    break;
                //=====忘记密码===============
                case 'forgetpw':
                    $this->out_other();
                    $re = A('Api/Jhttp')->getUserinfo($this->in_arr['phone']);
                    $arr = json_decode($re, true);
                    $errorCode = $arr['resCode'];
                    if ($errorCode == '000000') {
                        $re_1 = A('Api/Jhttp')->withdrawal(1, $arr['list']['userId'], $this->in_arr['password']);
                        $arr_1 = json_decode($re_1, true);
                        $errorCode_1 = $arr_1['resCode'];
                        if ($errorCode_1 == '000000') {
                            $this->out_arr['error_code'] = 'success';
                            $this->out_arr['error_text'] = '';
                        } else {
                            $this->out_arr['error_code'] = 'forgetpw_sys_error';
                            $this->out_arr['error_text'] = A('Api/Jhttpcode')->searchCode($errorCode_1);
                        }
                    } else {
                        $this->out_arr['error_code'] = 'modipw_sys_error';
                        $this->out_arr['error_text'] = A('Api/Jhttpcode')->searchCode($errorCode);
                    }
                    break;
                //==============0.3企业注册======================
                case 'zsreguser':
//                    pt($this->in_arr);
//                    exit;
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $companyname = $this->in_arr['companyname'];
                    $phone = $this->in_arr['mobile'];
                    $password = $this->in_arr['password'];
                    $truename = $this->in_arr['truename'];
                    $flattype = empty($this->in_arr['flattype']) ? $this->in_arr['flattype'] : 2;
                    $invitationcode = empty($this->in_arr['invitationcode'])?0:$this->in_arr['invitationcode'];
                    //生成云之讯client
                    $client_arr = A("Api/Api")->clients($phone);
                    if($client_arr["error_code"]=="success"){
                        $clientNumber = $client_arr["resp"]["client"]["clientNumber"];
                        $clientPwd = $client_arr["resp"]["client"]["clientPwd"];
                    }
                    //发送给用户中心
                    $re = A('Jhttp')->companyAdd($phone, $password, $companyname, $flattype,$truename,$state=5,$invitationcode,$clientNumber,$clientPwd);
                    $arr = json_decode($re, true);
//                    var_dump("1:".$re);
                    $errorCode = $arr['resCode'];
                    if ($errorCode == '000000') {
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        //为该企业注册的第一个用户分配最高级权限(即超级管理员))
//                        echo "phone:".$phone."----password:".$password;
                        $re2 = A('Jhttp')->companylogin($phone, $password);
                        $arr = json_decode($re2, true);
//                        var_dump($arr);
//                        echo $invitationcode."=======".$arr["list"][0]["companyId"];
                        if($invitationcode){
//                            echo "000000000000000000000";
                            $companyId = $arr["list"][0]["companyId"];
                        }else{
//                            echo "1111111111111111111";
                            foreach ($arr["list"] as $k => $v) {
                                if ($v["companyName"] == $companyname) {
                                    $companyId = $v["companyId"];
                                }
                            }
                        }

//                        echo "phone:".$phone."----companyId:".$companyId;
                        $re3 = A('Jhttp')->userlogin($companyId, $phone);

                        $arr1 = json_decode($re3, true);

                        $userid = $arr1['list']['user']['userId'];

                        $errorCode = $arr1['resCode'];
                        if ($errorCode == '000000') {
                            $map["f_company_id"] = $companyId;
                            $map["f_access"] = "a1,a2,a3,a4,b1,b2,b3,c1,c2,c3,c4,d1,d2,d3,e1";
                            $map["f_name"] = "超级管理员";
                            $re4 = M("role")->add($map);
                            if ($re4 != 0) {
                                $data["f_user_id"] = $userid;
                                $data["f_role_id"] = $re4;
                                $data["f_company_id"] = $companyId;
                                $re5 = M("user_role")->add($data);
                            }
                        }
                    }
//                    var_dump("3:".$re3);
//                    $this->out_arr['list'] = $arr1;  //分销id


                    break;

                //==============24.1修改个人信息======================(获取个人信息在登录时已经提供)
                //add by lzt 2016-1-26
                case 'modiUserInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $fieldkey = $this->in_arr['fieldkey'];
                    $key = explode('|', $fieldkey);
                    $fieldval = $this->in_arr['fieldval'];
                    $val = explode('|', $fieldval);
                    $url = "";
                    for ($i = 0; $i < count($key); $i++) {
                        $url .= "&" . $key[$i] . "=" . $val[$i];
//
//                        if ($key[$i] == 'nickName') {
//                            $q = A('Jhttp')->getUserinfo2($this->in_arr['userid']);
//                            $arrUer = json_decode($q, true);
//                            $body = array('nickname' => $val[$i]);
//                            A('Api/Easemob')->easemob_modi_nickname($body, $arrUer['list']['mobile']);
//                        }

                    }
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->modiUserInfo($this->in_arr['userId'],$url);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.2 新增和修改工作经历======================
                //add by lzt 2016-1-26
                //$userId,$companyId,$orderId,$companyName,$userPosition,$beginDate,$endDate,$jobDescription,$id=0
                //$userId,$companyId,$orderId,$companyName,$userPosition,$beginDate,$endDate,$jobDescription,$id=0
                case 'workInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->workInfo($this->in_arr['userId'],$this->in_arr['companyId'],$this->in_arr['orderId'],
                        $this->in_arr['companyName'],$this->in_arr['userPosition'],$this->in_arr['beginDate'],
                        $this->in_arr['endDate'],$this->in_arr['jobDescription'],$this->in_arr['id']);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.3 查询工作经历======================
                //add by lzt 2016-1-27
                //$userId,$companyId,$orderId,$companyName,$userPosition,$beginDate,$endDate,$jobDescription,$id=0
                case 'getWorkInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->getWorkInfo($this->in_arr['userId']);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.4 删除工作经历======================
                //add by lzt 2016-1-26
                case 'delworkInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->delworkInfo($this->in_arr['id']);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.3 新增修改教育经历======================
                //add by lzt 2016-1-26
                //$userId,$companyId,$orderId,$userSchool,$userDepartment,$userEducation,$beginDate,$endDate,$moreDescription,$id=0
                case 'eduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->eduInfo($this->in_arr['userId'],$this->in_arr['companyId'],$this->in_arr['orderId'],
                        $this->in_arr['userSchool'],$this->in_arr['userDepartment'],$this->in_arr['userEducation'],$this->in_arr['beginDate'],
                        $this->in_arr['endDate'],$this->in_arr['moreDescription'],$this->in_arr['id']);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.5 查询教育经历======================
                //add by lzt 2016-1-26
                case 'getEduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->getEduInfo($this->in_arr['userId']);
                    $this->out_arr = json_decode($re, true);
                    break;

                //==============24.4 删除教育经历======================
                //add by lzt 2016-1-26
                case 'deleduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $re=A('Api/Jhttp') ->deleduInfo($this->in_arr['id']);
                    $this->out_arr = json_decode($re, true);
                    break;


                //===============fx0.1经销商登录接口=======================
                case "fx_login":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("phone","password");
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['user']['userId'] = '10185';  //用户id
                    $this->out_arr['user']['companyId'] = '622'; //公司id
                    $this->out_arr['user']['fxId'] = '622';  //分销id

                    break;

                //===============fx0.2经销商 销售 分销订货 =======================
                case "fx_orderGoods":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId"); //分销商id,公司id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';

                    $list = array(
                        array(
                            'companyId' => '110', //厂商id
                            'companyName' => '公司名称', //厂商名称
                            'banner_url' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //厂商banner图片地址
                        ),
                        array(
                            'companyId' => '112',
                            'companyName' => '公司名称',
                            'banner_url' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg',
                        )
                    );
                    $this->out_arr['list'] = $list;

                    break;


                //===============fx0.3经销商 销售 列表=======================
                case "fx_goodsList":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                        $is_param = array("fxId","companyId"); //分销商id,公司id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';

                    $this->out_arr['promotion_num'] = '9'; //促销数
                    $this->out_arr['new_num'] = '6'; //新购数
                    $this->out_arr['order_num'] = '3'; //订单数

                    $list = array(
                        array(
                            'goodsId' => '1', //商品id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费', //商品描述
                            'goodsPrice' => '800', //商品价格,单位(元)
                            'goodsLimit' => 8, //库存
                            'goodsSales' => 28, //商品销量
                            'goodsStartTime' => '昨天16:00', //商品上架时间
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        ),
                        array(
                            'goodsId' => '2', //商品id
                            'goodsName' => 'doodoo时尚女包手量单', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费,追求年轻时尚', //商品描述
                            'goodsPrice' => '799', //商品价格,单位(元)
                            'goodsLimit' => '8', //库存
                            'goodsSales' => '28', //商品销量
                            'goodsStartTime' => '今天16:00', //商品上架时间
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        )
                    );
                    $this->out_arr['list'] = $list;

                    break;

                //===============fx0.4经销商 销售 促销=======================
                case "fx_promotion":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId"); //分销商id,公司id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';

                    $list = array(
                        array(
                            'goodsId' => '1', //商品id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费', //商品描述
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'goodsPromotionPrice' => '499', //商品促销价格,单位(元)
                            'goodsLimit' => 8, //库存
                            'goodsSales' => 28, //商品销量
                            'goodsStartTime' => '昨天16:00', //商品上架时间
                            'goodsEndTime' => '2015/07/22', //促销商品截止时间
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        ),
                        array(
                            'goodsId' => '2', //商品id
                            'goodsName' => 'doodoo时尚女包手量单', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费,追求年轻时尚', //商品描述
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'goodsPromotionPrice' => '499', //商品促销价格,单位(元)
                            'goodsLimit' => '8', //库存
                            'goodsSales' => '28', //商品销量
                            'goodsStartTime' => '今天16:00', //商品上架时间
                            'goodsEndTime' => '2015/07/22', //促销商品截止时间
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        )
                    );
                    $this->out_arr['list'] = $list;

                    break;

                //===============fx0.5经销商 销售 商品详情=======================
                case "fx_goodsDetail":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId","goodsId"); //分销商id,公司id,商品id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';

                    $list = array(
                        array(
                            'goodsId' => '1', //商品id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费', //商品描述
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'goodsPromotionPrice' => '499', //商品促销价格,单位(元)
                            'goodsLimit' => 8, //库存
                            'goodsPersonLimit' => 2, //每人限购数
                            'goodsSales' => 28, //商品销量
                            'goodsEndTime' => '2015/07/22', //促销商品截止时间
                            'goodsColors' => '红色 蓝色 黑色', //颜色分类
                            'goodsMaterials' => 'PVC 不锈钢', //材质分类
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        )
                    );
                    $this->out_arr['list'] = $list;

                    break;

                //===============fx0.6经销商 销售 订购清单=======================
                case "fx_cart":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId"); //分销商id,公司id,商品id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['totalMoney'] = 199; //总价

                    $list = array(
                        array(
                            'goodsId' => '1', //商品id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费', //商品描述
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'goodsPromotionPrice' => '499', //商品促销价格,单位(元)
                            'goodsPersonLimit' => 2, //每人限购数
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => 'M', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        ),
                        array(
                            'goodsId' => '1', //商品id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsDesc' => '再现手工制品工艺的经典，融入国际最新最潮流的前沿设计，打造大众化消费', //商品描述
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'goodsPromotionPrice' => '499', //商品促销价格,单位(元)
                            'goodsPersonLimit' => 2, //每人限购数
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => 'M', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                        )
                    );
                    $this->out_arr['list'] = $list;

                    break;

                //===============fx0.7经销商 销售 订购列表=======================
                case "fx_orderList":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId"); //分销商id,公司id,商品id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['totalOrderNum'] = 5; //总订单数
                    $this->out_arr['noPayOrderNum'] = 3; //待付款订单数
                    $this->out_arr['sendOrderNum'] = 5; //待发货订单数
                    $this->out_arr['receivedOrderNum'] = 5; //待收货订单数

                    $list = array(
                        array(
                            'orderId' => '113668233', //订单id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => '250ml*2', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                            'orderStatus' => '交易完成', //订单状态
                        ),
                        array(
                            'orderId' => '113668233', //订单id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => '250ml*2', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                            'orderStatus' => '待付款', //订单状态
                        ),
                        array(
                            'orderId' => '113668233', //订单id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => '250ml*2', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                            'orderStatus' => '等待发货', //订单状态
                        ),
                        array(
                            'orderId' => '113668233', //订单id
                            'goodsName' => '时尚靓丽韩版meidu包包', //商品名称
                            'goodsPrice' => '999', //商品价格,单位(元),原价
                            'buyNum' => 6, //购买数量
                            'goodsColor' => '红色', //商品颜色
                            'goodsSize' => '250ml*2', //商品尺码
                            'goodsLogo' => 'http://hdn.xnimg.cn/photos/hdn221/20130619/1120/h_main_Yz4F_750d000004e4111a.jpg', //商品图片地址
                            'orderStatus' => '已发货', //订单状态
                        ),
                    );
                    $this->out_arr['list'] = $list;

                    break;

                //===============fx0.8经销商 销售 订单状态(待发货，已发货，已收货)=======================
                case "fx_orderStatus":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId","orderId"); //分销商id,公司id,订单id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['orderStatus'] = '代付款'; //订单状态
                    $this->out_arr['orderNumber'] = '5434545642179216'; //订单号
                    $this->out_arr['orderTime'] = '2015-04-09 17:24'; //下单时间
                    $this->out_arr['orderMoney'] = '7900'; //订单金额
                    $this->out_arr['goodsMoney'] = '7900'; //商品金额
                    $this->out_arr['payHistory'] = '未付款'; //付款记录
                    $this->out_arr['sendStatus'] = '备货中/未发货'; //出库/发货信息
                    $this->out_arr['logisticsCompany'] = '申通物流'; //物流公司
                    $this->out_arr['logisticsNumber'] = '89451103743185'; //物流单号
                    $this->out_arr['sendDate'] = '2015-12-5'; //发货日期

                    break;

                //===============fx0.9经销商 销售 订单详情=======================
                case "fx_orderDetail":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId","orderId"); //分销商id,公司id,订单id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['orderStatus'] = '代付款'; //订单状态
                    $this->out_arr['orderNumber'] = '5434545642179216'; //订单号
                    $this->out_arr['orderTime'] = '2015-04-09 17:24'; //下单时间
                    $this->out_arr['orderMoney'] = '7900'; //订单金额
                    $this->out_arr['delMoney'] = '100'; //优惠金额
                    $this->out_arr['goodsMoney'] = '7800'; //实付款(即商品金额)
                    $this->out_arr['payNumber'] = '8797845642'; //付款单号
                    $this->out_arr['accountName'] = 'sam公司'; //账户名称
                    $this->out_arr['accountBank'] = '中国招商银行杭州支行'; //开户银行
                    $this->out_arr['accountNumber'] = '89451103743185'; //开户账号

                    break;

                //===============fx1.0经销商 销售 物流详情=======================
                case "fx_logisiticsDetail":
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';

                    //参数不能为空
                    $is_param = array("fxId","companyId","orderId"); //分销商id,公司id,订单id
                    if(!$this->isset_F($is_param)){
                        $this->out_arr['error_code'] = "false";
                        $this->out_arr['error_text'] = '缺少必传参数';
                        break;
                    }

                    //模拟数据
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['orderStatus'] = '已发货'; //订单状态
                    $this->out_arr['orderNumber'] = '5434545642179216'; //订单号
                    $this->out_arr['orderTime'] = '2015-04-09 17:24'; //下单时间
                    $this->out_arr['logisticsHtml'] = ''; //物流信息的html

                    break;

                //==============1.1新增公告接口======================
//                case 'saveNotice':
                //==============1.2修改公告附件标识接口======================
                case 'updateNoticeAttachFlag':
                //==============1.3修改公告静态页面路径======================
                case 'updateHTMLPath':
                //==============1.4删除公告接口======================
                case 'delNotice':
                //==============1.5查询公告列表接口======================
//                case 'getNoticeList':
                //==============1.6查看公告详情接口======================
                case 'viewNotice':
                //==============1.7获取公告访问信息列表接口======================
                case 'getVisitList':
                //==============1.8公告置顶操作接口======================
                case 'topMessage':
                //==============1.9查询公告反馈类型列表接口======================
                case 'getNoticeCommentType':
                //==============1.10新增公告反馈接口======================
                case 'addNoticeComment':
                //==============1.11查询公告反馈列表接口======================
                case 'getNoticeComment':
                //==============1.12统计用户未读的公告数量接口======================
                case 'notViewNotice':
                //==============1.13获取公告ID接口======================
                case 'getNoticeId':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 1.7获取公告访问信息列表接口的返回列表名字不是默认值list
                    $list_key = ($this->in_arr['command'] === 'getVisitList') ? 'visitList' : 'list';
                    // 1.2修改公告附件标识接口与2.5修改工作报告附件标识接口的command重复,需要重新设定command
                    if ($this->in_arr['command'] === 'updateNoticeAttachFlag') {
                        $this->in_arr['command'] = 'updateAttachFlag';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_NOTICE_URL, $list_key);
                    break;
                //==============2.1获取未提交日报日期接口======================
                case 'getReportBeforeNotDate':
                //==============2.2获取工作报告审阅人======================
                case 'getWorkSet':
                //==============2.3设置工作报告审阅人接口======================
                case 'saveWorkSet':
                //==============2.4工作报告新增与编辑接口======================
                case 'operateWorkReport':
                //==============2.5修改工作报告附件标识接口======================
                case 'updateWorkReportAttachFlag':
                //==============2.6获取查阅工作报告列表接口======================
                case 'getCheckWorkReportList':
                //==============2.7工作报告查阅接口======================
                case 'checkWorkReport':
                //==============2.8工作报告查询接口======================
                case 'queryWorkReport':
                //==============2.9工作报告新增评论接口======================
                case 'saveWorkReportComment':
                //==============2.10工作报告评论查看接口======================
                case 'viewWorkReportComment':
                //==============2.11查看工作报告详情======================
                case 'viewWorkReport':
                //==============2.12获取工作报告ID接口==============
                case 'getWorkReportId':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 2.5修改工作报告附件标识接口与的1.2修改公告附件标识接口command重复,需要重新设定command
                    if ($this->in_arr['command'] === 'updateWorkReportAttachFlag') {
                        $this->in_arr['command'] = 'updateAttachFlag';
                    }
                    $list_key = 'list';
                    switch ($this->in_arr['command']) {
                        // 2.6获取查阅工作报告列表接口
                        case 'getCheckWorkReportList':
                        // 2.8工作报告查询接口
                        case 'queryWorkReport':
                            $list_key = 'reportList';
                            break;
                        // 2.10工作报告评论查看接口
                        case 'viewWorkReportComment':
                            $list_key = 'item';
                            break;
                        // 2.11查看工作报告详情
                        case 'viewWorkReport':
                            $list_key = 'report';
                            break;
                        default:
                            break;
                    }
                //处理附件
                $fileid = $this->in_arr['workReportFid'];
                if(empty($fileid)){
                    $this->in_arr['attachCount'] = '0';
                }else{
                    $this->in_arr['attachCount'] = (string)count(explode(',',$fileid));
                    $map['f_id'] = array('in',$fileid);
                    $re_file = M("files")->where($map)->select();
                    foreach($re_file as $key => $v){
                        $i = $key+1;
                        $this->in_arr['attachs']['attach'.$i]['fileType'] = $v['f_filetype'];
                        $this->in_arr['attachs']['attach'.$i]['tabName'] = "workReport";
                        $this->in_arr['attachs']['attach'.$i]['displayName'] = $v['f_oldfilename'];
                        $this->in_arr['attachs']['attach'.$i]['url'] = "file=".base64_encode($v['f_filepath'].$v['f_filename']);
                        $this->in_arr['attachs']['attach'.$i]['size'] = $v['f_filesize'];
                    }
                }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_WORK_REPORT_URL, $list_key);

//                    exit;
                    if($this->in_arr["command"]=='checkWorkReport' || $this->in_arr["command"]=='viewWorkReport'){
//                        $re = json_decode($this->out_arr,true);
                        foreach($this->out_arr['attachList'] as $key => $v){
                            $url = explode("=",$v['url']);
                            $this->out_arr['attachList'][$key]['url'] = base64_decode($url[1]);
                        }
                    }
                    if($this->in_arr["command"]=='viewWorkReport'){
                        //2.11
                        foreach($this->out_arr['viewPeopleList'] as $key => $v){
                            $re = M("files")->where("f_id=".$v["viewPeoplePhotoId"])->find();
                            $this->out_arr['viewPeopleList'][$key]["imgUrl"] = $re["f_filepath"].$re["f_filename"];
                        }
                    }elseif($this->in_arr["command"]=='viewWorkReportComment'){
                        //2.10
                        foreach($this->out_arr['list'] as $key => $v){
                            $re = M("files")->where("f_id=".$v["headLogo"])->find();
                            $this->out_arr['list'][$key]["imgUrl"] = $re["f_filepath"].$re["f_filename"];
                        }
                    }elseif($this->in_arr["command"]=='getCheckWorkReportList'){
//                        pt($this->out_arr['list']);
                        //2.6
                        foreach($this->out_arr['list'] as $key => $v){
                            $headlogo = (int)$v["createPerpleHeadLogo"];
                            $re = M("files")->where("f_id=".$headlogo)->find();
                            $this->out_arr['list'][$key]["imgUrl"] = $re["f_filepath"].$re["f_filename"];
                        }
                    }
                    break;
                //==============3.1获取拜访签到列表======================
                case 'queryGPSList':
                //==============3.2查看签到详情======================
                case 'viewSignDetail':
                //==============3.3新增(拜访、上下班)签到======================
                case 'addSign':
                //==============3.4查询上下班签到记录======================
                case 'getWorkSignList':
                //==============3.5新增签到记录点评======================
                case 'addSignComment':
                //==============3.6获取签到点评列表======================
                case 'getSignCommentList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    switch ($this->in_arr['command']) {
                        // 3.1获取拜访签到列表
                        case 'queryGPSList':
                            $list_key = 'checks';
                            break;
                        // 3.4查询上下班签到记录
                        case 'getWorkSignList':
                            $list_key = 'workSignList';
                            break;
                        // 3.6获取签到点评列表
                        case 'getSignCommentList':
                            $list_key = 'commentList';
                            break;
                        default:
                            break;
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_GPS_URL, $list_key);
                    break;
                //==============4.1 获取用户列表接口======================
                case 'getUserList':
                //==============4.2 获取下级部门列表接口======================
                case 'getAllDeptList':
                //==============4.3 查看用户详情接口======================
                case 'viewUserDetail':
                case 'getAllUserList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    if ($this->in_arr['command'] === 'getUserList') {
                        // 4.1 获取用户列表接口
                        $list_key = 'userList';
                    } else if ($this->in_arr['command'] === 'getAllDeptList') {
                        // 4.2 获取下级部门列表接口
                        $list_key = 'deptList';
                    }
                    //$YYJhttp=new YYInfoController();
                    
                    $re_java = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_USER_CONTACTS_URL, $list_key);

                    if($this->in_arr['command']=="getUserList"){
                        foreach($re_java['list'] as $k=>$val){
                            $headlogo = (int)$val["photoId"];
                            if($headlogo==0){
                                $re_java['list'][$k]['imgUrl'] = "";
                            }else{
                                $re = M("files")->where("f_id=".$headlogo)->find();
                                $re_java['list'][$k]['imgUrl'] = $re["f_filepath"].$re["f_filename"];
                            }
                        }
                    }else if($this->in_arr['command']=="viewUserDetail"){
                        $headlogo = (int)$re_java["photoId"];
                        $re = M("files")->where("f_id=".$headlogo)->find();
                        $re_java['imgUrl'] = $re["f_filepath"].$re["f_filename"];
                    }else if($this->in_arr['command']=="getAllUserList"){
                        foreach($re_java['userList'] as $k=>$val){
                            $headlogo = (int)$val["photoId"];
                            if($headlogo==0){
                                $re_java['userList'][$k]['imgUrl'] = "";
                            }else{
                                $re = M("files")->where("f_id=".$headlogo)->find();
                                $re_java['userList'][$k]['imgUrl'] = $re["f_filepath"].$re["f_filename"];
                            }
                        }
                    }

                $this->out_arr = $re_java;
                    //$this->out_arr = A('YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_USER_CONTACTS_URL, $list_key);
                    break;
                //==============5.1 新增/编辑客户接口======================
                case 'addOrEditCustomer':
                //==============5.2 查看客户详情======================
                case 'viewCustomer':
                //==============5.5 删除客户======================
                case 'delCustomer':
                //==============5.4客户搜索======================
                //5.5 获取客户区域树数据
                case 'getAreaList':
                case 'searchCustomer':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    if ($this->in_arr['command'] === 'viewCustomer') {
                        // 5.2 查看客户详情
                        $list_key = 'addressList';
                    } else if ($this->in_arr['command'] === 'searchCustomer') {
                        // 5.4客户搜索
                        $list_key = 'cusList';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_CUSTOMER_URL, $list_key);
                    if($this->in_arr["command"]=='viewCustomer'){

                        //5.2
                        foreach($this->out_arr['cusTrackRecordInfo'] as $key => $v){
                            foreach($v['cusTrackRecordList'] as $k=>$val){
                                $headlogo = (int)$val["headLogo"];
                                $re = M("files")->where("f_id=".$headlogo)->find();
                                $this->out_arr['cusTrackRecordInfo'][$key]['cusTrackRecordList'][$k]["imgUrl"] = $re["f_filepath"].$re["f_filename"];
                            }
                        }
//                        pt($this->out_arr);
                    }
                    break;
                //==============6.1 新增/编辑客户联系人接口======================
                case 'addOrEditCusClient':
                //==============6.2客户联系人搜索======================
                case 'searchCusClient':
                //==============6.3 查看客户联系人详情======================
                case 'viewCusClient':
                //==============6.4 删除客户联系人======================
                case 'delCusClient':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 6.2客户联系人搜索
                    $list_key = ($this->in_arr['command'] === 'searchCusClient') ? 'cusClientList' : 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_CUSTOMER_CLIENT_URL, $list_key);
                    break;
                //==============7.1 根据条件查询数据字典接口======================
                case 'getDictByCondition':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'dicts';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_DICT_URL, $list_key);
                    break;
                //==============8.1 新增常用客户类型所属人======================
                case 'saveCommPer':
                //==============8.2 删除常用客户类型所属人======================
                case 'deleteCommPer':
                //==============8.3获取常用(客户/联系人)所有人列表======================
                case 'getCommPerList':
                //==============8.4 获取非常用(客户/联系人)所有人列表======================
                case 'getNotCommPerList':
                //==============8.5 保存用户选择的常用客户类型所属人======================
                case 'saveSelectedCommPer':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 8.3获取常用(客户/联系人)所有人列表
                    // 8.4 获取非常用(客户/联系人)所有人列表
                    if ($this->in_arr['command'] === 'getCommPerList'
                        || $this->in_arr['command'] === 'getNotCommPerList') {
                        $list_key = 'userList';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_COMMON_PERSONAL_URL, $list_key);
                    break;
                //==============9.1 新增/编辑公告栏目接口======================
                case 'addorEditNoticeBoard':
                //==============9.2 查询公告栏目接口======================
                case 'searchNoticeBoard':
                //==============9.3查看公告栏目接口======================
                case 'viewNoticeBoard':
                //==============9.4删除公告栏目接口======================
                case 'deleteNoticeBoard':
                //==============9.5 查询企业下所有的公告栏目接口======================
                case 'queryAllNoticeBoard':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    if ($this->in_arr['command'] === 'searchNoticeBoard'
                        || $this->in_arr['command'] === 'queryAllNoticeBoard') {
                        // 9.2 查询公告栏目接口
                        // 9.5 查询企业下所有的公告栏目接口
                        $list_key = 'noticeBoardList';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_NOTICE_BOARD_URL, $list_key);
                    break;
                //==============10.1 新增附件记录接口======================
                case 'saveAttach':
                //==============10.2 获取附件记录列表接口======================
                case 'getAttachList':
                //==============10.3删除附件记录接口======================
                case 'delAttach':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 10.2 获取附件记录列表接口
                    $list_key = ($this->in_arr['command'] === 'getAttachList') ? 'attachList' : 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_ATTACHMENT_URL, $list_key);
                    break;
                //==============11.1 新增/编辑签到地址接口======================
                case 'saveSignAddr':
                //==============11.2 获取签到地址列表接口======================
                case 'getSignAddrList':
                //==============11.3查看签到地址接口======================
                case 'viewSignAddr':
                //==============11.4作废签到地址接口======================
                case 'invalidSignAddr':
                //==============11.5删除签到地址接口======================
                case 'delSignAddr':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 11.2 获取签到地址列表接口
                    $list_key = ($this->in_arr['command'] === 'getSignAddrList') ? 'signAddressList' : 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_SIGN_ADDRESS_URL, $list_key);
                    break;
                //==============12.1 获取国家列表接口======================
                case 'getCountryList':
                //==============12.2 获取省份列表接口======================
                case 'getProvinceList':
                //==============12.3 获取城市列表接口======================
                case 'getCityList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    if ($this->in_arr['command'] === 'getCountryList') {
                        // 12.1 获取国家列表接口
                        $list_key = 'countryList';
                    } else if ($this->in_arr['command'] === 'getProvinceList') {
                        // 12.2 获取省份列表接口
                        $list_key = 'provinceList';
                    } else if ($this->in_arr['command'] === 'getCityList') {
                        // 12.3 获取城市列表接口
                        $list_key = 'cityList';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_ADDRESS_URL, $list_key);
                    break;
               //13.1 获取预先定义的流程节点处理人 后追加的
               case  'getDefineProcessNodeList':
               //==============13.1 创建流程接口======================
               case 'createProcess':
               //==============13.2 流程节点审批接口(同意/拒绝/转发)======================
               case 'processNodeApproval':
               //13.3 获取流程列表接口(我发起的流程/待我审核的流程/我已审批的流程)
               case 'getProcessList':
               //13.4 查看流程详情接口
               case 'viewProcessDetail':
//                   echo json_encode($data);
                    if($data!=null){
                        $this->in_arr = $data;
                    }
	               	$this->out_other();
	               	$this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    if($this->in_arr["command"] == "createProcess"){
                        //处理附件
                        $fileid = $this->in_arr['processFId'];
                        if(empty($fileid)){
                            $this->in_arr['attachCount'] = '0';
                        }else{
                            $this->in_arr['attachCount'] = (string)count(explode(',',$fileid));
                            $map['f_id'] = array('in',$fileid);
                            $re_file = M("files")->where($map)->select();
                            foreach($re_file as $key => $v){
                                $i = $key+1;
                                $this->in_arr['attachs']['attach'.$i]['fileType'] = $v['f_filetype'];
                                $this->in_arr['attachs']['attach'.$i]['tabName'] = "process";
                                $this->in_arr['attachs']['attach'.$i]['displayName'] = $v['f_oldfilename'];
                                $this->in_arr['attachs']['attach'.$i]['url'] = "file=".base64_encode($v['f_filepath'].$v['f_filename']);
                                $this->in_arr['attachs']['attach'.$i]['size'] = $v['f_filesize'];
                            }
                        }
                    }
	               	//// 10.2 获取附件记录列表接口
	               	//$list_key = ($this->in_arr['command'] === 'getAttachList') ? 'attachList' : 'list';
	               	// 请求JAVA接口,并取得数据
	               	$this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_PROCESS_URL, $list_key);
                    if($this->in_arr['command'] == "viewProcessDetail"){
                        foreach($this->out_arr['attachList'] as $key => $v){
//                            echo $v['url'];
                            $url = explode("=",$v['url']);
                            $this->out_arr['attachList'][$key]['url'] = base64_decode($url[1]);
//                            $this->out_arr['attachList'][$key]['url1111'] = "1111";
                        }
                    }
//                pt($this->out_arr);
               	break;
               //==============14.1 创建流程接口======================
               case 'sendMessage':
               //==============14.2 添加评论接口======================
               case 'addComment':
               //==============14.3 添加回复接口======================
               case 'addReply':
               //==============14.5 消息统计接口======================
               case 'getMessageCount':
               //==============14.4 查询消息列表接口======================
               case 'queryMessageList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                if($this->in_arr["command"]=='sendMessage') {
                    //处理附件
                    $fileid = $this->in_arr['messageFId'];
                    if (empty($fileid)) {
                        $this->in_arr['attachCount'] = '0';
                    } else {
                        $this->in_arr['attachCount'] = (string)count(explode(',', $fileid));
                        $map['f_id'] = array('in', $fileid);
                        $re_file = M("files")->where($map)->select();
                        foreach ($re_file as $key => $v) {
                            $i = $key + 1;
                            $this->in_arr['attachs']['attach' . $i]['fileType'] = $v['f_filetype'];
                            $this->in_arr['attachs']['attach' . $i]['tabName'] = "message";
                            $this->in_arr['attachs']['attach' . $i]['displayName'] = $v['f_oldfilename'];
                            $this->in_arr['attachs']['attach' . $i]['url'] = $v['f_filepath'] . $v['f_filename'];
                            $this->in_arr['attachs']['attach' . $i]['size'] = $v['f_filesize'];
                        }
                    }
                }
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_MESSAGE_URL, $list_key);
                if($this->in_arr["command"]=='queryMessageList') {
                    foreach ($this->out_arr['attachList'] as $key => $v) {
                        $url = explode("=", $v['url']);
                        $this->out_arr['attachList'][$key]['url'] = base64_decode($url[1]);
                    }
                    foreach ($this->out_arr['messageList'] as $k => $val) {
                        $re=M('files')->where('f_id='.$val['headLogo'])->find();
                        $this->out_arr['messageList'][$k]['imgUrl']=$re['f_filepath'].$re['f_filename'];
                        foreach ($this->out_arr['messageList'][$k]['commentList'] as $i => $value) {
                            if ($value['headLogo']!="") {
                                $this->out_arr['messageList'][$k]['commentList'][$i]['imgUrl']=$re['f_filepath'].$re['f_filename'];
                            }
                            foreach ($this->out_arr['messageList'][$k]['commentList'][$i]['replyList'] as $ki => $valuei) {
                                if ($valuei['headLogo']!="") {
                                    $this->out_arr['messageList'][$k]['commentList'][$i]['replyList'][$ki]['imgUrl']=$re['f_filepath'].$re['f_filename'];
                                }
                                
                            }
                        }
                    }
                }
                break;
              //14.6消息点赞
              case 'messageThumb':
                  $this->out_other();
                  $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                  $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_MESSAGE_URL, $list_key);
                break;
               //==============15.1 获取积分榜接口======================
              case 'getIntegralRanking':
                	$this->out_other();
                	$this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                	$list_key = 'list';
                	if ($this->in_arr['command'] === 'getIntegralRanking') {
                		$list_key = 'integralUserList';
                	}
                	// 请求JAVA接口,并取得数据
                	$this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_INTERGRALSERVLET_URL, $list_key);
                break;
               //==============16.1 新建与修改日程接口======================
              case 'saveSchedule':
               //==============16.2获取日程列表接口======================
              case 'getScheduleList':
               //==============16.3 日程执行接口======================
              case 'executeSchedule':
               //==============16.4 日程延期接口======================
              case 'delaySchedule':
               //==============16 查看日程接口======================
              case 'viewSchedule':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    if ($this->in_arr['command'] === 'getScheduleList') {
                        $list_key = 'scheduleList';
                    }
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_SCHEDULE_URL, $list_key);
//                    pt($this->out_arr['participantList']);
                    foreach($this->out_arr['participantList'] as $key => $v){
                        if($v['participantPhotoId']==0){
                            $this->out_arr['participantList'][$key]['participantUrl'] = "";
                        }else{
                            $this->out_arr['participantList'][$key]['participantUrl'] = $this->getHeadUrl($v['participantPhotoId']);
                        }
                    }
                break;
               //==============17.1 保存签到类型地址信息接口======================
              case 'saveGPSTypeAdd':
               //==============17.2 获取签到类型地址信息接口======================
              case 'queryGPSTypeAddList':
               //==============17.3 获取签到类型地址信息详情接口======================
              case 'queryGPSTypeAddDetail':
               //==============17.4 删除签到类型地址信息接口======================
              case 'delGPSTypeAddDetail':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_GPS_URL, $list_key);
                break;
               //==============18.1增加区域信息接口======================
              case 'addTabPatrolArea':
               //==============18.2修改区域信息接口======================
              case 'modifyPatrolArea':
               //==============18.3删除区域信息接口======================
              case 'removePatrolArea':
               //==============18.4获取区域信息接口======================
              case 'getPatrolArea':
               //==============18.5根据企业id获取所有区域接口======================
              case 'getAreaListByCompanyId':
               //==============18.6获取区域信息的结构树接口======================
              case 'getAreaTree':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_CUSTOMER_URL, $list_key);
                break;

                //==============19.1新建与修改商机接口======================
                case 'saveBiz':
                    //==============19.2查看商机接口======================
                case 'viewBiz':
                    //==============19.3查询商机接口======================
                case 'getBizList':
                    //==============19.4删除商机接口======================
                case 'deleteBiz':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_BIZ_URL, $list_key);
                    break;

                //==============20.1新增与编辑拜访计划接口======================
                case 'saveVisitPlan':
                    //==============20.2查询拜访计划列表接口======================
                case 'getVisitPlanList':
                    //==============20.3查看拜访计划接口======================
                case 'viewVisitPlan':
                    //==============20.4删除拜访计划接口======================
                case 'delVisitPlan':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_VISITPLAN_URL, $list_key);
                    break;


                //==============21.1新增与编辑拜访记录接口======================
                case 'saveVisitRecord':
                    //==============21.2查询拜访记录列表接口======================
                case 'getVisitRecordList':
                    //==============21.3查看拜访记录接口======================
                case 'viewVisitRecord':
                    //==============21.4删除拜访记录接口======================
                case 'delVisitRecord':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_VISITRECORD_URL, $list_key);
                    break;


                //==============22.1 新增合同======================
                case 'insertContract':
                    //==============22.2 修改合同======================
                case 'updateContract':
                    //==============22.3 删除合同======================
                case 'delContract':
                    //==============22.4 获取合同详情======================
                case 'getContractDetail':
                    //==============22.5 获取合同列表======================
                case 'getContractList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_CONTRACT_URL, $list_key);
                    break;

                //==============23.1 新增回款======================
                case 'insertPayRecord':
                    //==============23.2 修改回款======================
                case 'updatePayRecord':
                    //==============23.3 获取回款列表======================
                case 'getPayRecordList':
                    //==============23.4 获取回款详情======================
                case 'getPayRecordDetail':
                //==============23.5 删除回款======================
                case 'delPayRecord':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'list';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_PAYRECORD_URL, $list_key);
                    break;
                case 'smscode':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->smsCode();
                    break;
                case 'codeauth':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->codeAuth();
                    break;
                case 'saveNotice':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 1.7获取公告访问信息列表接口的返回列表名字不是默认值list
                    $list_key = "insertNotice";
                    //处理附件
                    $fileid = $this->in_arr['noticeFid'];
                    if(empty($fileid)){
                        $this->in_arr['attachCount'] = '0';
                    }else{
                        $this->in_arr['attachCount'] = (string)count(explode(',',$fileid));
                        $map['f_id'] = array('in',$fileid);
                        $re_file = M("files")->where($map)->select();
                        foreach($re_file as $key => $v){
                            $i = $key+1;
                            $this->in_arr['attachs']['attach'.$i]['fileType'] = $v['f_filetype'];
                            $this->in_arr['attachs']['attach'.$i]['tabName'] = "bbsMessage";
                            $this->in_arr['attachs']['attach'.$i]['displayName'] = $v['f_oldfilename'];
                            $this->in_arr['attachs']['attach'.$i]['url'] = "file=".base64_encode($v['f_filepath'].$v['f_filename']);
                            $this->in_arr['attachs']['attach'.$i]['size'] = $v['f_filesize'];
                        }
                    }
//                    http://dvpt.51lick.cn/index.php/Home/Office/noticeDetail/messageId/
                    $this->in_arr['path'] = C("WebUrl")."index.php/Home/Office/noticeDetail/messageId/";
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_NOTICE_URL, $list_key);
                    break;
                case 'insertNotice':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 1.7获取公告访问信息列表接口的返回列表名字不是默认值list
                    $list_key = "insertNotice";
                    //处理附件
                    $fileid = $this->in_arr['noticeFid'];
                    if(empty($fileid)){
                        $this->in_arr['attachCount'] = '0';
                    }else{
                        $this->in_arr['attachCount'] = (string)count(explode(',',$fileid));
                        $map['f_id'] = array('in',$fileid);
                        $re_file = M("files")->where($map)->select();
                        foreach($re_file as $key => $v){
                            $i = $key+1;
                            $this->in_arr['attachs']['attach'.$i]['fileType'] = $v['f_filetype'];
                            $this->in_arr['attachs']['attach'.$i]['tabName'] = "bbsMessage";
                            $this->in_arr['attachs']['attach'.$i]['displayName'] = $v['f_oldfilename'];
                            $this->in_arr['attachs']['attach'.$i]['url'] = "file=".base64_encode($v['f_filepath'].$v['f_filename']);
                            $this->in_arr['attachs']['attach'.$i]['size'] = $v['f_filesize'];
                        }
                    }
//                    http://dvpt.51lick.cn/index.php/Home/Office/noticeDetail/messageId/
                    $this->in_arr['path'] = C("WebUrl")."index.php/Home/Office/noticeDetail/messageId/";
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_NOTICE_URL, $list_key);
                    break;
                case 'getNoticeList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 1.7获取公告访问信息列表接口的返回列表名字不是默认值list
                    $list_key = "seeNotice";
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_NOTICE_URL, $list_key);
                    break;
                case 'seeNotice':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 1.7获取公告访问信息列表接口的返回列表名字不是默认值list
                    $list_key = "seeNotice";
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_NOTICE_URL, $list_key);
                    foreach($this->out_arr['attachList'] as $key => $v){
                        $url = explode("=",$v['url']);
                        $this->out_arr['attachList'][$key]['url'] = base64_decode($url[1]);
                    }
                    break;
                case 'getCompanyByMobile':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $re = A('Api/Jhttp') ->getCompanyByMobile($this->in_arr['mobile']);
                    $arr = json_decode($re,true);
//                    pt($arr);
                    if($arr["resCode"]=="000000"){
                        $this->out_arr["list"] =$arr["list"];
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                    }else{
                        $this->out_arr['error_code'] = $arr["resCode"];
                        $this->out_arr['error_text'] = A('Api/Jhttpcode')->searchCode($arr["resCode"]);
                    }
                    break;
                case 'WebChangePwd':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $re = A('Api/Jhttp') ->WebChangePwd($this->in_arr['mobile'], $this->in_arr['password'], $this->in_arr['companyId']);
                    $arr = json_decode($re,true);
                    if($arr["resCode"]=="000000"){
//                        $this->out_arr["list"] =$arr["list"];
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                    }else{
                        $this->out_arr['error_code'] = $arr["resCode"];
                        $this->out_arr['error_text'] = A('Api/Jhttpcode')->searchCode($arr["resCode"]);
                    }
                    break;
                //16.6日程按月统计
                case 'statisticsSchedule':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $list_key = 'statisticsList';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr = A('Api/YYJhttp')->requestData($this->in_arr, $this->out_arr, YY_SCHEDULE_URL, $list_key);
                    break;
                case 'getAllIndustry':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $re = A('Api/Jhttp') ->getAllIndustry();
                    $re_list = json_decode($re,true);
//                    pt($re_list);
                    $this->out_arr['list'] =$re_list["list"];
                    break;

                //===============开始分销接口===============
                //1:商品列表(type:1为全部，2为促销)
                case 'getShopList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //2:商品详情
                case 'getShopNote':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //3:经销商购物车列表
                case 'getShopCart':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //4:删除购物车商品
                case 'delShopCart':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //5:经销商订单
                case 'getAgeOrderList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //6:添加经销商订单
                case 'addAgeOrder':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //7:删除经销商订单
                case 'delAgeOrder':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //8:经销商订单详情
                case 'getAgeOrderNote':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //9:经销商订单收货确认
                case 'orderConfirmation':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //10:经销商物流状态查询
                case 'getDistributionNote':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //11:新增修改收货地址
                case 'addOrmodiAddress':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //12:删除收货地址列表
                case 'delAddress':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //13:查询收货地址列表
                case 'getAddress':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //14:OMS登录
                case 'login':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //15:厂商列表
                case 'getFacList':
//                    echo "aaa";
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $re = A('Api/Jhttp')->getFacList($this->in_arr['userid'],  $this->in_arr['companyid']);
                    $arr = json_decode($re,true);
                    if($arr["resCode"]=="000000"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        $this->out_arr['list'] = $arr["list"];
                    }else{
                        $this->out_arr['error_code'] = $arr["resCode"];
                        $this->out_arr['error_text'] = A('Api/Jhttpcode')->searchCode($arr["resCode"]);
                    }
                    break;
                case 'proGroupList':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //添加购物车
                case 'addShopCart':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->in_arr["serId"] = "oms".time();
                    $this->in_arr["date"] = date("Y-m-d H:i:s",time());
                    // 请求JAVA接口,并取得数据
//                    pt($this->in_arr);
                    $arr = A('Api/YYJhttp')->omscurl($this->in_arr,  YY_OMS_URL);
                    if((string)$arr["result"]=="1"){
                        $this->out_arr['error_code'] = 'success';
                        $this->out_arr['error_text'] = '';
                        unset($arr['result']);
                        unset($arr['msg']);
                        $this->out_arr = array_merge_recursive($this->out_arr,$arr);
                    }else{
                        $this->out_arr['error_code'] = $arr['result'];
                        $this->out_arr['error_text'] = $arr['msg'];
                    }
                    break;
                //16:添加预约电话会议
                case 'addMtPre':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_METTING_URL, $list_key);
                    break;
                //17:更新预约电话会议
                case 'updateMtPre':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_METTING_URL, $list_key);
                    break;
                //18:更新会议成员
                case 'updateMtMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_METTING_URL, $list_key);
                    break;
                //18:更新会议成员
                case 'getMtPreMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_METTING_URL, $list_key);
                    break;

                //24:业绩看板
                //1获取仪表盘类型   YY_DASHBOARD_URL
                case 'getDashboardType':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_DASHBOARD_URL, $list_key);
                    break;
                //2根据仪表盘类型获取仪表盘列表
                case 'getDashboardByType':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_DASHBOARD_URL, $list_key);
                    break;
                //3添加我的仪表盘
                case 'addMyDashboard':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_DASHBOARD_URL, $list_key);
                    break;
                //4获取我的仪表盘
                case 'getMyDashboard':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_DASHBOARD_URL, $list_key);
                    break;
                //5删除我的仪表盘
                case 'delMyDashboard':
                    $this->out_other();
                    $this->out_arr['re_command'] = $this->in_arr['command'] . '_resq';
                    // 请求JAVA接口,并取得数据
                    $this->out_arr =A('Api/YYJhttp') ->requestData($this->in_arr, $this->out_arr, YY_DASHBOARD_URL, $list_key);
                    break;
               default:
                    $this->out_arr['conf_auth'] = 'F';
                    $this->out_arr['auth_code'] = 'conf_error';
                    $this->out_arr['retime'] = time();
                    $this->out_arr['retime_pre'] = date('YmdHis');
                    break;
            }

            //输入返回数据:如果有debugout，则打印返回数据，否则输出使用数据
            if (isset($this->in_arr['debugout'])) {
                pt($this->out_arr);
            }elseif( $this->in_arr['command'] == 'companylogin' || $this->in_arr['command'] == 'userlogin' || $this->in_arr['command'] == 'zsreguser'  ){ //登录注册调用jhttp里的接口
                echo A('Api/Fun')->JSON($this->out_arr);
            } else {
            	if ($data == null){
                	echo A('Api/Fun')->JSON($this->out_arr);
            	}else{
                	return A('Api/Fun')->JSON($this->out_arr);
            	}
            }
            //写入日志
            \Think\Log::write("YY_OUT:::".json_encode($this->out_arr),"NOTICE");
        }
    }

    /**
     * ==========================短信验证码=========================================================
     * @param string $voicephone 验证的手机号
     * @return json返回云之讯结果
     */
    private function smsCode()
    {
        //处理验证码
        $map['F_VOICECODE'] = rand(1111, 9999);
        $map['F_VOICEPHONE'] = $this->in_arr['voicephone'];
        $map['F_TIMESTAMP'] = time();
        $map['F_STRAT'] = 0;
        if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$map['F_VOICEPHONE'])){
            $this->out_arr['error_code'] = 'phone_format_error';
            $this->out_arr['error_text'] = '手机格式出错';
        }else {

            $smsRe = M('voicecode')->where("F_VOICEPHONE=" . $map['F_VOICEPHONE'] . " and F_STRAT=0")->order("f_vid desc")->find();
            if ($smsRe) {
                $difftime = ceil(time() - $smsRe["f_timestamp"]);
                if ($difftime <= 60) {
                    $this->out_arr['error_code'] = 'sms_time';
                    $this->out_arr['error_text'] = '60秒后再试';
                } else {
//                    $this->ucpaas_sms($map);
                    $this->out_arr = A("Fun")->cl_sms($map);
                }
            } else {
//                $this->ucpaas_sms($map);
                $this->out_arr = A("Fun")->cl_sms($map);
            }
        }
    }
    /**
     * ==========================验证码认证=========================================================
     * @param string $voicephone 验证的手机号
     * @param string $code 验证码
     * @return 返回验证结果
     */
    private function codeAuth()
    {
        $map['F_VOICECODE'] = isset($this->in_arr['code']) ? $this->in_arr['code'] : 0;
        $map['F_VOICEPHONE'] = $this->in_arr['voicephone'];
        $map['F_STRAT'] = 0;
        if($map['F_VOICECODE']=='888888'){
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }else{
            $result = M('voicecode')->where($map)->order("f_vid desc")->find();
            if (!$result) {
                $this->out_arr['error_code'] = 'voicecode_error';
                $this->out_arr['error_text'] = '验证码已经被使用';
            } else {
                $difftime = ceil(time()-$result["f_timestamp"]);
                if($difftime>=1800){
                    $this->out_arr['error_code'] = 'sms_overtime';
                    $this->out_arr['error_text'] = '验证码已经超时，请重新获取';
                    $map_1['F_VOICECODE'] = $map['F_VOICECODE'];
                    $map_1['F_VOICEPHONE'] = $map['F_VOICEPHONE'];
                    M('voicecode')->where($map_1)->setField("F_STRAT=2");
                }else{
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    //成功后，改变状态
                    $map_1['F_VOICECODE'] = $map['F_VOICECODE'];
                    $map_1['F_VOICEPHONE'] = $map['F_VOICEPHONE'];
                    M('voicecode')->where($map_1)->setField("F_STRAT=1");
                }
            }
        }

    }
        
    //转化为标准Array
    function object_array($array){
    	if(is_object($array)){
    		$array = (array)$array;
    	}
    	if(is_array($array)){
    		foreach($array as $key=>$value){
    			$array[$key] = $this->object_array($value);
    		}
    	}
    	return $array;
    }
    
    //返回基本数据
    private function out_other() {
        $this->out_arr['conf_auth'] = 'T';
        $this->out_arr['auth_code'] = 'conf_success';
        $this->out_arr['retime'] = time();
        $this->out_arr['retime_pre'] = date('YmdHis');
    }


    /**
     * 检测必传参数是否存在
     * @param $arr 检测的KEY，格式：array
     * @return bool
     */
    private function isset_F($arr){
        for($i=0;$i<count($arr);$i++) {
            if(!isset($this->in_arr[$arr[$i]])){
                return false;
            }
        }
        return true;
    }


    /**
     * 检测必传参数是否为空
     * @param $arr 检测的KEY，格式：array
     * @return bool
     */
    private function empty_F($arr){
        for($i=0;$i<count($arr);$i++) {
            if(empty($this->in_arr[$arr[$i]])){
                return false;
            }
        }
        return true;
    }

    //查询头像URL
    private function getHeadUrl($id){
        $re = M("files")->where("f_id=".$id)->find();
        return $re["f_filepath"].$re["f_filename"];
    }




}