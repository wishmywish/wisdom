<?php
namespace Api\Controller;
use Think\Controller;

class ApiController extends Controller
{
    private $in_arr, $in_file, $out_arr, $resp, $token;

    //=================通过接口方法=========================================================
    function inport()
    {
        header("Content-Type: text/html;charset=utf-8");
        $this->in_arr = array_merge($_GET, $_POST);
        $this->in_file = $_FILES;
        //写入日志
        \Think\Log::write("IN:::".json_encode($this->in_arr),"NOTICE");
        if (isset($this->in_arr['debugin'])) {
            pt($this->in_arr);
            if (!empty($this->in_file)) {
                pt($this->in_file);

            }
        } else {
            //处理COMMAND
            switch ($this->in_arr['command']) {
                //======================================JAVA智慧运营登录==================================
                case 'login':
                    $this->out_other();
                    $this->out_arr['re_command'] = "Login_resq";
                    $this->login();
                    break;
                //======================================JAVA智慧运营登录，取企业和员工信息==================================
                case 'ulogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "ulogin_resq";
                    $this->ulogin();
                    break;
                //======================================JAVA智慧运营登录token==================================
                case 'userlogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "userlogin_resq";
                    $this->userlogin();
                    break;
                //======================================平台管理登录==================================
                case 'platformlogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "platformLogin_resq";
                    $this->platformlogin();
                    break;
                //======================================JAVA招商平台认证==================================
                case 'zslogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "zsLogin_resq";
                    $this->zslogin();
                    break;
                //======================================JAVA招商平台注册==================================
//                case 'zsreguser':
//                    $this->out_other();
//                    $this->out_arr['re_command'] = "zsreguser_resq";
//                    $this->zsreguser();
//                    break;
                //======================================JAVA招商忘记密码==================================
                case 'zsforgetpassword':
                    $this->out_other();
                    $this->out_arr['re_command'] = "zsforgetpassword_resq";
                    $this->zsforgetpassword();
                    break;
                //======================================WEB端注册企业及生成一个用户======================================
                case 'webregcompany':
                    $this->out_other();
                    $this->out_arr['re_command'] = "webregcompany_resq";
                    $this->webregcompany();
                    break;
                //======================================JAVA招商总收益==================================
                case 'zsTotalCollect':
                    $this->out_other();
                    $this->out_arr['re_command'] = "zsTotalCollect_resq";
                    $this->zsTotalCollect();
                    break;
                //======================================获取任务列表==================================
                case 'getTaskList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTaskList_resq";
                    $this->getTaskList();
                    break;
                //======================================获取任务详细==================================
                case 'getTaskNote':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTaskNote_resq";
                    $this->getTaskNote();
                    break;
                //======================================获取任务问题和答案==================================
                case 'getTaskQ':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTaskQ_resq";
                    $this->getTaskQ();
                    break;
                //IOS1.6版以前的验证码接口
                case 'voicecode':
                    $this->out_other();
                    $this->out_arr['re_command'] = "voiceCode_resq";
                    $this->err();
                    break;
                //======================================云之讯语音验证码==================================
                case 'vCode':
                    $this->out_other();
                    $this->out_arr['re_command'] = "voiceCode_resq";
                    $this->voiceCode();
                    break;
                //======================================云之讯短信验证码==================================
                case 'smsCode':
                    $this->out_other();
                    $this->out_arr['re_command'] = "smsCode_resq";
                    $this->smsCode();
                    break;
                //======================================验证码认证==================================
                case 'codeauth':
                    $this->out_other();
                    $this->out_arr['re_command'] = "codeAuth_resq";
                    $this->codeAuth();
                    break;
                //======================================云之讯双向回拨==================================
                case 'call':
                    $this->out_other();
                    $this->out_arr['re_command'] = "call_resq";
                    $this->call();
                    break;
                //======================================创建Client==================================
                case 'clients':
                    $this->out_other();
                    $this->out_arr['re_command'] = "clients_resq";
                    $this->clients();
                    break;
                case 'getClient':
                        $this->out_other();
                        $this->out_arr['re_command'] = "clients_resq";
                        $this->getClient();
                        break;
                //会议回调
                case 'callback':
                    $this->out_other();
                    $this->out_arr['re_command'] = "callback_resq";
                    $this->callback();
                    break;
                //======================================创建会议==================================
                case 'createMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "createMeeting_resq";
                    $this->createMeeting();
                    break;
                //======================================解散会议==================================
                case 'dismissMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "dismissMeeting_resq";
                    $this->dismissMeeting();
                    break;
                //======================================查询会议==================================
                case 'queryMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "queryMeeting_resq";
                    $this->queryMeeting();
                    break;
                //======================================邀请加入==================================
                case 'inviteMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "inviteMeeting_resq";
                    $this->inviteMeeting();
                    break;
                //======================================移除成员==================================
                case 'removeMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "removeMeeting_resq";
                    $this->removeMeeting();
                    break;
                //======================================成员静音==================================
                case 'muteMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "muteMember_resq";
                    $this->muteMember();
                    break;
                //======================================取消成员静音==================================
                case 'unmuteMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "unmuteMember_resq";
                    $this->unmuteMember();
                    break;
                //======================================成员禁听==================================
                case 'deafMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "deafMember_resq";
                    $this->deafMember();
                    break;
                //======================================取消成员禁听==================================
                case 'undeafMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "undeafMember_resq";
                    $this->undeafMember();
                    break;
                //======================================会场录音==================================
                case 'recordMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "recordMember_resq";
                    $this->recordMember();
                    break;
                //======================================取消会场录音==================================
                case 'stopRecordMember':
                    $this->out_other();
                    $this->out_arr['re_command'] = "stopRecordMember_resq";
                    $this->stopRecordMember();
                    break;
                //======================================会场放音==================================
                case 'confPlay':
                    $this->out_other();
                    $this->out_arr['re_command'] = "confPlay_resq";
                    $this->confPlay();
                    break;
                //======================================取消会场放音==================================
                case 'stopConfPlay':
                    $this->out_other();
                    $this->out_arr['re_command'] = "stopConfPlay_resq";
                    $this->stopConfPlay();
                    break;
                //======================================设置会议主席==================================
                case 'setHost':
                    $this->out_other();
                    $this->out_arr['re_command'] = "setHost_resq";
                    $this->setHost();
                    break;
                //======================================延长会议时间==================================
                case 'delayMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "delayMeeting_resq";
                    $this->delayMeeting();
                    break;
                //======================================锁定会议==================================
                case 'lockMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "lockMeeting_resq";
                    $this->lockMeeting();
                    break;
                //======================================获得会议列表==================================
                case 'queryAllMeeting':
                    $this->out_other();
                    $this->out_arr['re_command'] = "queryAllMeeting_resq";
                    $this->queryAllMeeting();
                    break;
                //======================================全程禁音==================================
                case 'muteAll':
                    $this->out_other();
                    $this->out_arr['re_command'] = "muteAll_resq";
                    $this->muteAll();
                    break;
                //======================================取消全程禁音==================================
                case 'unmuteAll':
                    $this->out_other();
                    $this->out_arr['re_command'] = "unmuteAll_resq";
                    $this->unmuteAll();
                    break;
                //======================================合合扫描=======================================
                case 'card':
                    $this->out_other();
                    $this->out_arr['re_command'] = "card_resq";
                    $this->card();
                    break;
                //======================================创建任务=======================================
                case 'cTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cTask_resq";
                    $this->cTask();
                    break;
                //======================================创建任务=======================================
                //稽查赚
                case 'cCheck':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cCheck_resq";
                    $this->cCheck();
                    break;
                case 'bTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "bTask_resq";
                    $this->bTask();
                    break;
                case 'bTask1':
                    $this->out_other();
                    $this->out_arr['re_command'] = "bTask1_resq";
                    $this->bTask1();
                    break;
                case 'bTask2':
                    $this->out_other();
                    $this->out_arr['re_command'] = "bTask2_resq";
                    $this->bTask2();
                    break;
                case 'bTask3':
                    $this->out_other();
                    $this->out_arr['re_command'] = "bTask3_resq";
                    $this->bTask3();
                    break;
                //推广
                case 'cPush':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cPush_resq";
                    $this->cPush();
                    break;
                case 'cPush1':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cPush1_resq";
                    $this->cPush1();
                    break;
                //随手问题
                case 'cPush2':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cPush2_resq";
                    $this->cPush2();
                    break;
                //随手问题
                case 'cCheck1':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cCheck1_resq";
                    $this->cCheck1();
                    break;
                case 'cPush_answer':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cPush_answer_resq";
                    $this->cPush_answer();
                    break;
                //=====================随手赚推荐类模板提交
                case 'cpush2Recomd':
                    $this->out_other();
                    $this->out_arr['re_command'] = "cpush2Recomd_resq";
                    $this->cpush2Recomd();
                    break;

                //======================================添加任务基本信息=======================================
                case 'iTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "iTask_resq";
                    $this->iTask();
                    break;
                case 'iTask1':
                    $this->out_other();
                    $this->out_arr['re_command'] = "iTask1_resq";
                    $this->iTask1();
                    break;
                //======================================添加任务详情=======================================
                case 'xTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "xTask_resq";
                    $this->xTask();
                    break;
                case 'xTask1':
                    $this->out_other();
                    $this->out_arr['re_command'] = "xTask1_resq";
                    $this->xTask1();
                    break;
                //======================================添加区域及数量=======================================
                case 'addArea':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addArea_resq";
                    $this->addArea();
                    break;
                //======================================获取区域及数量=======================================
                case 'getArea':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getArea_resq";
                    $this->getArea();
                    break;

                //======================================删除区域及数量=======================================
                case 'deteArea':
                    $this->out_other();
                    $this->out_arr['re_command'] = "deteArea_resq";
                    $this->deteArea();
                    break;
                //======================================添加招商产品明细=======================================
                case 'addPro':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addPro_resq";
                    $this->addPro();
                    break;
                //======================================获取招商产品明细=======================================
                case 'getPro':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getPro_resq";
                    $this->getPro();
                    break;
                case 'addFiles':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addFiles_resq";
                    $this->addFiles();
                    break;

                //======================================删除招商产品明细=======================================

                case 'detePro':
                    $this->out_other();
                    $this->out_arr['re_command'] = "detePro_resq";
                    $this->detePro();
                    break;
                //======================================添加银行卡和支付宝=======================================
                case 'addBankali':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addBankali_resq";
                    $this->addBankali();
                    break;
                //======================================取银行卡和支付宝=======================================
                case 'bankaliList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "bankaliList_resq";
                    $this->bankaliList();
                    break;
                //======================================删除（修改状态）银行卡和支付宝=======================================
                case 'delBankali':
                    $this->out_other();
                    $this->out_arr['re_command'] = "delBankali_resq";
                    $this->delBankali();
                    break;
                //======================================消费记录=======================================
                case 'shopSheet':
                    $this->out_other();
                    $this->out_arr['re_command'] = "Shopsheet_resq";
                    $this->Shopsheet();
                    break;
                //======================================商品记录======================================
                case 'shopList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "shopList_resq";
                    $this->shopList();
                    break;
                //===================================修改用户信息=========================================
                case 'modiUserInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "modiUserInfo_resq";
                    $this->modiUserInfo();
                    break;
                //===================================删除用户信息=========================================
                case 'delUserInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "delUserInfo_resq";
                    $this->delUserInfo();
                    break;
                //===================================批量删除用户信息=========================================
                case 'usersDelete':
                    $this->out_other();
                    $this->out_arr['re_command'] = "usersDelete_resq";
                    $this->usersDelete();
                    break;
                //===================================修改企业信息=========================================
                case 'modiCompanyInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "modiCompanyInfo_resq";
                    $this->modiCompanyInfo();
                    break;
                //===================================认领任务（随手赚，招商赚）=========================================
                case 'claimTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "claimTask_resq";
                    $this->claimTask();
                    break;
                //===================================上报经销商信息=========================================
                case 'upAgency':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upAgency_resq";
                    $this->upAgency();
                    break;
                //===================================获取经销商列表=========================================
                case 'getAgencyList';
                    $this->out_other();
                    $this->out_arr['re_command'] = "getAgencyList_resq";
                    $this->getAgencyList();
                    break;
                //===================================获取经销商详情=========================================
                case 'getAgency':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getAgency_resq";
                    $this->getAgency();
                    break;
                //===================================删除经销商信息=========================================
                case 'delAgency';
                    $this->out_other();
                    $this->out_arr['re_command'] = "delAgency_resq";
                    $this->delAgency();
                    break;
                //===================================提现密码(设置，修改，验证)=========================================
                case 'withdrawal':
                    $this->out_other();
                    $this->out_arr['re_command'] = "withdrawal_resq";
                    $this->withdrawal();
                    break;
                //===================================上传头像=========================================
                case 'upHeadimg':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upHeadimg_resq";
                    $this->upHeadimg();
                    break;
                //===================================取我的任务数=========================================
                case 'getTaskSNo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTaskSNo_resq";
                    $this->getTaskSNo();
                    break;
                //===================================提交随手任务=========================================
                case 'upWidelyTask':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upWidelyTask_resq";
                    $this->upWidelyTask();
                    break;
                //===================================提交随手任务确认=========================================
                case 'upWidelyTaskSure':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upWidelyTaskSure_resq";
                    $this->upWidelyTaskSure();
                    break;
                //===================================base64上传图片=========================================
                case 'upfile_base64':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upfile_base64_resq";
                    $this->upfile_base();
                    break;
                //===================================签到->消费记录->抽奖次数==============================================
                case 'checkins';
                    $this->out_other();
                    $this->out_arr['re_command'] = "checkins_resq";
                    $this->checkins();
                    break;
                //===================================当月签到列表==============================================
                case 'checkins_list':
                    $this->out_other();
                    $this->out_arr['re_command'] = "checkins_list_resq";
                    $this->checkins_list();
                    break;
                //===================================意见反馈==============================================
                case 'addOpinion':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addOpinion_resq";
                    $this->addOpinion();
                    break;
                //===================================分享===================================
                case 'share':
                    $this->out_other();
                    $this->out_arr['re_command'] = "share_resq";
                    $this->share();
                    break;
                //========================资质及文档============================================
                case 'qualific_list':
                    $this->out_other();
                    $this->out_arr['re_command'] = "qualific_list_resq";
                    $this->qualific_list();
                    break;
                //============================ALIPAY批量付款====================================
                case 'payment_alipay':
                    $this->out_other();
                    $this->out_arr['re_command'] = "payment_alipay_resq";
                    $this->payment_alipay();
                    break;

                //=================================新增和修改教育经历==============================
                case 'eduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "eduInfo_resq";
                    $this->eduInfo();
                    break;
                //=================================删除教育经历==============================
                case 'deleduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "deleduInfo_resq";
                    $this->deleduInfo();
                    break;
                //=================================删除工作经历==============================
                case 'delworkInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "delworkInfo_resq";
                    $this->delworkInfo();
                    break;
                //=================================新增和修改工作经历==============================
                case 'workInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "workInfo_resq";
                    $this->workInfo();
                    break;
                //=================================获取工作经历==============================
                case 'getWorkInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getWorkInfo_resq";
                    $this->getWorkInfo();
                    break;
                //=================================获取教育经历==============================
                case 'getEduInfo':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getEduInfo_resq";
                    $this->getEduInfo();
                    break;
                //=================================获取行业信息==============================
                case 'getIndustry':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getIndustry_resq";
                    $this->getIndustry();
                    break;
                //===================================获取行业标签==============================
                case 'getSkillLabel':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getSkillLabel_resq";
                    $this->getSkillLabel();
                    break;
                //===================================获取聊天内容未读个数==============================
                case 'getTalkNum':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTalkNum";
                    $this->getTalkList();
                    break;
                //===================================获取聊天列表==============================
                case 'getTalkList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getTalkList_resq";
                    $this->getTalkList();
                    break;
                //===================================添加聊天内容==============================
                case 'addTalk':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addTalk_resq";
                    $this->addTalk();
                    break;
                //===================================删除聊天内容==============================
                case 'deleteTalk':
                    $this->out_other();
                    $this->out_arr['re_command'] = "deleteTalk_resq";
                    $this->deleteTalk();
                    break;
                //================================部门添加=================================
                case 'addDept':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addDept_resq";
                    $this->addDept();
                    break;
                //==================================部门更新==============================
                case 'updateDept':
                    $this->out_other();
                    $this->out_arr['re_command'] = "updateDept_resq";
                    $this->updateDept();
                    break;
                //===================================部门删除==============================
                case 'delteDept':
                    $this->out_other();
                    $this->out_arr['re_command'] = "delteDept_resq";
                    $this->delteDept();
                    break;
                //================================获取部门列表======================
                case 'getDeparts':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getDeparts_resq";
                    $this->getDeparts();
                    break;
                //=======================添加部门下员工信息====================
                case 'addDeptuser':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addDeptuser_resq";
                    $this->addDeptuser();
                    break;
                //======================获取部门下的员工信息=============
                case 'getUsersByDepart':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getUsersByDepart_resq";
                    $this->getUsersByDepart();
                    break;
                //======================获得经销商进程列表=============
                case 'getDealerList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getDealerList_resq";
                    $this->getDealerList();
                    break;
                //======================获得授权书=============
                case 'getWarrantList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getWarrantList_resq";
                    $this->getWarrantList();
                    break;
                //=================================上传通讯录=============================
                case 'upContacts':
                    $this->out_other();
                    $this->out_arr['re_command'] = "upContacts_resq";
                    $this->upContacts();
                    break;
                //=================================获取通讯录=============================
                case 'getContacts':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getContacts_resq";
                    $this->getContacts();
                    break;
                //=================================处理通讯录=============================
                case 'manageContacts':
                    $this->out_other();
                    $this->out_arr['re_command'] = "manageContacts_resq";
                    $this->manageContacts();
                    break;

                //==============记录打开APP========================
                case 'openApp':
                    $this->out_other();
                    $this->out_arr['re_command'] = "openApp_resq";
                    $this->openApp();
                    break;
                //=================================获得答题页面=============================
                case 'getChoicesList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getChoicesList_resq";
                    $this->getChoicesList();
                    break;
                //=================================获得调研与答题页面任务预览=============================
                case 'getChoicesListPreview':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getChoicesListPreview_resq";
                    $this->getChoicesListPreview();
                    break;
                //=================================获得调研页面=============================
                case 'getChooseList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getChooseList_resq";
                    $this->getChooseList();
                    break;
                //=================================获得推荐页面=============================
                case 'getSpreadList':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getSpreadList_resq";
                    $this->getSpreadList();
                    break;
                //=================================获得推荐页面任务预览=============================
                case 'getSpreadListPreview':
                    $this->out_other();
                    $this->out_arr['re_command'] = "getSpreadListPreviewPreview_resq";
                    $this->getSpreadListPreview();
                    break;

                //================================APP相关内容================================
                case 'aboutapp':
                    $this->out_other();
                    $this->out_arr['re_command'] = "aboutapp_resq";
                    $this->aboutapp();
                    break;
                //=================================微信===============================
                //通过微信unionId获取用户信息
                case 'weixinLogin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "weixinLogin";
                    $this->weixinLogin();
                    break;

                //用户绑定微信的$unionId
                case 'addWeixin':
                    $this->out_other();
                    $this->out_arr['re_command'] = "addWeixin";
                    $this->addWeixin();
                    break;
                //微信端进入微信任务页面绑定
                case 'regist_bind':
                    $this->out_other();
                    $this->out_arr['re_command'] = "regist_bind";
                    $this->regist_bind();
                    break;
                //版本认证
                case 'versions_oath':
                    $this->out_other();
                    $this->out_arr['re_command'] = "versions_oath_resq";
                    $this->versions_oath();
                    break;
                case 'getFacList':
//                    command=getFacAgeList&userId=12049&companyId=1393
                    $this->out_other();
                    $this->out_arr['re_command'] = "getFacList_resq";
                    $this->getFacList();
                    break;
                //
                //======================================参数错误的情况==================================
                default:
                    $this->out_arr['conf_auth'] = "F";
                    $this->out_arr['auth_code'] = "conf_error";
                    $this->out_arr['retime'] = time();
                    $this->out_arr['retime_pre'] = date('YmdHis');
                    break;
            }
            //输入返回数据:如果有debugout，则打印返回数据，否则输出使用数据
            if (isset($this->in_arr['debugout'])) {
                pt($this->out_arr);
            } else {
                //写入日志
                \Think\Log::write("OUT:::".json_encode($this->out_arr),"NOTICE");
                echo A('Fun')->JSON($this->out_arr);
            }
        }
    }

    //返回基本数据
    private function out_other()
    {
        $this->out_arr['conf_auth'] = "T";
        $this->out_arr['auth_code'] = "conf_success";
        $this->out_arr['retime'] = time();
        $this->out_arr['retime_pre'] = date('YmdHis');
    }
    //====================END================================================================

    //============================检查是否存在或者是否为空=====================================
    private function isset_F($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            if (!isset($this->in_arr[$arr[$i]])) {
                return false;
            }
        }
        return true;
    }

    private function empty_F($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            //echo $this->in_arr[$arr[$i]];
            //dump(empty($this->in_arr[$arr[$i]]));
            if (empty($this->in_arr[$arr[$i]])) {
                return false;
            }
        }
        return true;
    }
    //=========================================END============================================

    /**
     * ==========================PHP平台登录认证=========================================================
     * @param string $username 用户名
     * @param string $password 密码
     * @return json返回登录结果
     */
    private function platformlogin()
    {
        $result = D('User')->userinfo($this->in_arr['username'], $this->in_arr['password']);
        // var_dump($result);
        // var_dump(session('id'));
        // exit();
        if ($result == 0) {
            $this->out_arr['error_code'] = 'platform_login_error';
            $this->out_arr['error_text'] = '用户名或密码错误';
            //$this->out_arr['list'] = "";
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '登录成功';
            //$this->out_arr['list'] = $result;
        }

    }
    //=========================================END============================================

    private function err(){
        $this->out_arr['error_code'] = 'sms_error';
        $this->out_arr['error_text'] = '请输入默认验证码888888，然后点击下一步';
    }

    /**
     * ==========================JAVA登录认证-招商=========================================================
     * @param string $phone 手机号
     * @param string $password 密码
     * @return json返回云之讯结果
     */
    private function zslogin()
    {
        $re = A('Jhttp')->login($this->in_arr['phone'], $this->in_arr['password']);
        //pt($re);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        //pt($arr);
        if ($errorCode == '000000') {
            //记录登录日志
            $reg = M("regapp")->field("f_udid")->where("f_mobile='" . $arr['list']['mobile'] . "'")->find();
            if ($reg) {
                $map['f_udid'] = $reg["f_udid"];
            } else {
                $map['f_udid'] = 0;
            }
            $map['f_userid'] = $arr['list']['userId'];
            $map['f_logintime'] = time();
            $map['f_mobile'] = $arr['list']['mobile'];
            $map['f_regtime'] = $arr['list']['userCreatetime'];

            M('login_log')->add($map);

            //需要后期删除的代码
            $curl_data = array('username' => $this->in_arr['phone'], 'password' => $this->in_arr['password'], 'nickname' => '');
            $result = A('Easemob')->easemob_reg_user($curl_data);
            $returnArr = json_decode($result, true);
            if (!isset($returnArr['entities'])) {
                $result = A('Easemob')->easemob_reg_user($curl_data);
                $returnArr = json_decode($result, true);
                if (!isset($returnArr['entities'])) {
                    A('Easemob')->easemob_reg_user($curl_data);
                }
            }

            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } elseif ($errorCode == '100001') {
            $this->out_arr['error_code'] = 'pw_error';
            $this->out_arr['error_text'] = '手机号或密码错误';
        } else {
            $this->out_arr['error_code'] = 'zs_login_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //=========================================END==============================================

    /**
     * ==========================JAVA招商APP注册=========================================================
     * @param string $phone 手机号
     * @param string $password 密码
     */
    private function zsreguser()
    {
        $expandkey = explode("|", isset($this->in_arr['expandkey']) ? $this->in_arr['expandkey'] : "");
        $expandval = explode("|", isset($this->in_arr['expandval']) ? $this->in_arr['expandval'] : "");
        if (count($expandkey) >= 0 && count($expandval) >= 0) {
            for ($i = 0; $i < count($expandkey); $i++) {
                $expand .= "&" . $expandkey[$i] . "=" . $expandval[$i];
            }
        } else {
            $expand = "";
        }
        $phone = $this->in_arr['phone'];
        $password = $this->in_arr['password'];
        $invitationCode = isset($this->in_arr['invitationCode']) ? $this->in_arr['invitationCode'] : 0;
        $invitationCode = empty($invitationCode) ? 0 : $invitationCode;
        //$invitationCode = empty($this->in_arr['invitationCode'])?0:$this->in_arr['invitationCode'];
        $companyid = isset($this->in_arr['companyid']) ? $this->in_arr['companyid'] : 1;
        $re = A('Jhttp')->zsreguser($phone, $password, $companyid, $invitationCode, $expand);
        $arr = json_decode($re, true);
        //pt($arr);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            if ($arr['inviterId'] != 0) {
//                D('Shopsheet')->add_shopsheet('Invite', $arr['userId'], 1, 1, 50, 0, 1, 0, 0);
//                D('Shopsheet')->add_shopsheet('Invite', $arr['inviterId'], 1, 1, 20, 0, 1, 0, 0);
            } else {
                $reg['f_mobile'] = $phone;
                $reg['f_udid'] = isset($this->in_arr['udid']) ? $this->in_arr['udid'] : 0;
                $reg['f_uptime'] = time();
                M("regapp")->add($reg);
                $curl_data = array('username' => $this->in_arr['phone'], 'password' => $this->in_arr['password'], 'nickname' => '');
                A('Easemob')->easemob_reg_user($curl_data);
                //查找活动认领情况
                $a['f_newmobile'] = $this->in_arr['phone'];
                $re_c = M("newuserclaim")->where($a)->find();
                //echo M("newuserclaim")->getLastSql();
                //pt($re_c);
//                if (count($re_c) > 0) {
//                    $label = 'events';
//                    $amounttype = 1;
//                    $shopingtype = 1;
//                    $taskid = 0;
//                    $strats = 1;
//                    $useraccountid = 0;
////                    D('Shopsheet')->add_shopsheet($label, $arr['userId'], $amounttype, $shopingtype, 50, $taskid, $strats, $useraccountid, $re_c['f_id']);
////                    D('Shopsheet')->add_shopsheet($label, $re_c['f_userid'], $amounttype, $shopingtype, 20, $taskid, $strats, $useraccountid, $re_c['f_id']);
//                } else {
////                    D('Shopsheet')->add_shopsheet('Invite', $arr['userId'], 1, 1, 50, 0, 1, 0, 0);
//                }
            }
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'user_exist';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //=========================================END==============================================




    /**
     * ==========================获取用户当前余额=========================================================
     * @param string $userid 用户ID
     * @param string $password 密码
     */
    private function zsTotalCollect()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $re = M('userbalance')->while($map)->find();
        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        $this->out_arr['list'] = $re;
    }
    //=========================================END==============================================


    /**
     * ==========================JAVA招商APP忘记密码=========================================================
     * @param string $phone 手机
     * @param string $password 新密码
     */
    private function zsforgetpassword()
    {
        $re = A('Jhttp')->getUserinfo($this->in_arr['phone'], $this->in_arr['password']);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $re_1 = A('Jhttp')->withdrawal(1, $arr['list']['userId'], $this->in_arr['password']);
            $arr_1 = json_decode($re_1, true);
            $errorCode_1 = $arr_1['resCode'];
            if ($errorCode_1 == '000000') {

                $body = array('newpassword' => $this->in_arr['password']);
                A('Api/Easemob')->easemob_modi_password($body, $re['list']['mobile']);

                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
            } else {
                $this->out_arr['error_code'] = 'forgetpw_sys_error';
                $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode_1);
            }
        } else {
            $this->out_arr['error_code'] = 'modipw_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //=========================================END==============================================

    /**
     * ======================================智慧运营平台登录=====================================
     */
    private function login()
    {
        $re = A('Jhttp')->companylogin($this->in_arr['phone'], $this->in_arr['password']);
        $arr = json_decode($re, true);
//         pt($arr);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            if ($arr['count'] == 0) {
                $this->out_arr['error_code'] = 'user_no_exist';
                $this->out_arr['error_text'] = '用户不存在';
            } else {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                //$this->out_arr['token'] = $arr['ssoToken'];
                $this->out_arr['list'] = $arr['list'];
            }
        } elseif ($errorCode == '100001') {
            $this->out_arr['error_code'] = 'userorpw_error';
            $this->out_arr['error_text'] = '手机号或密码错误';
        } else {
            $this->out_arr['error_code'] = 'login_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }

    }
    //=========================================END==============================================

    /**
     * =====================================智慧运营平台登录成功后，加载用户和企业信息(手机)=====================================
     */
    private function ulogin()
    {
        $re = A('Jhttp')->userlogin($this->in_arr['companyid'], $this->in_arr['phone']);

//        dump($re);exit;
        $arr = json_decode($re, true);

//        dump($arr['facIdList']);exit;

        //pt($arr);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['ssoToken'] = $arr['ssoToken'];
            $this->out_arr['list'] = $arr['list'];
            $this->out_arr['is_rem'] = $this->in_arr['is_rem'];
        } else {
            $this->out_arr['error_code'] = 'userlogin_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //=========================================END==============================================

    /**
     * =====================================智慧运营平台登录成功后，加载用户和企业信息(WEB)=====================================
     */
    private function userlogin()
    {
        $re = A('Jhttp')->userlogin($this->in_arr['companyid'], $this->in_arr['phone']);

//        dump($re);exit;
        $arr = json_decode($re, true);

//        dump($arr['facIdList']);exit;

//        pt($arr);exit;
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['ssoToken'] = $arr['ssoToken'];
            $this->out_arr['list'] = $arr['list'];
            $this->out_arr['is_rem'] = $this->in_arr['is_rem'];


            if ($this->in_arr['is_rem'] == "0") { //没记住密码,通过loginstrats来判断是否登录，只需要把这个区别开即可
                //存入session
                session('loginstrats', 1);
            } else {
                //存入cookie
                cookie('loginstrats', 1);
            }

            $facIdList = empty($arr['facIdList']) ? 'fac' : $arr['facIdList'];  //为空是厂商，传一个默认值

            cookie('facIdList', $facIdList); //为空是厂商，不为空是经销商
            cookie('ssoToken', $arr['ssoToken']);
            cookie('companyId', $arr['list']['company']['companyId']);
            cookie('companyName', $arr['list']['company']['companyName']);
            cookie('companyState', $arr['list']['company']['state']); //企业是否审核
            cookie('companyLevel', $arr['list']['company']['level']); //企业等级 金牌 银牌 钻石
            cookie('departId', $arr['list']['user']['departId']);
            cookie('userId', $arr['list']['user']['userId']);
            cookie('nickName', $arr['list']['user']['nickName']);
            cookie('trueName', $arr['list']['user']['trueName']);
            cookie('mobile', $arr['list']['user']['mobile']);
            cookie('invitationCode', $arr['list']['user']['invitationCode']);
            cookie('facIdList', $arr['list']['facIdList']);
            //exit;

        } else {
            $this->out_arr['error_code'] = 'userlogin_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //=========================================END==============================================


    /**
     * ==========================云之讯语音验证码=========================================================
     * @param string $voicephone 验证的手机号
     * @return json返回云之讯结果
     */
    private function voiceCode(){
        //处理验证码
        $map['F_VOICECODE'] = rand(1111,9999);
        $map['F_VOICEPHONE'] = $this->in_arr['voicephone'];
        $map['F_TIMESTAMP'] = time();
        $map['F_STRAT'] = 0;

//        if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|177[0-9]{8}$|189[0-9]{8}$/",$map['F_VOICEPHONE'])){
        if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|177[0-9]{8}$|189[0-9]{8}$|187[0-9]{8}$/",$map['F_VOICEPHONE'])){  //添加187号码段
            $this->out_arr['error_code'] = 'phone_format_error';
            $this->out_arr['error_text'] = '手机格式出错';
        }else {

            $smsRe = M('voicecode')->where("F_VOICEPHONE=" . $map['F_VOICEPHONE'] . " and F_STRAT=0")->order("f_vid desc")->find();
            if ($smsRe) {
                $difftime = ceil(time() - $smsRe["f_timestamp"]);
                if ($difftime <= 60) {
                    $this->out_arr['error_code'] = 'v_time';
                    $this->out_arr['error_text'] = '60秒后再试';
                } else {
                    $this->ucpaas_voice($map);
                }
            } else {
                $this->ucpaas_voice($map);
            }
        }
    }
    //========================END========================================================================

    /**
     * ==========================云之讯短信验证码=========================================================
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
        if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$map['F_VOICEPHONE'])){
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
    //========================END========================================================================
    //短信发送
    private function ucpaas_sms($map){
        //组装云之讯的报文
        $body = array('templateSMS' => array(
            'appId' => C('appId'),
            'param' => $map['F_VOICECODE'],
            'templateId' => 6852,
            'to' => $map['F_VOICEPHONE'],
        ));
        //pt($body);
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Messages/templateSMS', json_encode($body)), true);
        if ($result['resp']['respCode'] != '000000') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            M('voicecode')->add($map);
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['smsId'] = $result['resp']['templateSMS']['smsId'];
        }
    }

    private function ucpaas_voice($map){
        //组装云之讯的报文
        $body = array('voiceCode' => array(
            'appId' => C('appId'),
            'verifyCode' => $map['F_VOICECODE'],
            'to' => $map['F_VOICEPHONE'],
            'displayNum'=>'4008813609',
        ));
        //pt($body);
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Calls/voiceCode',json_encode($body)),true);
        if($result['resp']['respCode']!='000000'){
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        }else{
            //成功的话，写数据库
            M('voicecode')->add($map);
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['callId'] = $result['resp']['voiceCode']['callId'];
        }
    }

    /**
     * ==========================云之讯语音通知=========================================================
     * @param string $voicephone 验证的手机号
     * @return json返回云之讯结果
     */
    private function voiceNotify()
    {

    }
    //========================END========================================================================

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


//$map['F_VOICECODE'] = isset($this->in_arr['code']) ? $this->in_arr['code'] : 0;
//$map['F_VOICEPHONE'] = $this->in_arr['voicephone'];
//$map['F_STRAT'] = 0;
//$result = M('voicecode')->where($map)->order("f_vid desc")->find();
//if (!$result) {
//$this->out_arr['error_code'] = 'voicecode_error';
//$this->out_arr['error_text'] = '验证码已经被使用';
//} else {
//    $difftime = ceil(time()-$result["f_timestamp"]);
//    if($difftime>=1800){
//        $this->out_arr['error_code'] = 'sms_overtime';
//        $this->out_arr['error_text'] = '验证码已经超时，请重新获取';
//        $map_1['F_VOICECODE'] = $map['F_VOICECODE'];
//        $map_1['F_VOICEPHONE'] = $map['F_VOICEPHONE'];
//        M('voicecode')->where($map_1)->setField("F_STRAT=2");
//    }else{
//        $this->out_arr['error_code'] = 'success';
//        $this->out_arr['error_text'] = '';
//        //成功后，改变状态
//        $map_1['F_VOICECODE'] = $map['F_VOICECODE'];
//        $map_1['F_VOICEPHONE'] = $map['F_VOICEPHONE'];
//        M('voicecode')->where($map_1)->setField("F_STRAT=1");
//    }
//}
    //========================END========================================================================

    /**
     * ==========================双向回拨=========================================================
     * @param string $appId 应用ID
     * @param string $fromClient 主叫方的ClientNumber 72830004925462
     * @param string $to 被叫手机号
     * @param string $fromSerNum 主叫方显示的号码
     * @param string $toSerNum 被叫方显示的号码
     * @param string $maxallowtime 通话时长
     * @return 返回验证结果
     */
    private function call()
    {
        // $this->in_arr['fromClient']
        if (isset($this->in_arr['fromsernum']) || empty($this->in_arr['fromsernum'])) {
            $this->in_arr['fromsernum'] = '4008813609';
        }
        if (isset($this->in_arr['tosernum']) || empty($this->in_arr['tosernum'])) {
            $this->in_arr['tosernum'] = null;
        }
        $body = array('callback' => array(
            'appId' => C('yy_appId'),
            'fromClient' => $this->in_arr['fromclient'],
            'fromSerNum' => $this->in_arr['fromsernum'],
            'to' => $this->in_arr['to'],
            'toSerNum' => $this->in_arr['tosernum']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Calls/callBack', json_encode($body)), true);
        if($result['resp']['respCode']=="000000"){
            $this->out_arr = $result['resp']['callback'];
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }else{
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        }
//        pt($result);
    }
    //========================END========================================================================

    /**
     * ==========================申请Client账号=========================================================
     * @param string $appId 应用ID
     * @param string $clientType 主叫方的ClientNumber 72830004925462
     * @param string $charge 充值金额
     * @return 返回验证结果
     */
     public function clients($mobile)
     {
         $mobile = empty($this->in_arr['mobile'])?$mobile:$this->in_arr['mobile'];
         $body = array('client' => array(
             'appId' => C('yy_appId'),
             'charge' => '0',
             'clientType' => '0',
             'friendlyName'=>'',
             'mobile'=>$mobile
         ));
//         pt($body);
         $ucpaas = A('Ucpaas');
         $result = json_decode($ucpaas->in_ucpaas('Clients', json_encode($body)), true);
//         pt($result);
         if ($result['resp']['respCode'] != '000000') {
             $this->out_arr['error_code'] = $result['resp']['respCode'];
             $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
         } else {
             $this->out_arr = $result;
             $this->out_arr['error_code'] = 'success';
             $this->out_arr['error_text'] = '';
         }
//         A('Fun')->JSON($this->out_arr);
         return $this->out_arr;
     }
    //========================END========================================================================

    private function getClient(){
        $body = array('client' => array(
            'appId' => C('yy_appId'),
            'start' => '0',
            'limit' => '100'
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('clientList', json_encode($body)), true);
        pt($result);
    }


    /**
     * ==========================1. 创建会议=========================================================
     * @param string $appId 应用ID
     * @param string $mediaType 会议类型
     * @param string $maxMember 最大会议人数
     * @param string $duration 最大会议时长（单位：分钟）
     * @param string $playTone 是否播放提示音
     * @param string $showNumber 合法会议呼出显示号码
     * @param string $flagMute 是否入会静音
     * @return 返回验证结果
     */
    private function createMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'mediaType' => '1',
            'maxMember' => '300',
            'duration'=>'0',
            'playTone'=>'1',
            'showNumber'=>'4008813609',
            'flagMute'=>'2'
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/create', json_encode($body)), true);

        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================2.  解散会议=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function dismissMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/dismiss', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================查询会议=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function queryMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId']
            // 'confId' => '10000EA4'
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/query', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================


    public function post_inviteMeeting(){
        $in_arr = stripslashes(file_get_contents("php://input"));
//        $in_arr_1 =  iconv("gb2312","utf-8//IGNORE",$in_arr);
        //写入日志
        \Think\Log::write("inviteMeeting_IN:".$in_arr,"NOTICE");
        $this->in_arr = json_decode($in_arr,true);
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'memberList' => json_encode($this->in_arr['memberList'])
        ));
        \Think\Log::write("inviteMeeting_IN:".json_encode($body),"NOTICE");
        $this->out_other();
        $this->out_arr['re_command'] = "inviteMeeting_resq";
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/invite', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
        //写入日志
        \Think\Log::write("inviteMeeting_OUT:".json_encode($this->out_arr),"NOTICE");
        echo A('Fun')->JSON($this->out_arr);
    }

    /**
     * ==========================邀请加入=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $memberList 会议成员列表
     * @return 返回验证结果
     */
    private function inviteMeeting()
    {
//        $memberList = array(
//          'nickName'=>'tone188',
//          'number'=>'18800015233',
//          'role'=>'1',
//          'callType'=>'2',
//        );
        $inArr = base64_decode($this->in_arr['param']);
        \Think\Log::write("inviteMeeting_IN:".$inArr,"NOTICE");
        $arr = json_decode($inArr,true);
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $arr['confId'],
            'memberList' => json_encode($arr['memberList'])
        ));
        \Think\Log::write("inviteMeeting_IN:".json_encode($body),"NOTICE");
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/invite', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================移除成员=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id。
     * @return 返回验证结果
     */
    private function removeMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/remove', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================成员静音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id。
     * @return 返回验证结果
     */
    private function muteMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/mute', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================取消成员静音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id。
     * @return 返回验证结果
     */
    private function unmuteMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/unmute', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================成员禁听=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id。
     * @return 返回验证结果
     */
    private function deafMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/deaf', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================取消成员禁听=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id。
     * @return 返回验证结果
     */
    private function undeafMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/undeaf', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================10.    会场录音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function recordMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId']
            // 'confId' => '10000EA4'
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/record', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================停止会场录音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function stopRecordMember()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/stopRecord', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================12.    会场放音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $playFile 放音文件标示
     * @return 返回验证结果
     */
    private function confPlay()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'playFile' => ''
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/confPlay', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================停止会场放音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function stopConfPlay()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId']
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/stopConfPlay', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================设置会议主席=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $callId 呼叫Id
     * @param string $flag 0：取消会议主席；1：设置会议主席
     * @return 返回验证结果
     */
    private function setHost()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'callId' => $this->in_arr['callId'],
            'flag' => $this->in_arr['flag'],
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/setHost', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================15.    延长会议时间=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $duration 延长的时长
     * @return 返回验证结果
     */
    private function delayMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'duration' => $this->in_arr['duration'],
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/delay', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================16.    锁定会议=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @param string $flag 1：锁定；2：取消锁定。
     * @return 返回验证结果
     */
    private function lockMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
            'flag' => $this->in_arr['flag'],
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/lock', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================17.    获取会议列表=========================================================
     * @param string $appId 应用ID
     * @return 返回验证结果
     */
    private function queryAllMeeting()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId')
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/queryAll', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================18.    全场禁音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function muteAll()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/muteAll', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================19.    取消全场禁音=========================================================
     * @param string $appId 应用ID
     * @param string $confId 会议类型
     * @return 返回验证结果
     */
    private function unmuteAll()
    {
        $body = array('conf' => array(
            'appId' => C('yy_appId'),
            'confId' => $this->in_arr['confId'],
        ));
        $ucpaas = A('Ucpaas');
        $result = json_decode($ucpaas->in_ucpaas('Conference/unmuteAll', json_encode($body)), true);
        if ($result['resp']['respCode'] != '0') {
            $this->out_arr['error_code'] = $result['resp']['respCode'];
            $this->out_arr['error_text'] = A('Ucsercode')->searchCode($result['resp']['respCode']);
        } else {
            $this->out_arr = $result;
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }
    }
    //========================END========================================================================

    /**
     * ==========================各种类型的任务列表,按时间和申请人数来排序=========================================================
     * ==========================每次请求发送10条记录=========================================================
     * @param int $F_TASKTYPEID 任务类型ID
     * @param int $START_RECORD 开始的记录值
     * @return json返回JSON格式的记录
     */
    private function getTaskList()
    {
        //$share = isset($this->in_arr['userid'])?$this->in_arr['userid']:0;
        $userid = isset($this->in_arr['userid']) ? $this->in_arr['userid'] : 0;
        $tasktypeid = $this->in_arr['tasktypeid'];
        if ($userid == 0) {
            if ($this->in_arr['hometask'] == '1' || $this->in_arr['hometask'] == 1) {
                $list = D('Task')->getHomeDateList($this->in_arr['hometask']);
                //$this->out_arr['list']=$list;
                if (count($list) > 0) {
                    $map["f_top"] = 1;
                    $map["f_type"] = 1;
                    $j = array('LEFT JOIN t_files ON t_files.f_id = t_ad.f_fid');
                    $adlist = M("ad")->field("t_ad.f_id,f_title,f_desc,f_url,f_type,f_isurl,f_filename,f_filepath")->where($map)->join($j)->select();
                    foreach ($adlist as $key => $val) {
                        $adlist[$key]["noteurl"] = C('WebUrl') . U('mobileweb/events/index?id=' . $val["f_id"]);
                        $adlist[$key]["f_url"] = C('WebUrl') . U('mobileweb/events/share') . "?userid=";
                    }
                    $emap["f_top"] = 1;
                    $emap["f_type"] = 3;
                    $ej = array('LEFT JOIN t_files ON t_files.f_id = t_ad.f_fid');
                    $evenlist = M("ad")->field("t_ad.f_id,f_title,f_desc,f_url,f_type,f_isurl,f_filename,f_filepath")->where($emap)->join($ej)->select();
                    foreach ($evenlist as $key => $val) {
                        $evenlist[$key]["noteurl"] = C('WebUrl') . U('mobileweb/events/activitys?id=' . $val["f_id"]);
                        // $evenlist[$key]["noteurl"] = "http://intest.51lick.cn/index.php/Mobileweb/Events/surveyClass?userid=1&taskid=463";
                        $evenlist[$key]["f_url"] = C('WebUrl') . U('mobileweb/events/activity') . "?userid=";
                    }

                    $startTime=date("Y-m-d");
                    $endTime=strtotime($startTime)+86400;
                    $loginSum= "SELECT MAX(logintime) AS TIME ,COUNT( f_userid) AS count FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime>='".strtotime($startTime)."' AND f_logintime<='".$endTime."' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid ) AS t GROUP BY t.logintime";
                    $loginResult = M('login_log')->query($loginSum);
                    $this->out_arr['loginCount'] = isset($loginResult[0]['count'])?$loginResult[0]['count']+5000:5000;

                    $where['f_uptime'] = array(array('egt',strtotime($startTime)),array('elt',$endTime),'and');
                    $regResult= M("regapp")->where($where)->count();
                    $this->out_arr['regCount'] = isset($regResult)?$regResult+4250:4250;

                    $condition['f_optiondate'] = array(array('egt',strtotime($startTime)),array('elt',$endTime),'and');
                    $condition['f_shopingtype'] = '1';
                    $coinResult= M("shopsheet")->field('SUM(f_amount) as sum')->where($condition)->select();
                    $this->out_arr['coinCount'] = isset($coinResult[0]['sum'])?$coinResult[0]['sum']+25000:25000;

                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['list'] = $list;
                    $this->out_arr['adlist'] = $adlist;
                    $this->out_arr['evenlist'] = $evenlist;
                } else {
                    $this->out_arr['error_code'] = 'list_empty';
                    $this->out_arr['error_text'] = '暂无数据';
                    $this->out_arr['list'] = "";
                }
            } else {
                //获取当前页码，默认为1
                if (!$this->isset_F(array('page'))) {
                    $this->in_arr['page'] = 1;
                } else {
                    if ($this->in_arr['page'] == "" || $this->in_arr['page'] == "0") {
                        $this->in_arr['page'] = 1;
                    }
                }
                $in_Id = A('Fun')->getTaskTypeId($tasktypeid);
                //$START_RECORD = $this->in_arr['START_RECORD'];
                $total = D('Task')->getTaskNo($in_Id);//总记录数
                //$total = $obj->count();//总记录数
                $pageSize = 10; //每页显示数
                $totalPage = ceil($total / $pageSize); //总页数
                //构造数组
                $this->out_arr['page'] = $this->in_arr['page'];
                $this->out_arr['total'] = $total;
                $this->out_arr['pageSize'] = $pageSize;
                $this->out_arr['totalPage'] = $totalPage;

                // echo $in_Id;
                $list = D('Task')->getDateList($in_Id, $this->in_arr['page'], $pageSize,$tasktypeid,$userid=0,$strats=0);

                foreach ($list as $key => $value) {
                    if (isset($value['f_description']) && !empty($value['f_description'])) {
                        $list[$key]['f_description'] = trim($list[$key]['f_description']);
                        $list[$key]['f_description'] = ereg_replace("\t", "", $list[$key]['f_description']);
                        $list[$key]['f_description'] = ereg_replace("\r\n", "", $list[$key]['f_description']);
                        $list[$key]['f_description'] = ereg_replace("\r", "", $list[$key]['f_description']);
                        $list[$key]['f_description'] = ereg_replace("\n", "", $list[$key]['f_description']);
                    }
                    if (isset($value['f_taskrequirements']) && !empty($value['f_taskrequirements'])) {
                        $list[$key]['f_taskrequirements'] = trim($list[$key]['f_taskrequirements']);
                        $list[$key]['f_taskrequirements'] = ereg_replace("\t", "", $list[$key]['f_taskrequirements']);
                        $list[$key]['f_taskrequirements'] = ereg_replace("\r\n", "", $list[$key]['f_taskrequirements']);
                        $list[$key]['f_taskrequirements'] = ereg_replace("\r", "", $list[$key]['f_taskrequirements']);
                        $list[$key]['f_taskrequirements'] = ereg_replace("\n", "", $list[$key]['f_taskrequirements']);
                    }
                    if (isset($value['f_note']) && !empty($value['f_note'])) {
                        $list[$key]['f_note'] = trim($list[$key]['f_note']);
                        $list[$key]['f_note'] = ereg_replace("\t", "", $list[$key]['f_note']);
                        $list[$key]['f_note'] = ereg_replace("\r\n", "", $list[$key]['f_note']);
                        $list[$key]['f_note'] = ereg_replace("\r", "", $list[$key]['f_note']);
                        $list[$key]['f_note'] = ereg_replace("\n", "", $list[$key]['f_note']);
                    }
                    if (isset($value['f_product']) && !empty($value['f_product'])) {
                        $list[$key]['f_product'] = trim($list[$key]['f_product']);
                        $list[$key]['f_product'] = ereg_replace("\t", "", $list[$key]['f_product']);
                        $list[$key]['f_product'] = ereg_replace("\r\n", "", $list[$key]['f_product']);
                        $list[$key]['f_product'] = ereg_replace("\r", "", $list[$key]['f_product']);
                        $list[$key]['f_product'] = ereg_replace("\n", "", $list[$key]['f_product']);
                    }

                }
                // var_dump($list);exit();
                if (count($list) > 0) {
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                    $this->out_arr['list'] = $list;
                } else {
                    $this->out_arr['error_code'] = 'list_empty';
                    $this->out_arr['error_text'] = '暂无数据';
                    $this->out_arr['list'] = "";
                }
            }
        } else {
            $strats = isset($this->in_arr['strats']) ? $this->in_arr['strats'] : 0;

            $list = D('Task')->getDateList(0, 1, 10000, 0, $userid, $strats);

            foreach ($list as $key => $value) {
                if (isset($value['f_description']) && !empty($value['f_description'])) {
                    $list[$key]['f_description'] = trim($list[$key]['f_description']);
                    $list[$key]['f_description'] = ereg_replace("\t", "", $list[$key]['f_description']);
                    $list[$key]['f_description'] = ereg_replace("\r\n", "", $list[$key]['f_description']);
                    $list[$key]['f_description'] = ereg_replace("\r", "", $list[$key]['f_description']);
                    $list[$key]['f_description'] = ereg_replace("\n", "", $list[$key]['f_description']);
                }
                if (isset($value['f_taskrequirements']) && !empty($value['f_taskrequirements'])) {
                    $list[$key]['f_taskrequirements'] = trim($list[$key]['f_taskrequirements']);
                    $list[$key]['f_taskrequirements'] = ereg_replace("\t", "", $list[$key]['f_taskrequirements']);
                    $list[$key]['f_taskrequirements'] = ereg_replace("\r\n", "", $list[$key]['f_taskrequirements']);
                    $list[$key]['f_taskrequirements'] = ereg_replace("\r", "", $list[$key]['f_taskrequirements']);
                    $list[$key]['f_taskrequirements'] = ereg_replace("\n", "", $list[$key]['f_taskrequirements']);
                }
                if (isset($value['f_note']) && !empty($value['f_note'])) {
                    $list[$key]['f_note'] = trim($list[$key]['f_note']);
                    $list[$key]['f_note'] = ereg_replace("\t", "", $list[$key]['f_note']);
                    $list[$key]['f_note'] = ereg_replace("\r\n", "", $list[$key]['f_note']);
                    $list[$key]['f_note'] = ereg_replace("\r", "", $list[$key]['f_note']);
                    $list[$key]['f_note'] = ereg_replace("\n", "", $list[$key]['f_note']);
                }
                if (isset($value['f_product']) && !empty($value['f_product'])) {
                    $list[$key]['f_product'] = trim($list[$key]['f_product']);
                    $list[$key]['f_product'] = ereg_replace("\t", "", $list[$key]['f_product']);
                    $list[$key]['f_product'] = ereg_replace("\r\n", "", $list[$key]['f_product']);
                    $list[$key]['f_product'] = ereg_replace("\r", "", $list[$key]['f_product']);
                    $list[$key]['f_product'] = ereg_replace("\n", "", $list[$key]['f_product']);
                }
            }
            if (count($list) > 0) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['list'] = $list;
            } else {
                $this->out_arr['error_code'] = 'list_empty';
                $this->out_arr['error_text'] = '暂无数据';
                $this->out_arr['list'] = "";
            }
        }

    }

    /**
     * =======================================================根据任务ID取出详细信息===============================
     * @param int $F_TASKID 任务ID
     * @return json返回任务详细
     */
    private function getTaskNote()
    {
        //检测参数是否为空，或不存在
        if (!$this->isset_F(array('F_TASKID', 'TYPE_LABEL'))) {
            $this->out_arr['error_code'] = 'field_no_exist';
            $this->out_arr['error_text'] = '必传参数不存在';
        } else {
            //dump($this->empty_F(array('F_TASKTYPEID','START_RECORD')));
            if (!$this->empty_F(array('F_TASKID'))) {
                $this->out_arr['error_code'] = 'field_empty';
                $this->out_arr['error_text'] = '必传参数为空';
            } else {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $F_TASKID = $this->in_arr['F_TASKID'];
                $TYPE_LABEL = $this->in_arr['TYPE_LABEL'];
                $USRRID = isset($this->in_arr['userid']) ? $this->in_arr['userid'] : 0;
                //记录用户查看任务日志
                $map['f_taskid'] = $F_TASKID;
                $map['f_userid'] = $USRRID;
                $map['f_looktime'] = time();
                M('looktask_log')->add($map);
//                $result = D('Task')->getDateNote($F_TASKID);
//                $result['taskinfour2'] = C("WebUrl")."index.php/Mobileweb/Index?taskid=".$F_TASKID."&type_label=".$TYPE_LABEL;

                $this->out_arr['list'] = D('Task')->getDateNote($F_TASKID, $TYPE_LABEL, $USRRID);

                $about  =M('aboutapp')->select();
                $this->out_arr['list']['diamond_about']=$about[0]['diamond_about'];
                $this->out_arr['list']['gold_about']=$about[0]['gold_about'];
                $this->out_arr['list']['common_about']=$about[0]['common_about'];
                $this->out_arr['list']['money_about']=$about[0]['money_about'];
                $this->out_arr['list']['trust_about']=$about[0]['trust_about'];
                

                $companyid=$this->out_arr['list']['f_companyid'];
                // $re = A("Api/Jhttp")->getCompanyInfo($companyid);
                $re = A("Api/Jhttp")->getCompanyInfo(63);
                $arr = json_decode($re,true);
                $this->out_arr['list']['createtime']=$arr["list"]['createtime'];//入驻时间
                $this->out_arr['list']['industryName']=$arr["list"]['industryName'];//所属行业
                $this->out_arr['list']['address']=$arr["list"]['address'];//公司地址
                // $this->out_arr['list']['contactMobile']=$arr["list"]['contactMobile'];//统一客服
                $this->out_arr['list']['contactMobile']=$arr["list"]['contactMobile'];//统一客服
                if (isset($arr["list"]['companyLogo'])) {
                    $file = M("files")->where("f_id=".$arr["list"]['companyLogo'])->find();
                    $this->out_arr['list']['companyLogo']=$file['f_filepath'].$file['f_filename'];//公司图标
                }else{
                    $this->out_arr['list']['companyLogo']='';
                }
                $this->out_arr['list']['companyName']=$arr["list"]['companyName'];//公司图标

                if ($TYPE_LABEL=="business") {
                    $dealers = array();
                    $tryout = M("taskmtbaseinfo")->field("f_tryout,f_tryoutnumber")->where("f_taskid=".$F_TASKID)->find();
                    if ($tryout['f_tryout'] == '1') {
                        $count = M("receive_link")->where("f_ltaskid=".$F_TASKID)->count();
                        if ($count == $tryout['f_tryoutnumber']) {
                            $this->out_arr['list']['f_tryout']='0';
                            $this->out_arr['list']['f_trystatus']='试用已结束';
                        }else{
                            $data["f_luserid"] = $USRRID;
                            $data["f_ltaskid"] = $F_TASKID;
                            $isLive = M("receive_link")->field("f_lstatus")->where($data)->find();
                            if (!empty($isLive)) {
                                switch ($isLive["f_lstatus"]) {
                                    case '1':
                                        $this->out_arr['list']['f_trystatus']='等待审核';
                                        break;
                                    case '2':
                                        $this->out_arr['list']['f_trystatus']='试用审核通过';
                                        break;
                                    case '3':
                                        $this->out_arr['list']['f_trystatus']='试用审核驳回';
                                        break;
                                    default:
                                        $this->out_arr['list']['f_trystatus']='等待审核';
                                        break;
                                }
                            }else{
                                $dealers = M("dealerbaseinfo")->where("f_taskid=".$F_TASKID)->select();
                                if (!empty($dealers)) {
                                    $this->out_arr['list']['f_tryout']='0';
                                }else{
                                    $this->out_arr['list']['f_tryout']='1';
                                }
                            }
                        }
                    }else{
                        $this->out_arr['list']['f_tryout']='0';
                    }
                }
                
            }
        }
    }
    //========================END========================================================================

    /**
     * ===========================================返回返回小任务的问题和答案=====================================
     * @param int $F_TASKID 任务ID
     * @return json返回问题和选项
     */
    private function getTaskQ()
    {
        //检测参数是否为空，或不存在
//        if (!$this->isset_F(array('F_TASKID'))) {
//            $this->out_arr['error_code'] = 'field_no_exist';
//            $this->out_arr['error_text'] = '必传参数不存在';
//        } else {
//            //dump($this->empty_F(array('F_TASKTYPEID','START_RECORD')));
//            if (!$this->empty_F(array('F_TASKID'))) {
//                $this->out_arr['error_code'] = 'field_empty';
//                $this->out_arr['error_text'] = '必传参数为空';
//            } else {
//                $this->out_arr['error_code'] = 'success';
//                $this->out_arr['error_text'] = '';
//                $F_TASKID = $this->in_arr['F_TASKID'];
//                //pt(D('Task')->getDateNote($F_TASKID));
//                $this->out_arr['list'] = D('Task')->getDateQ($F_TASKID);
//            }
//        }

        $this->out_arr['error_code'] = 'task_error';
        $this->out_arr['error_text'] = '请下载新版本，再来完成任务';
    }
    //========================END========================================================================


    /**
     * ===========================================合合扫描=====================================
     * @param  $upfile 上传的文件
     * @param string $type 类型
     */
    private function card()
    {
//        $file = $_FILES['upfile'];
//        pt($_FILES['upfile']);
        A('Upfile')->initialize(array('maxSize' => 2 * 1024 * 1024, 'exts' => 'jpg,gif,png,jpeg'));
        $map = A('Upfile')->upF();
        if ($map['error_txt'] == "") {
            $path = realpath($map['path']);
            //echo $path;
            //exit;
            if ($path == "") {
                $this->out_arr['error_code'] = 'file_error';
                $this->out_arr['error_text'] = '没有上传文件';
                return false;
            } else {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                if ($this->in_arr['type'] == 1) {
                    $this->out_arr['type'] = 1;
                    $this->out_arr['list'] = A('Intsig')->vCard($path, $map['size']);
                    //$this->out_arr['list']['f_path'] = $map['f_path'];
                    //$this->out_arr['list']['f_fileid'] = $map['f_fileid'];

                } elseif ($this->in_arr['type'] == 2) {
                    $this->out_arr['type'] = 2;
                    $this->out_arr['list'] = A('Intsig')->bCard($path);
                } elseif ($this->in_arr['type'] == 3) {
                    $this->out_arr['type'] = 3;
                    $this->out_arr['list'] = A('Intsig')->iCard($path);
                } else {
                    $this->out_arr['type'] = $this->in_arr['type'];
                    $this->out_arr['error_code'] = 'type_error';
                    $this->out_arr['error_text'] = '扫描类型出错';
                    return false;
                }
                $this->out_arr['fileid'] = $map['fileid'];
                //pt($this->out_arr);
            }
        } else {
            $this->out_arr['error_code'] = 'upfile_error';
            $this->out_arr['error_text'] = $map['error_txt'];
        }
        //pt($this->out_arr['list']);
    }
    //========================END========================================================================


    //========================END========================================================================

    /**
     * ===========================================添加银行卡和支付宝===========================================
     *
     */
    private function addBankali()
    {

        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_accounttype'] = $this->in_arr['accounttype'];
        $map['f_accountname'] = isset($this->in_arr['accountname']) ? $this->in_arr['accountname'] : 0;
        $map['f_bankaccount'] = isset($this->in_arr['bankaccount']) ? $this->in_arr['bankaccount'] : 0;
        $map['f_linkdatetime'] = time();
        $map['f_status'] = 0;
        // var_dump($map);exit();

        if (($map['f_accountname'] != 0 && $map['f_bankaccount'] != 0) || ($map['f_accountname'] != '0' && $map['f_bankaccount'] != '0')) {
            $re = M('useraccount')->add($map);
        }

        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加收款帐号失败';
        }
    }
    //========================END========================================================================

    /**
     * ===========================================取银行卡和支付宝===========================================
     *
     */
    private function bankaliList()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_status'] = 0;
        $f = array('f_indexID', 'f_userid', 'f_accounttype', 'f_accountname', 'f_bankaccount');
        $re = M('useraccount')->field($f)->where($map)->select();

        if (count($re) > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无收款帐号';
        }
    }
    //========================END========================================================================
    /**
     * ===========================================删除(修改状态)银行卡和支付宝===========================================
     *
     */
    private function delBankali()
    {
        //$map['f_indexID'] = $this->in_arr['bid'];
        $bid = explode('|', $this->in_arr['bid']);
        //pt($bid);
        //echo count($bid);
        //exit();
        $map['f_status'] = 3;
        //$f = array('f_indexID','f_userid','f_accounttype','f_accountname','f_bankaccount');
        for ($i = 0; $i < count($bid); $i++) {
            $re = M('useraccount')->where('f_indexID=' . $bid[$i])->save($map);
        }

        if (count($re) > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '收款帐号有误';
        }
    }
    //========================END========================================================================

    /**
     * ===========================================消费记录：包括提款，充值，做任务===========================================
     * 消费标签：task(任务),recharge(充值),withdraw(提现),lottery(抽奖),Invite(邀请),exchange(兑换),certification(认证),daily(日常),events(活动)
     * 提款（传收款帐号的ID，主要操作金币,操作为-），做任务（传入）
     */
    private function Shopsheet()
    {
        $label = $this->in_arr['label'];
        $userid = $this->in_arr['userid'];
        $jtype = $this->in_arr['jtype'];
        $amounttype = $this->in_arr['amounttype'];
        $shopingtype = $this->in_arr['shopingtype'];
        $amount = $this->in_arr['amount'];
        $taskid = isset($this->in_arr['taskid']) ? $this->in_arr['taskid'] : 0;
        $strats = isset($this->in_arr['strats']) ? $this->in_arr['strats'] : 2;
        $useraccountid = isset($this->in_arr['useraccountid']) ? $this->in_arr['useraccountid'] : 0;
        //$shopid = isset($this->in_arr['shopid'])?$this->in_arr['shopid']:0;
        $shopid = isset($this->in_arr['shopid']) ? $this->in_arr['shopid'] : 0;
        if ($label == "task") {

        } elseif ($label == "recharge") {

        } elseif ($label == "withdraw") {
            if ($useraccountid != 0) {
                $password = $this->in_arr['password'];
                $re = A('Jhttp')->verifywithdrawal($jtype, $userid, $password);
                $arr = json_decode($re, true);
                //pt($arr);
                $errorCode = $arr['resCode'];
                if ($errorCode == '000000') {
                    $bank = M("useraccount")->field("f_accounttype")->where("f_indexID=" . $useraccountid)->find();
                    if ($bank) {
                        $accounttype = $bank["f_accounttype"];
                    }
                    if ($accounttype == 1 || $accounttype == '1') {
                        $this->out_arr['error_code'] = 'bank_error';
                        $this->out_arr['error_text'] = "暂时不提供银行卡提现，请使用支付宝";
                    } else {
                        $re_user = M("userbalance")->field("f_goldcoin")->where("f_userid=" . $userid)->find();
                        if ($re_user["f_goldcoin"] < $amount * 10) {
                            $this->out_arr['error_code'] = 'withdraw_error';
                            $this->out_arr['error_text'] = "提现超额";
                        } else {
                            $re = D('Shopsheet')->add_shopsheet($label, $userid, $amounttype, $shopingtype, $amount * 10, $taskid, $strats, $useraccountid);
                            $this->out_arr['error_code'] = 'success';
                            $this->out_arr['error_text'] = '';
                            $this->out_arr['indexid'] = $re;
                        }
                    }
                } else {
                    $this->out_arr['error_code'] = 'verifywithdrawal_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
            } else {
                $this->out_arr['error_code'] = 'verifywithdrawal_accountid_empty';
                $this->out_arr['error_text'] = '提现帐号不能为空';
            }

        } elseif ($label == "lottery") {

        } elseif ($label == "Invite") {

        } elseif ($label == "exchange") {

        } elseif ($label == "certification") {

        } elseif ($label == "daily") {

        } elseif ($label == "events") {//活动

        } elseif ($label == "shop") {//订购
            $re = D('Shopsheet')->add_shopsheet($label, $userid, $amounttype, $shopingtype, $amount, $taskid, $strats, $useraccountid, 0, $shopid);
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['indexid'] = $re;
        }
    }
    //========================END========================================================================

    /**
     * ===========================================消费记录：包括提款，充值，做任务===========================================
     * 消费标签：task(任务),recharge(充值),withdraw(提现),lottery(抽奖),Invite(邀请),exchange(兑换),certification(认证),daily(日常)
     * 提款（传收款帐号的ID，主要操作金币,操作为-），做任务（传入）
     */
    private function shopList()
    {
        $shopingtype = $this->in_arr['shopingtype'];
        $userid = $this->in_arr['userid'];
        $this->out_arr['todaysum'] = D('Shopsheet')->todaysheet($shopingtype, $userid);
        $this->out_arr['totelsum'] = D('Shopsheet')->sumsheet($shopingtype, $userid);
        //echo strtotime("-1 day");
        $re = D('Shopsheet')->shoplist($shopingtype, $userid);
        //echo count($re);
        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无数据';
            $this->out_arr['list'] = "";
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        }
    }
    //========================END========================================================================

    /**
     * ===========================================修改用户信息===========================================
     * USERID必填
     */
    private function modiUserInfo()
    {
        $this->out_arr['userid'] = $this->in_arr['userid'];
        $fieldkey = $this->in_arr['fieldkey'];
        $key = explode('|', $fieldkey);
        $fieldval = $this->in_arr['fieldval'];
        $val = explode('|', $fieldval);
        $url = "";
        for ($i = 0; $i < count($key); $i++) {
            $url .= "&" . $key[$i] . "=" . $val[$i];

            if ($key[$i] == 'nickName') {
                $q = A('Jhttp')->getUserinfo2($this->in_arr['userid']);
                $arrUer = json_decode($q, true);
                $body = array('nickname' => $val[$i]);
                A('Api/Easemob')->easemob_modi_nickname($body, $arrUer['list']['mobile']);
            }

        }
//         echo $url;
//         exit;
        $re = A('Jhttp')->modiUserInfo($this->out_arr['userid'], $url);
        //echo $re;
        //exit;
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
//        	echo $re;exit;
            $this->out_arr['error_code'] = 'modiUserInfo_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //========================END========================================================================


    /**
     * ===========================================删除用户信息===========================================
     * USERID必填
     */
    private function delUserInfo()
    {
        $userId = $this->in_arr['userId'];
        $companyId = $this->in_arr['companyId'];
        $re = A('Jhttp')->delUserInfo($userId, $companyId);
//     	var_dump($companyId);
//     	var_dump($userId);exit;
        //echo $re;
        //exit;
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'modiUserInfo_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //========================END========================================================================

    /**
     * ===========================================批量删除用户信息===========================================
     * USERID集合必填
     */
    private function usersDelete()
    {
        $usersId = $this->in_arr['usersId'];
        $re = A('Jhttp')->usersDelete($usersId);

//     	var_dump($usersId);exit;
        //echo $re;
        //exit;
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = '000000';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        } else {
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //========================END========================================================================


    /**
     * ===========================================修改企业信息===========================================
     * companyid必填
     */
    private function modiCompanyInfo()
    {
        $taskid = $this->in_arr['taskid'];
        $submit = $this->in_arr['submit'];
        $map['f_status'] = 2;
        if ("submit"==$submit) {
            M('task')->where("f_tid=".$taskid)->save($map);
        }
        $this->out_arr['companyid'] = $this->in_arr['companyid'];
        $this->out_arr['companyid'] = $this->in_arr['companyid'];
        $fieldkey = $this->in_arr['fieldkey'];
        $key = explode('|', $fieldkey);
        $fieldval = $this->in_arr['fieldval'];
        $val = explode('|', $fieldval);
        $url = "";
        for ($i = 0; $i < count($key); $i++) {
            $url .= "&" . $key[$i] . "=" . $val[$i];
        }
        $re = A('Jhttp')->companyUpdate($this->out_arr['companyid'], $url);

        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'modiCompanyInfo_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }
    //========================END========================================================================

    /**
     * ===========================================认领任务（随手，招商）===========================================
     * USERID,TASKID
     */
    private function claimTask()
    {
        $t = M('taskdraw');
        $map['f_taskid'] = $this->in_arr['taskid'];
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_drawdate'] = time();
        $map['f_utask_status'] = 2;

        $w['f_tid'] = $this->in_arr['taskid'];
        $re_1 = M('task')->field('f_tasktypeid')->where($w)->find();

        // if($re_1['f_tasktypeid']==3){
        //     $re_2 = M('task')->where($w)->find();
        //     $now=time();
        //     $enddate = strtotime($re_2['f_enddate']);
        //     if($now>$enddate){
        //         $map_3['f_status']  = 1;
        //         M('task')->where($w)->save($map_3);
        //     }
        // }

        if ($re_1['f_tasktypeid'] == 2 || $re_1['f_tasktypeid'] == 4 || $re_1['f_tasktypeid'] == 5 || $re_1['f_tasktypeid'] == 6) {
            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid');
            $re_3 = M('task')->where($w)->join($j)->find();
            if ((int)$re_3['f_drawcopies'] >= (int)($re_3['f_totalcopies'])) {
                $map_2['f_status'] = 1;
                M('task')->where($w)->save($map_2);
            }
        }

        $re_4 = M('task')->where($w)->find();

        if ($re_4['f_status'] == 1 || $re_4['f_status'] == '1') {
            $this->out_arr['error_code'] = 'over_error';
            $this->out_arr['error_text'] = '认领已结束';
        } else {
            $sum = M('taskdraw')->where("f_taskid=" . $this->in_arr['taskid'] . " and f_userid=" . $this->in_arr['userid'])->count();
            if ($sum > 0) {
                //表示已经认领了
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
            } else {
                $re = $t->add($map);
                if ($re > 0) {
                    M('tasksmallinfo')->where('f_taskid=' . $this->in_arr['taskid'])->setInc('f_drawcopies');
                    //M('tasksmallinfo')->get
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'claim_error';
                    $this->out_arr['error_text'] = '认领失败';
                }
            }
        }
    }

    /**
     * ===========================================上报经销商===========================================
     * USERID必填
     */
    private function upAgency()
    {

        $modi['f_dealerid'] = isset($this->in_arr['dealerid']) ? $this->in_arr['dealerid'] : 0;
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_taskid'] = $this->in_arr['taskid'];
        $map['f_fileid'] = $this->in_arr['fileid'];
        $map['f_companynameone'] = $this->in_arr['companynameone'];
//        $map['f_companynametwo'] = $this->in_arr['companynametwo'];
//        $map['f_companynamethree'] = $this->in_arr['companynamethree'];
        $map['f_contactsname'] = $this->in_arr['contactsname'];
        $map['f_titleone'] = $this->in_arr['titleone'];
//        $map['f_titletwo'] = $this->in_arr['titletwo'];
//        $map['f_titlethree'] = $this->in_arr['titlethree'];
        $map['f_phoneone'] = $this->in_arr['phoneone'];
//        $map['f_phonetwo'] = $this->in_arr['phonetwo'];
//        $map['f_phonethree'] = $this->in_arr['phonethree'];
        $map['f_faxone'] = $this->in_arr['faxone'];
//        $map['f_faxtwo'] = $this->in_arr['faxtwo'];
//        $map['f_faxthree'] = $this->in_arr['faxthree'];
        $map['f_emailone'] = $this->in_arr['emailone'];
//        $map['f_emailtwo'] = $this->in_arr['emailtwo'];
//        $map['f_emailthree'] = $this->in_arr['emailthree'];
        $map['f_website1'] = $this->in_arr['website1'];
//        $map['f_website2'] = $this->in_arr['website2'];
//        $map['f_website3'] = $this->in_arr['website3'];
        $map['f_address1'] = $this->in_arr['address1'];
//        $map['f_address2'] = $this->in_arr['address2'];
//        $map['f_address3'] = $this->in_arr['address3'];
        $map['f_uptime'] = time();

        if ($modi['f_dealerid'] == 0) {
            $re = M('dealerbaseinfo')->add($map);
            $map_1['f_dealerid'] = $re;
        } else {
            $re = M('dealerbaseinfo')->where($modi)->save($map);
            $map_1['f_dealerid'] = $modi['f_dealerid'];
        }


        $map_1['f_area'] = $this->in_arr['area'];
        $map_1['f_mainindustry'] = $this->in_arr['mainindustry'];
        $map_1['f_famousbrandqty'] = $this->in_arr['famousbrandqty'];
        $map_1['f_famousbrandname'] = $this->in_arr['famousbrandname'];
        $map_1['f_yearturnover'] = $this->in_arr['yearturnover'];
        $map_1['f_salesqty'] = $this->in_arr['salesqty'];
        $map_1['f_latticepointqty'] = $this->in_arr['latticepointqty'];
        $map_1['f_carsqty'] = $this->in_arr['carsqty'];
        $map_1['f_floatingcapital'] = $this->in_arr['floatingcapital'];
        $map_1['f_advantage'] = $this->in_arr['advantage'];
        $map_1['f_channeltype'] = $this->in_arr['channeltype'];


        if ($modi['f_dealerid'] == 0) {
            M('dealerqualifyinfo')->add($map_1);
        } else {
            M('dealerqualifyinfo')->where($modi)->save($map_1);
        }

        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        $this->out_arr['dealerid'] = $re;

    }

    /**
     * ===========================================获取经销商列表===========================================
     *
     */
    private function getAgencyList()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_taskid'] = $this->in_arr['taskid'];
        $f = "f_dealerid,f_companynameone,f_contactsname,f_dealer_strats";
        $re = M('dealerbaseinfo')->field($f)->where($map)->select();
        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无经销商数据';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        }
    }

    /**
     * ===========================================获取经销商详情===========================================
     *
     */
    private function getAgency()
    {
        $map['t_dealerbaseinfo.f_dealerid'] = $this->in_arr['dealerid'];
        //$map['f_taskid'] = $this->in_arr['taskid'];
        $f = "*";
        $j = array("LEFT JOIN t_dealerqualifyinfo ON t_dealerqualifyinfo.f_dealerid = t_dealerbaseinfo.f_dealerid", "LEFT JOIN t_files ON t_files.f_id=t_dealerbaseinfo.f_fileid");
        $re = M('dealerbaseinfo')->field($f)->JOIN($j)->where($map)->select();
        //pt($re);
        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无经销商数据';
        } else {
            foreach ($re as $key => $v) {
                if ($v['f_dealer_strats'] == 1) {
                    $re[$key]['url'] = C('WebUrl') . U('mobileweb/authority/index') . "?dealerid=" . $v['f_dealerid'];
                } else {
                    $re[$key]['url'] = "";
                }
            }
            //pt($re);
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;

        }
    }

    /**
     * ===========================================删除经销商===========================================
     *
     */
    private function delAgency()
    {
        //$map['f_dealerid'] = $this->in_arr['dealerid'];
        $dealerid = strtr($this->in_arr['dealerid'], '|', ',');


        M('dealerqualifyinfo')->delete($dealerid);

        M('dealerbaseinfo')->delete($dealerid);

        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
    }


    /**
     * ===========================================创建任务===========================================
     *
     */
    private function cTask()
    {
        $creatuserid = $this->in_arr['creatuserid'];
        $paletid = session('id');
        $tasktypeid = $this->in_arr['tasktypeid'];
        $fileid = $this->in_arr['fileid'];
        $fileid_ban = $this->in_arr['fileid_ban'];
        $companyId = $this->in_arr['companyId'];
        $title = $this->in_arr['title'];
        $startdate = $this->in_arr['startdate'];
        $enddate = $this->in_arr['enddate'];
        $linkman = $this->in_arr['linkman'];
        $linkphone = $this->in_arr['linkphone'];
        $taskid = $this->in_arr['taskid'] == '' ? 0 : $this->in_arr['taskid'];
        //pt($taskid);
        $harder = isset($this->in_arr['harder']) ? $this->in_arr['harder'] : 0;
        $description = $this->in_arr['taskDescription'];
        $status = isset($this->in_arr['status']) ? $this->in_arr['status'] : 6;
        $indexid=$this->in_arr["indexid"];
        // var_dump($taskid);
//      echo   $creatuserid+"=="+$tasktypeid+"=="+$fileid+"=="+$companyId+"=="+$title+"=="+$fileid+"=="+$startdate+"=="+$enddate+"=="+$linkman+"=="+$linkphone+"=="+$taskid+"=="+$harder+"=="+$description;
        //操作
        $re = D('Task')->add_one($paletid, $status, $tasktypeid, $creatuserid, $fileid, $fileid_ban, $companyId, $title, $startdate, $enddate, $linkman, $linkphone, $taskid, $harder, $description);
//         echo $re; return;
        // echo $taskid;
        if($taskid>0){
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
            if($indexid){
                $this->iTask();
            }

        }else{
            if ($re != 0) {  //创建或编辑编辑返回,编辑和新增的区别在model task里区分
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['taskid'] = $re;
                cookie('now_taskid', $re);
                if($indexid){
                    $this->iTask();
                }

            } else {
                $this->out_arr['error_code'] = 'add_error';
                $this->out_arr['error_text'] = '创建任务失败';
            }
        }


    }

    private function bTask()
    {
        $creatuserid = $this->in_arr['creatuserid'];
        $paletid = session('id');
        $tasktypeid = $this->in_arr['tasktypeid'];
        $companyId = $this->in_arr['companyId'];
        $title = $this->in_arr['title'];
        $startdate = $this->in_arr['startdate'];
        $enddate = $this->in_arr['enddate'];
        $linkman = $this->in_arr['linkman'];
        $linkphone = $this->in_arr['linkphone'];
        $taskid = $this->in_arr['taskid'] == '' ? 0 : $this->in_arr['taskid'];
        $harder = isset($this->in_arr['harder']) ? $this->in_arr['harder'] : 0;
        $description = $this->in_arr['taskDescription'];
        $status = isset($this->in_arr['status']) ? $this->in_arr['status'] : 6;

        $tradeid =$this->in_arr['tradeid'];
        //操作
        $re = D('Task')->add_bone($paletid, $status, $tasktypeid, $creatuserid, $companyId, $title, $startdate, $enddate, $linkman, $linkphone, $taskid, $harder, $description);

        if ($re != 0&&$taskid == 0) {  //创建或编辑编辑返回,编辑和新增的区别在model task里区分
            $where['f_taskid']=$re;
            $where['f_tradeid']=$tradeid;
            $re_1=M('taskmtbaseinfo')->add($where);
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $re;
            $this->out_arr['indexid'] = $re_1;
        } elseif ($taskid > 0) {  //内容未修改时避免出错判断
            $sare['f_tradeid']=$tradeid;
            M('taskmtbaseinfo')->where("f_taskid=".$taskid)->save($sare);
            $re_2=M('taskmtbaseinfo')->where("f_taskid=".$taskid)->find();
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['indexid'] = $re_2['f_indexid'];
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '创建任务失败';
        }
    }

    private function cCheck()
    {
        $creatuserid = $this->in_arr['creatuserid'];
        $paletid = session('id');
        $tasktypeid = $this->in_arr['tasktypeid'];
        $fileid = $this->in_arr['fileid'];
        $fileid_ban = $this->in_arr['fileid_ban'];
        $companyId = isset($this->in_arr['companyId'])?$this->in_arr['companyId']:"";
        $title = $this->in_arr['title'];
        $startdate = $this->in_arr['startdate'];
        $enddate = $this->in_arr['enddate'];
        $linkman = $this->in_arr['linkman'];
        $linkphone = $this->in_arr['linkphone'];
        $taskid = $this->in_arr['taskid'] == '' ? 0 : $this->in_arr['taskid'];
        // var_dump($taskid);exit();
        $harder = isset($this->in_arr['harder']) ? $this->in_arr['harder'] : 0;
        $description = $this->in_arr['taskDescription'];
        $status = isset($this->in_arr['status']) ? $this->in_arr['status'] : 6;
        $indexid=$this->in_arr["indexid"];

        //操作
        $re = D('Task')->add_one($paletid, $status, $tasktypeid, $creatuserid, $fileid, $fileid_ban, $companyId, $title, $startdate, $enddate, $linkman, $linkphone, $taskid, $harder, $description);

        if ($re != 0&&$taskid == 0) {  //创建或编辑编辑返回,编辑和新增的区别在model task里区分
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $re;
        } elseif ($taskid > 0) {  //内容未修改时避免出错判断
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '创建任务失败';
        }
    }

    /**
     * ===========================================添加任务基本信息===========================================
     *
     */
    private function iTask()
    {
        $taskid = $this->in_arr['taskid'];
//        $indexid = $this->in_arr['indexid'] == '0'?cookie('business_indexid'):$this->in_arr['indexid'];
        $indexid = $this->in_arr['indexid'];
        $mtbrand = $this->in_arr['mtbrand'];
        $mtgoods = $this->in_arr['mtgoods'];
        $tradeid = $this->in_arr['tradeid'];
        $payment = $this->in_arr['payment'];
        $bond = $this->in_arr['bond'];
        $franchise = $this->in_arr['franchise'];
        $otherprice = $this->in_arr['otherprice'];
        $pricesum = $this->in_arr['pricesum'];
        $commission = $this->in_arr['commission'];
        $agents_commission = $this->in_arr['agents_commission'];
        $shuiw_commission=$this->in_arr['shuiw_commission'];
        $shangw_commission=$this->in_arr['shangw_commission'];
        $tuig_commission=$this->in_arr['tuig_commission'];
        $piny_commission=$this->in_arr['piny_commission'];
        $whprovidetrial=$this->in_arr['whprovidetrial'];
        $trialnum=$this->in_arr['trialnum'];
        $whpaid=$this->in_arr['whpaid'];
        $trialprice=$this->in_arr['trialprice'];
        //添加操作
        $re = D('Task')->add_two($taskid, $mtbrand, $mtgoods, $tradeid, $payment, $bond, $franchise, $otherprice, $pricesum, $commission, $agents_commission,$indexid,$shuiw_commission,$shangw_commission,$tuig_commission,$piny_commission,$whprovidetrial,$trialnum,$whpaid,$trialprice);
        if($indexid>0){
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['two_index']=$indexid;
//            cookie("two_index",$indexid);
              cookie('now_taskid', $taskid);
        }else{
            if ($re != 0) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['taskid'] = $taskid;
                $this->out_arr['two_index']=$re;
                cookie('now_taskid', $taskid);
//                cookie("two_index",$re);
            }else{
                $this->out_arr['error_code'] = 'add_error';
                $this->out_arr['error_text'] = '添加任务基本信息失败';
                $this->out_arr['taskid'] = $taskid;
            }
        }

    }

    private function iTask1()
    {
        $taskid = $this->in_arr['taskid'];
        // $indexid = $this->in_arr['indexid'] == '0' ? cookie('business_indexid') : $this->in_arr['indexid'];
        $indexid = $this->in_arr['indexid'];
        $mtbrand = $this->in_arr['mtbrand'];
        $mtgoods = $this->in_arr['mtgoods'];
        $tradeid = $this->in_arr['tradeid'];
        $payment = $this->in_arr['payment'];
        $bond = $this->in_arr['bond'];
        $franchise = $this->in_arr['franchise'];
        $otherprice = $this->in_arr['otherprice'];
        $pricesum = $this->in_arr['pricesum'];
        $commission = $this->in_arr['commission'];
        $agents_commission = $this->in_arr['agents_commission'];

        //添加操作
        $re = D('Task')->add_two($taskid, $mtbrand, $mtgoods, $tradeid, $payment, $bond, $franchise, $otherprice, $pricesum, $commission, $agents_commission, $indexid);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } elseif ($indexid > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加任务基本信息失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }

    private function bTask1()
    {
        $taskid = $this->in_arr['taskid'];
        $indexid = $this->in_arr['indexid'];
        $payment = $this->in_arr['payment'];
        $bond = $this->in_arr['bond'];
        $franchise = $this->in_arr['franchise'];
        $otherprice = $this->in_arr['otherprice'];
        $pricesum = $this->in_arr['pricesum'];
        $agents_commission = $this->in_arr['agents_commission'];
        $shuiw_commission = $this->in_arr['shuiw_commission'];
        $shangw_commission = $this->in_arr['shangw_commission'];
        $tuig_commission = $this->in_arr['tuig_commission'];
        $piny_commission = $this->in_arr['piny_commission'];
        $commission = $this->in_arr['commission'];
        $totalcommission = $this->in_arr['totalcommission'];

        $tryout = $this->in_arr['tryout'];
        $tryoutNumber = $this->in_arr['tryoutNumber'];
        $testPayment = $this->in_arr['testPayment'];
        $paymentMoney = $this->in_arr['paymentMoney'];
        //添加操作
        $re = D('Task')->add_btwo($taskid,$indexid, $payment, $bond, $franchise, $otherprice, $pricesum, $agents_commission, $shuiw_commission, $shangw_commission, $tuig_commission, $piny_commission, $commission, $totalcommission ,$tryout ,$tryoutNumber ,$testPayment ,$paymentMoney);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['indexid'] = $re;
        }elseif ($indexid > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['indexid'] = $indexid;
        }else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加任务基本信息失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }

    /**
     * ===========================================添加任务详情===========================================
     *
     */
    private function xTask()
    {

        $taskid = $this->in_arr['taskid'];
        $brandlocation = $this->in_arr['brandlocation'];
        $slogan = $this->in_arr['slogan'];
        $sellingpoint = $this->in_arr['sellingpoint'];
        $targetgroup = $this->in_arr['targetgroup'];
        $distributorsrequir = $this->in_arr['distributorsrequir'];
        $retailoutlets = $this->in_arr['retailoutlets'];
        $channelpolicy = $this->in_arr['channelpolicy'];
        $note = $this->in_arr['note'];
        $product = $this->in_arr['product'];
        $company_note = $this->in_arr['company_note'];
//        $tindexid =  $this->in_arr['tindexid'] == '0'?cookie('business_four_indexid'):$this->in_arr['tindexid'];
        $tindexid = $this->in_arr['tindexid'];

        if (empty($tindexid)) {
            $tindexid = '0';
        }

        //添加操作
        $re = D('Task')->add_four($taskid, $brandlocation, $slogan, $sellingpoint, $targetgroup, $distributorsrequir, $retailoutlets, $channelpolicy, $note, $product, $tindexid,$company_note);
        if($tindexid > 0){
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr["tindexid"]=$tindexid;
            cookie('now_taskid', $taskid);
        }else{
            if ($re != 0) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['taskid'] = $taskid;
                $this->out_arr["tindexid"]=$re;
                cookie('now_taskid', $taskid);
            } else{
                $this->out_arr['error_code'] = 'add_error';
                $this->out_arr['error_text'] = '添加任务详情失败';
                $this->out_arr['taskid'] = $taskid;
            }
        }

    }

    private function xTask1()
    {

        $taskid = $this->in_arr['taskid'];
        $brandlocation = $this->in_arr['brandlocation'];
        $slogan = $this->in_arr['slogan'];
        $sellingpoint = $this->in_arr['sellingpoint'];
        $targetgroup = $this->in_arr['targetgroup'];
        $distributorsrequir = $this->in_arr['distributorsrequir'];
        $retailoutlets = $this->in_arr['retailoutlets'];
        $channelpolicy = $this->in_arr['channelpolicy'];
        $note = $this->in_arr['note'];
        $product = $this->in_arr['product'];
        // $tindexid = $this->in_arr['tindexid'] == '0' ? cookie('business_four_indexid') : $this->in_arr['tindexid'];
        $tindexid = $this->in_arr['tindexid'];

        if (empty($tindexid)) {
            $tindexid = '0';
        }

        //添加操作
        $re = D('Task')->add_four($taskid, $brandlocation, $slogan, $sellingpoint, $targetgroup, $distributorsrequir, $retailoutlets, $channelpolicy, $note, $product, $tindexid);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } elseif ($tindexid > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加任务详情失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }

    private function bTask2()
    {

        $taskid = $this->in_arr['taskid'];
        $brandlocation = $this->in_arr['brandlocation'];
        $slogan = $this->in_arr['slogan'];
        $sellingpoint = $this->in_arr['sellingpoint'];
        $targetgroup = $this->in_arr['targetgroup'];
        $distributorsrequir = $this->in_arr['distributorsrequir'];
        $retailoutlets = $this->in_arr['retailoutlets'];
        $channelpolicy = $this->in_arr['channelpolicy'];
        $note = $this->in_arr['note'];
        $product = $this->in_arr['product'];
        $company_note = $this->in_arr['company_note'];
        $tindexid = $this->in_arr['tindexid']?$this->in_arr['tindexid']:0;

        //添加操作
        $re = D('Task')->add_bthree($taskid, $brandlocation, $slogan, $sellingpoint, $targetgroup, $distributorsrequir, $retailoutlets, $channelpolicy, $note, $product, $tindexid ,$company_note);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['tindexid'] = $re;
        } elseif ($tindexid > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['tindexid'] = $tindexid;
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加任务详情失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }


    /**
     * ===========================================添加区域及数量===========================================
     */
    private function addArea()
    {
        $area = $this->in_arr['area'];
        $qty = $this->in_arr['qty'];
        $taskid = $this->in_arr['taskid'];
        //添加操作
        $re = D('Task')->addArea($area, $qty, $taskid);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加区域及数量失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }

    /**
     * ===========================================获取区域及数量===========================================
     */
    private function getArea()
    {
        $taskid = $this->in_arr['taskid'];
        $re = D('Task')->getArea($taskid);
        if (count($re) > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
            $this->out_arr['count'] = M('taskmtareaqty')->where('f_taskid='.$taskid)->sum('f_qty');
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无数据';
            $this->out_arr['list'] = "";
        }
    }

    /**
     * ===========================================删除区域及数量===========================================
     */

    private function  deteArea()
    {


        $areaId = $this->in_arr['areaId'];
        $re = D('Task')->deteArea($areaId);
        if ($re) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            //$this->out_arr['list']=$re;
        } else {
            $this->out_arr['error_code'] = 'delete_error';
            $this->out_arr['error_text'] = '数据删除失败';
            // $this->out_arr['list']="";
        }
    }

    /**
     * ===========================================添加招商产品明细===========================================
     */
    private function  addPro()
    {
        $goodsname = $this->in_arr['goodsname'];
        $modle = $this->in_arr['modle'];
        $unit = $this->in_arr['unit'];
        $agencyprice = $this->in_arr['agencyprice'];
        $sellingprice = $this->in_arr['sellingprice'];
        $saleprice = $this->in_arr['saleprice'];
        $taskid = $this->in_arr['taskid'];
        //添加操作
        $re = D('Task')->addPro($goodsname, $modle, $unit, $agencyprice, $sellingprice, $saleprice, $taskid);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            cookie('now_taskid', $taskid);
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加招商产品明细失败';
            $this->out_arr['taskid'] = $taskid;
        }
    }

    /**
     * ===========================================获取招商产品明细===========================================
     */
    private function getPro()
    {
        $taskid = $this->in_arr['taskid'];
        $re = D('Task')->getPro($taskid);
        if (count($re) > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无数据';
            $this->out_arr['list'] = "";
        }
    }

    /**
     * ===========================================删除招商产品明细===========================================
     */
    private function  detePro()
    {
        $proId = $this->in_arr['proId'];
        $re = D('Task')->detePro($proId);
        if ($re) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            //$this->out_arr['list']=$re;
        } else {
            $this->out_arr['error_code'] = 'delete_error';
            $this->out_arr['error_text'] = '数据删除失败';
            // $this->out_arr['list']="";
        }
    }

    /**
     * ===========================================添加附件===========================================
     */
    private function addFiles()
    {

        $taskid = $this->in_arr['taskid'];
        $file1 = $this->in_arr['file1'];
        $file2 = $this->in_arr['file2'];
        $file3 = $this->in_arr['file3'];
        $file4 = $this->in_arr['file4'];
        $file5 = $this->in_arr['file5'];
        $file6 = $this->in_arr['file6'];
        $file7 = $this->in_arr['file7'];
        $file8 = $this->in_arr['file8'];
        $findexid = $this->in_arr['findexid'];
        $re = D('task')->addFiles($taskid, $file1, $file2, $file3, $file4, $file5, $file6,$file7,$file8,$findexid);

        if($findexid > 0){
            //编辑
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['findexid_six']=$findexid;
            if($taskid){
                $this->cTask();
            }

            cookie('now_taskid', $taskid);
            cookie('findexid_six',$findexid);
        }else{
            //添加
            if ($re != 0) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['taskid'] = $taskid;
                $this->out_arr['findexid_six']=$re;
                if($taskid){
                    $this->cTask();
                }
                cookie('now_taskid', $taskid);
                cookie('findexid_six',$re);
            }else {
                $this->out_arr['error_code'] = 'add_error';
                $this->out_arr['error_text'] = '添加附件失败';
                $this->out_arr['taskid'] = $taskid;
            }
        }


    }

     private function bTask3()
    {

        $taskid = $this->in_arr['taskid'];
        $file1 = $this->in_arr['file1'];
        $file2 = $this->in_arr['file2'];
        $file3 = $this->in_arr['file3'];
        $file4 = $this->in_arr['file4'];
        $file5 = $this->in_arr['file5'];
        $file6 = $this->in_arr['file6'];
        $file7 = $this->in_arr['file7'];
        $file8 = $this->in_arr['file8'];
        $findexid = $this->in_arr['findexid'];
        $f_fileid = $this->in_arr['fileid'];
        $f_fileid_ban = $this->in_arr['fileid_ban'];
        $re = D('task')->addbfour($taskid, $file1, $file2, $file3, $file4, $file5, $file6,$file7,$file8,$findexid);

        $where['f_fileid']=$f_fileid;
        $where['f_fileid_ban']=$f_fileid_ban;
        M('task')->where("f_tid=".$taskid)->save($where);
        if($findexid > 0){
            //编辑
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $taskid;
            $this->out_arr['findexid']=$findexid;
        }else{
            //添加
            if ($re != 0) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['taskid'] = $taskid;
                $this->out_arr['findexid']=$re;
            }else {
                $this->out_arr['error_code'] = 'add_error';
                $this->out_arr['error_text'] = '添加附件失败';
                $this->out_arr['taskid'] = $taskid;
            }
        }


    }

    /**
     * ===========================================提现密码(设置，修改，验证)===========================================
     */
    private function  withdrawal()
    {
        $jtype = $this->in_arr['jtype'];
        $type = $this->in_arr['type'];
        $userid = $this->in_arr['userid'];
        $password = $this->in_arr['password'];
        //pt($this->in_arr);

        if ($type == 'add') {
            $re = A('Jhttp')->withdrawal($jtype, $userid, $password);
            $arr = json_decode($re, true);
            $errorCode = $arr['resCode'];
            if ($errorCode == '000000') {
                if ($jtype == 1 || $jtype == '1') {
                    $q = A('Jhttp')->getUserinfo2($this->in_arr['userid']);
                    $arrUer = json_decode($q, true);
                    $body = array('newpassword' => $password);
                    $easemobRew = A('Api/Easemob')->easemob_modi_password($body, $arrUer['list']['mobile']);
                    //pt($easemobRew);
                }
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
            } else {
                $this->out_arr['error_code'] = 'withdrawal_sys_error';
                $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
            }


        } elseif ($type == 'modi') {
            $oldpassword = $this->in_arr['oldpassword'];
            //echo $oldpassword;
            $re = A('Jhttp')->verifywithdrawal($jtype, $userid, $oldpassword);
            $arr = json_decode($re, true);
            //pt($arr);
            $errorCode = $arr['resCode'];
            if ($errorCode == '000000') {

                $re_v = A('Jhttp')->withdrawal($jtype, $userid, $password);
                $arr_v = json_decode($re_v, true);
                $errorCode_v = $arr_v['resCode'];
                if ($errorCode_v == '000000') {

                    if ($jtype == 2 || $jtype == '2') {
                        $q = A('Jhttp')->getUserinfo2($this->in_arr['userid']);
                        $arrUer = json_decode($q, true);
                        $body = array('newpassword' => $password);
                        $easemobRew = A('Api/Easemob')->easemob_modi_password($body, $arrUer['list']['mobile']);
                        //pt($easemobRew);
                    }

                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'withdrawal_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode_v);
                }

            } else {
                $this->out_arr['error_code'] = 'verifywithdrawal_sys_error';
                $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
            }


        } elseif ($type == 'verify') {
            $re = A('Jhttp')->verifywithdrawal($jtype, $userid, $password);
            $arr = json_decode($re, true);
            $errorCode = $arr['resCode'];
            if ($errorCode == '000000') {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
            } else {
                $this->out_arr['error_code'] = 'verifywithdrawal_sys_error';
                $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
            }
        }
    }

    /**
     * ===========================================批量付款===========================================
     */
    function payment_alipay()
    {
        //接收数据，并组装
        $indexIDs = $this->in_arr["indexIDs"];
        $id = explode(",", $indexIDs);
        $map["t_shopsheet.f_indexid"] = array('in', $indexIDs);
        $WIDbatch_fee = M("shopsheet")->where($map)->sum("f_amount");
        $WIDbatch_num = count($id);
        $f = "t_shopsheet.f_indexid,t_shopsheet.f_userid,f_taskid,f_amount,f_useraccountid,f_optiondate,f_strats,f_label,f_accounttype,f_accountname,f_bankaccount,f_runningnum";
        $j = array("LEFT JOIN t_useraccount ON t_useraccount.f_indexID = t_shopsheet.f_useraccountid");
        $re = M("shopsheet")->field($f)->where($map)->join($j)->select();
        $WIDdetail_data = "";
        foreach ($re as $key => $val) {
            $amount = $val["f_amount"] / 10;
            if ($WIDdetail_data == "") {
                $WIDdetail_data = $val["f_runningnum"] . "^" . $val["f_bankaccount"] . "^" . $val["f_accountname"] . "^" . $amount . "^" . $val["f_optiondate"];
            } else {
                $WIDdetail_data .= "|" . $val["f_runningnum"] . "^" . $val["f_bankaccount"] . "^" . $val["f_accountname"] . "^" . $amount . "^" . $val["f_optiondate"];
            }
        }
        //pt($WIDdetail_data);
        //exit;
        $batch_no = date('Ymd') . rand(100000000, 999999999) . time();//27位批次号

        $notify_url = C("WebUrl") . U("Api/Alipaypayment/payment_notify");//回调
        A('Alipaypayment')->AlipaySubmit();
        //获取支付信息
        $alipay_config = C('alipay_config');
        //pt($alipay_config);
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "batch_trans_notify",
            "partner" => trim($alipay_config['partner']),
            "notify_url" => $notify_url,
            "email" => C('WIDemail'),
            "account_name" => C('WIDaccount_name'),
            "pay_date" => date('Ymd'),
            "batch_no" => $batch_no,
            "batch_fee" => $WIDbatch_fee / 10,
            "batch_num" => $WIDbatch_num,//即参数detail_data的值中，“|”字符出现的数量加1，最大支持1000笔（即“|”字符出现的数量999个）
            "detail_data" => $WIDdetail_data,//格式：流水号1^收款方帐号1^真实姓名^付款金额1^备注说明1|流水号2^收款方帐号2^真实姓名^付款金额2^备注说明2....
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //pt($parameter);
        $html_text = A('Alipaypayment')->buildRequestForm($parameter, "get", "确认");
        $this->out_arr["html_text"] = $html_text;
    }


    /**
     * ===========================================上传头像===========================================
     */
    private function upHeadimg()
    {
        $userid = $this->in_arr['userid'];
        $map = A('Upfile')->upF(3);


        //        $this->out_arr['error_code'] = 'success';
//        $this->out_arr['error_text'] = '';
//        $this->out_arr['headLogo'] = $map['upfile']['savepath'].$map['upfile']['savename'];
//        $this->out_arr['fileid'] = $map['fileid'];
        //$info['upfile']['savepath'].$info['upfile']['savename']
        $url = "&headLogo=" . $map['fileid'];
        $re = A('Jhttp')->modiUserInfo($userid, $url);

        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['headLogoUrl'] = $map['upfile']['savepath'] . $map['upfile']['savename'];
            $this->out_arr['fileid'] = $map['fileid'];
        } else {
            $this->out_arr['error_code'] = 'modiUserInfo_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }

    /**
     * ===========================================取认领任务的数量===========================================
     */
    private function getTaskSNo()
    {
        $userid = $this->in_arr['userid'];
        $re = D('task')->gettaskstratssum($userid);
        $re_1 = M('userbalance')->field('f_userid', 'f_recharge_gold', 'f_goldcoin', 'f_credit')->where('f_userid=' . $userid)->find();
        $re['recharge_gold'] = $re_1['f_recharge_gold'];
        $re['goldcoin'] = $re_1['f_goldcoin'];
        $re['credit'] = $re_1['f_credit'];
        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        $this->out_arr['list'] = $re;
    }

    /**
     * ===========================================上报随手任务===========================================
     */
    private function upWidelyTask()
    {
        $userid = $this->in_arr['userid'];
        $taskid = $this->in_arr['taskid'];
        $serial = $this->in_arr['serial'];
        $answer = $this->in_arr['answer'];
        $re = D('task')->upWidely($userid, $taskid, $serial, $answer);
        if ($re > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['id'] = $re;
        } else {
            $this->out_arr['error_code'] = 'upWidely_error';
            $this->out_arr['error_text'] = '上报数据出错';
        }
    }

    /**
     * ===========================================上报随手任务确定===========================================
     */
    private function upWidelyTaskSure()
    {
        $map['f_userid'] = I('userid');
        $map['f_taskid'] = I('taskid');
        $re = M('taskdraw')->where($map)->find();
        if ($re > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['f_utask_status'] = $re['f_utask_status'];
        } else {
            $this->out_arr['error_code'] = 'upWidelysure_error';
            $this->out_arr['error_text'] = '还未提交数据';
        }
    }

    /**
     * ===========================================WEB端企业注册===========================================
     */
    private function webregcompany()
    {
        $companyname = $this->in_arr['companyname'];
        $phone = $this->in_arr['phone'];
        $password = $this->in_arr['password'];
        $trueName = isset($this->in_arr['truename']) ? $this->in_arr['truename'] : "";
        $flattype = isset($this->in_arr['flattype']) ? $this->in_arr['flattype'] : 2;
//        $re = A('Jhttp')->companyAdd($phone, $password, $companyname, $trueName,$flattype);
        $re = A('Jhttp')->companyAdd($phone, $password, $companyname, $flattype,$trueName);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == '000000') {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            //为该企业注册的第一个用户分配最高级权限(即超级管理员))
            $re2 = A('Jhttp')->companylogin($phone, $password);
            $arr = json_decode($re2, true);
            if($arr["resCode"]=="000000"){
                foreach ($arr["list"] as $k => $v) {
                    if ($v["companyName"] == $companyname) {
                        $companyId = $v["companyId"];
                        break;
                    }
                }
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
                        if ($re5 != 0) {
                            $this->out_arr["code"] = "role_success";
                        } else {
                            $this->out_arr["code"] = "role_fail";
                        }
                    }
                }

            }

        }
    }

    /**
     * ===========================================招商签到===========================================
     * 签到动作：签到-》添加积分列表-》增加抽奖次数
     */
    private function checkins()
    {
        $userid = $this->in_arr['userid'];
        $m_1 = array('f_userid' => $userid, 'f_datetime' => time());
        $re_1 = M('checkins')->add($m_1);
        if ($re_1 != 0) {
            $label = 'checkins';
            $amounttype = 1;
            $shopingtype = 2;
            $amount = 3;
            $taskid = 0;
            $strats = 1;
            $useraccountid = 0;
            $re_2 = D('Shopsheet')->add_shopsheet($label, $userid, $amounttype, $shopingtype, $amount, $taskid, $strats, $useraccountid);

            $re_3 = A('Fun')->getcheckinssum($userid);//取连续签到的次数
            if ($re_3 == 6) {
                A('Fun')->lotterysum($userid);//增加抽奖次数
            }

            $m = M('lottery')->field('f_lottery_sum')->where('f_userid=' . $userid)->find();

            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['id'] = $re_2;

            $this->out_arr['amount'] = $amount;
            $this->out_arr['amounttype'] = $amounttype;
            $this->out_arr['shopingtype'] = $shopingtype;
            //$this->out_arr['lottery_sum'] = $m['f_lottery_sum'];
            $this->out_arr['lottery_sum'] = empty($m['f_lottery_sum']) ? 0 : $m['f_lottery_sum'];
            //$re_3 = M('lottery')->where('f_userid='.$userid)->setInc('f_lottery_sum');
        } else {
            $this->out_arr['error_code'] = 'checkins_error';
            $this->out_arr['error_text'] = '签到失败';
        }
    }

    /**
     * ===========================================取当月签到===========================================
     */
    private function checkins_list()
    {
        $userid = $this->in_arr['userid'];
        $s = strtotime(date('Y-m-01 00:00:00'));
        $e = time();
        $map['f_datetime'] = array(array('egt', $s), array('elt', $e));
        $map['f_userid'] = $userid;
        //pt($map);
        $re = M('checkins')->field('f_datetime')->where($map)->order('f_datetime')->select();
        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'checkins_list_error';
            $this->out_arr['error_text'] = '当月没有签到记录';
        } else {
            $re_1 = M('lottery')->field('f_lottery_sum')->where('f_userid=' . $userid)->find();
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['lottery_sum'] = empty($re_1['f_lottery_sum']) ? 0 : $re_1['f_lottery_sum'];
            $this->out_arr['list'] = $re;
        }
        //pt($this->out_arr['list']);
    }

    /**
     * ===========================================意见返馈===========================================
     */
    private function addOpinion()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_note'] = $this->in_arr['note'];
        $map['f_time'] = time();
        $re = M('opinion')->add($map);

        if ($re > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['oid'] = $re;
        } else {
            $this->out_arr['error_code'] = 'addOpinion_error';
            $this->out_arr['error_text'] = '意见返馈失败';
        }
    }


    /**
     * ===========================================分享===========================================
     */
    private function share()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $map['f_taskid'] = $this->in_arr['taskid'];
        $map['f_platform'] = $this->in_arr['platform'];
        $map['f_datetime'] = time();

        M('share')->add($map);
        $w['f_tid'] = $map['f_taskid'];

        $re_3 = M('task')->field('f_tasktypeid')->where($w)->find();
        if ($re_3['f_tasktypeid'] == 1) {
            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid');
            $re_2 = M('task')->where($w)->join($j)->find();
            if ((int)$re_2['f_drawcopies'] >= (int)($re_2['f_totalcopies'] - 1)) {
                $map_4['f_status'] = 1;
                M('task')->where($w)->save($map_4);
            }
        }


        $re = M('task')->field('f_tasktypeid,f_status')->where($w)->find();

        $s = A('Fun')->isShare($this->in_arr['userid'], $this->in_arr['taskid']);//取同一个任务分享的记录数

        if ($re) {
            if ($re['f_tasktypeid'] == 1) {

                $re_1 = M('tasksmallinfo')->field('f_eachcoin,f_eachscore')->where('f_taskid=' . $map['f_taskid'])->find();

                if ($re['f_status'] == 3 || $re['f_status'] == '3') {
                    if ($s == 1) {
                        D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 1, $re_1['f_eachcoin'] * 10, $map['f_taskid'], 2, 0);
                        D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 2, $re_1['f_eachscore'], $map['f_taskid'], 2, 0);
                        M('tasksmallinfo')->where("f_taskid=" . $map['f_taskid'])->setInc('f_drawcopies');
                    } else {
                        D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 1, 0, $map['f_taskid'], 2, 0);
                        D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 2, 3, $map['f_taskid'], 2, 0);
                    }

                } else {
                    D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 1, 0, $map['f_taskid'], 2, 0);
                    D('Shopsheet')->add_shopsheet('task', $map['f_userid'], 1, 2, 3, $map['f_taskid'], 2, 0);
                }
            }
        }
    }

//推广赚新增
    function cPush()
    {

        $this->cTask(); //新增内容到库中
        $map['f_taskid'] = $this->out_arr["taskid"];
        $map['f_totalcopies'] = $this->in_arr['pro_taskBrand'];
        $map['f_eachcoin'] = $this->in_arr['pro_taskProduct'];
        $map['f_eachscore'] = $this->in_arr['eachscore'] == "" ? 3 : $this->in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] = $this->in_arr['editor'];
        $map['f_total_commisson']=$this->in_arr['total_commisson'];
        // $map['f_ppconditions']=  $this->in_arr['mtbrand'];
//		echo  $this->in_arr['indexid']."===";

        //
        // $indexid = $this->in_arr['indexid'] ==0 ?cookie('now_indexid'):$this->in_arr['indexid'];
        $indexid = $this->in_arr['indexid'];

        if ($indexid != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
            $this->out_arr["now_indexid"]=$indexid;
            cookie('now_indexid', $indexid);
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
            $this->out_arr["now_indexid"]=$re;
            cookie('now_indexid', $re);
        }
        // if($re){
        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        // }else{
        //     $this->out_arr['error_code'] = 'small_info_fail';
        //     $this->out_arr['error_text'] = '';
        // }
    }

    function cPush1()
    {

        $this->cTask(); //新增内容到库中
        $map['f_taskid'] = $this->out_arr["taskid"];
        $map['f_totalcopies'] = $this->in_arr['pro_taskBrand'];
        $map['f_eachcoin'] = $this->in_arr['pro_taskProduct'];
        $map['f_eachscore'] = $this->in_arr['eachscore'] == "" ? 3 : $this->in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] = $this->in_arr['editor2'];
        $map['f_recommend'] = $this->in_arr['editor4'];
        $fuck = $this->in_arr['fuck'];
        // var_dump($map);exit();
        // $map['f_ppconditions']=  $this->in_arr['mtbrand'];
        // if (empty($this->in_arr['indexid']) || !isset($this->in_arr['indexid'])) {
        //     $this->in_arr['indexid'] = 0;
        // }
        $indexid = $this->in_arr['indexid'] == 0 ? cookie('fuck') : $this->in_arr['indexid'];
// var_dump($indexid);exit();
        if ($fuck != 0 || $this->in_arr['indexid'] != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
            cookie('fuck', $indexid);
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
            cookie('fuck', $re);
        }
        // if($re){
        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        // }else{
        //     $this->out_arr['error_code'] = 'small_info_fail';
        //     $this->out_arr['error_text'] = '';
        // }
    }

    //随手赚推荐模板提交
    function cpush2Recomd()
    {
        $indexid = $this->in_arr['smalltaskid'];
        $recommd['f_recommend'] = $this->in_arr['recommd'];
        $result = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($recommd);
        $this->out_arr["error_code"] = "success";
    }

    //随手赚
    function cPush2()
    {
        $tasktypeid = $this->in_arr['taskid'];
        // echo $tasktypeid+"=%%";
        $indexid = $this->in_arr['indexid'];
        $map['F_TASKID'] = $tasktypeid;
        $map['F_SERIAL'] = $this->in_arr['f_serial'];
        $map['F_PROBLEMTATILE'] = $this->in_arr['f_problemtatile'];
        $map['F_TYPE'] = $this->in_arr['f_type'];
        $map['F_OPTIONS'] = $this->in_arr['f_options'];
        $map['f_taskrequirements'] = $this->in_arr['editor2'];
        $map['f_recommend'] = $this->in_arr['editor3'];
        $map['F_ORDERNO'] = time() . $tasktypeid . rand(1000000, 9999999);
        $map['F_TRUEAnswer'] = $this->in_arr['f_trueanswer'];
//        $re = M("surveytaskdetail")->add($map);
        // echo  M("surveytaskdetail")->getLastSql();
        if ($indexid != 0) {
                 $re = M("surveytaskdetail")->where('F_STDINDEX=' . $indexid)->save($map);
                //操作记录入库
                $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
                $log['f_action'] = "随手赚编辑第二步";  //操作说明
                $log['f_taskid'] = $this->in_arr['taskid'];  //任务id
                $log['f_datetime'] = time();
                M('action_log')->add($log);
                $this->out_arr['taskid']=$tasktypeid;
                $this->out_arr['Tanswerindex']=$indexid;
                $this->out_arr['error_code'] = 'edit_success';
                $this->out_arr['error_text'] = '';
        } else {
            //操作记录入库
            $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
            $log['f_action'] = "随手赚新增第二步";  //操作说明
            $log['f_taskid'] = $this->in_arr['taskid'];  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            $re = M("surveytaskdetail")->add($map);
            if ($re) {
                $this->out_arr['taskid']=$tasktypeid;
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['Tanswerindex'] = $re;
            } else {
                $this->out_arr['error_code'] = 'small_info_fail';
                $this->out_arr['error_text'] = '';
            }
        }
    }

    //新的问题模板的新增与编辑
    function cPush_answer(){
         $tasktype = $this->in_arr['tasktype'];
         $taskid = $this->in_arr['taskid'];
         $answer_arr=json_decode($this->in_arr['answer_arr']);
         foreach($answer_arr as $k=>$v){
             $map['F_TASKID'] = $taskid;
             $map['F_SERIAL'] = $v[4];
             $map['F_PROBLEMTATILE'] =$v[1];
             $map['F_TYPE'] =$v[2];
             $map['F_OPTIONS'] =$v[3];
             $map['F_ORDERNO'] = time() . $tasktype . rand(1000000, 9999999);
             $map['F_TRUEAnswer'] =$v[5];
             $sindexid=$v[0];
             if ($sindexid != 0) {
                 $re = M("surveytaskdetail")->where('F_STDINDEX=' . $sindexid)->save($map);
                 //操作记录入库
                 $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
                 $log['f_action'] = "随手赚模板编辑第二步";  //操作说明
                 $log['f_taskid'] = $taskid;  //任务id
                 $log['f_datetime'] = time();
                 M('action_log')->add($log);
                 $this->out_arr['error_code'] = 'success';
                 $this->out_arr['error_text'] = '';
             } else {
                 //操作记录入库
                 $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
                 $log['f_action'] = "随手赚模板新增第二步";  //操作说明
                 $log['f_taskid'] =$taskid;  //任务id
                 $log['f_datetime'] = time();
                 M('action_log')->add($log);
                 $re = M("surveytaskdetail")->add($map);
                 if ($re) {
                     $this->out_arr['error_code'] = 'success';
                     $this->out_arr['error_text'] = '';
                     $this->out_arr['sindexid'] = $re;
                 } else {
                     $this->out_arr['error_code'] = 'small_info_fail';
                     $this->out_arr['error_text'] = '';
                 }
             }
         }
    }

    //督查赚第二步
    function cCheck1()
    {
        $taskid = $this->in_arr['taskid'];
        $sindexid = $this->in_arr['sindexid'];
        $map['F_TASKID'] = $taskid;
        $map['F_SERIAL'] = $this->in_arr['f_serial'];
        $map['F_PROBLEMTATILE'] = $this->in_arr['f_problemtatile'];
        $map['F_TYPE'] = $this->in_arr['f_type'];
        $map['F_OPTIONS'] = $this->in_arr['f_options'];
        $map['F_ORDERNO'] = time() . $tasktypeid . rand(1000000, 9999999);
        if ($sindexid != 0) {
            $re = M("surveytaskdetail")->where('F_STDINDEX=' . $sindexid)->save($map);
                //操作记录入库
                $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
                $log['f_action'] = "督查赚编辑第二步";  //操作说明
                $log['f_taskid'] = $this->in_arr['taskid'];  //任务id
                $log['f_datetime'] = time();
                M('action_log')->add($log);
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
        } else {
            //操作记录入库
            $log['f_userid'] = cookie("userId") == "" ? session("id") : cookie("userId");   //操作人id
            $log['f_action'] = "随手赚新增第二步";  //操作说明
            $log['f_taskid'] = $this->in_arr['taskid'];  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);
            $re = M("surveytaskdetail")->add($map);
            if ($re) {
                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['sindexid'] = $re;
            } else {
                $this->out_arr['error_code'] = 'small_info_fail';
                $this->out_arr['error_text'] = '';
            }
        }
    }


    // function cCheck2()
    // {

    //     $map['f_taskid'] = $this->out_arr["taskid"];
    //     $map['f_totalcopies'] = $this->in_arr['pro_taskBrand'];
    //     $map['f_eachcoin'] = $this->in_arr['pro_taskProduct'];
    //     $map['f_eachscore'] = $this->in_arr['eachscore'] == "" ? 3 : $this->in_arr['eachscore'];
    //     $map['f_drawcopies'] = 0;
    //     $map['f_taskrequirements'] = $this->in_arr['editor2'];
    //     $map['f_recommend'] = $this->in_arr['editor4'];
    //     $indexid = $this->in_arr['indexid'] == 0 ? cookie('fuck') : $this->in_arr['indexid'];
    //     if ($fuck != 0 || $this->in_arr['indexid'] != 0) {    //编辑
    //         $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
    //         cookie('fuck', $indexid);
    //     } else { //新增
    //         $re = M("tasksmallinfo")->add($map);
    //         cookie('fuck', $re);
    //     }
    //     // if($re){
    //     $this->out_arr['error_code'] = 'success';
    //     $this->out_arr['error_text'] = '';
    //     // }else{
    //     //     $this->out_arr['error_code'] = 'small_info_fail';
    //     //     $this->out_arr['error_text'] = '';
    //     // }
    // }

    /**
     * ==============================资质文档管理查看===============
     */


    private function  qualific_list()
    {
        $map['f_companyid'] = $this->in_arr['companyid'];
        //查询信息
        $re = M('qualifiedtype')->join('left join t_company_qualified t2 on t_qualifiedtype.f_qualid=t2.f_qtype')->where($map)->select();
        //dump($re); //查询返回的详细数据
        if (count($re) == 0) {
            $quali = M('Qualifiedtype')->select();
            $this->out_arr['error_code'] = "no_one_data";
            $this->out_arr['list'] = $quali;
        } else {
            $this->out_arr['error_code'] = "have_data";
            $this->out_arr['list'] = $re;
        }
    }

    /**
     * ==============================教育信息===============
     * userId=1&companyId=3&userSchool=1&userDepartment=10&userEducation=10&beginDate=10&endDate=10&moreDescription=10&orderId=10&id=1
     * $userId,$companyId,$orderId,$userSchool,$userDepartment,$userEducation,$beginDate,$endDate,$moreDescription,$id=0
     */
    private function eduInfo()
    {
        if (!$this->isset_F(array("userid", "companyid", "userschool", "userdepartment", "usereducation", "begindate", "enddate", "moredescription", "orderid"))) {
            $this->out_arr['error_code'] = 'field_no_exist';
            $this->out_arr['error_text'] = '必传参数不存在';
        } else {
            if (!$this->empty_F(array("userid", "companyid", "userschool", "userdepartment", "usereducation", "begindate", "enddate", "moredescription", "orderid"))) {
                $this->out_arr['error_code'] = 'field_empty';
                $this->out_arr['error_text'] = '必传参数为空';
            } else {
                $userId = $this->in_arr['userid'];
                $companyId = $this->in_arr['companyid'];
                $orderId = $this->in_arr['orderid'];
                $userSchool = $this->in_arr['userschool'];
                $userDepartment = $this->in_arr['userdepartment'];
                $userEducation = $this->in_arr['usereducation'];
                $beginDate = $this->in_arr['begindate'];
                $endDate = $this->in_arr['enddate'];
                $moreDescription = $this->in_arr['moredescription'];
                $id = isset($this->in_arr['id']) ? $this->in_arr['id'] : 0;
                $state = isset($this->in_arr['state']) ? $this->in_arr['state'] : 1;
                $re = A("Jhttp")->eduInfo($userId, $companyId, $orderId, $userSchool, $userDepartment, $userEducation, $beginDate, $endDate, $moreDescription, $id);
                $arr = json_decode($re, true);
                $errorCode = $arr['resCode'];
                if ($errorCode == "000000") {
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'edu_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
            }

        }
    }

    /**
     * ==============================删除教育信息===============
     */
    private function deleduInfo()
    {
        if (!$this->isset_F(array("id"))) {
            $this->out_arr['error_code'] = 'field_no_exist';
            $this->out_arr['error_text'] = '必传参数不存在';
        } else {
            if (!$this->empty_F(array("id"))) {
                $this->out_arr['error_code'] = 'field_empty';
                $this->out_arr['error_text'] = '必传参数为空';
            } else {
                $id = $this->in_arr['id'];
                $re = A("Jhttp")->deleduInfo($id);
                $arr = json_decode($re, true);
                $errorCode = $arr['resCode'];
                if ($errorCode == "000000") {
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'edu_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
            }

        }
    }

    /**
     * ==============================工作信息===============
     * userId=1&companyId=4&companyName=1&userPosition=2222&beginDate=10&endDate=10&jobDescription=adf&orderId=3&id=1
     * $userId,$companyId,$orderId,$companyName,$userPosition,$beginDate,$endDate,$jobDescription,$id=0
     */
    private function workInfo()
    {
        if (!$this->isset_F(array("userid", "companyid", "companyname", "userposition", "begindate", "enddate", "jobdescription", "orderid"))) {
            $this->out_arr['error_code'] = 'field_no_exist';
            $this->out_arr['error_text'] = '必传参数不存在';
        } else {
            if (!$this->empty_F(array("userid", "companyid", "companyname", "userposition", "begindate", "enddate", "jobdescription", "orderid"))) {
                $this->out_arr['error_code'] = 'field_empty';
                $this->out_arr['error_text'] = '必传参数为空';
            } else {
                $userId = $this->in_arr['userid'];
                $companyId = $this->in_arr['companyid'];
                $orderId = $this->in_arr['orderid'];
                $companyName = $this->in_arr['companyname'];
                $userPosition = $this->in_arr['userposition'];
                $beginDate = $this->in_arr['begindate'];
                $endDate = $this->in_arr['enddate'];
                $jobDescription = $this->in_arr['jobdescription'];
                $id = isset($this->in_arr['id']) ? $this->in_arr['id'] : 0;
                $state = isset($this->in_arr['state']) ? $this->in_arr['state'] : 1;
                $re = A("Jhttp")->workInfo($userId, $companyId, $orderId, $companyName, $userPosition, $beginDate, $endDate, $jobDescription, $id);
                $arr = json_decode($re, true);
                $errorCode = $arr['resCode'];
                if ($errorCode == "000000") {
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'delwork_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
            }

        }
    }

    /**
     * ==============================删除教育信息===============
     */
    private function delworkInfo()
    {
        if (!$this->isset_F(array("id"))) {
            $this->out_arr['error_code'] = 'field_no_exist';
            $this->out_arr['error_text'] = '必传参数不存在';
        } else {
            if (!$this->empty_F(array("id"))) {
                $this->out_arr['error_code'] = 'field_empty';
                $this->out_arr['error_text'] = '必传参数为空';
            } else {
                $id = $this->in_arr['id'];
                $re = A("Jhttp")->delworkInfo($id);
                $arr = json_decode($re, true);
                $errorCode = $arr['resCode'];
                if ($errorCode == "000000") {
                    $this->out_arr['error_code'] = 'success';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'deledu_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
            }

        }
    }

    /**
     * ==============================获取工作信息===============
     */
    private function getWorkInfo()
    {
        $userId = $this->in_arr['userid'];
        $re = A("Jhttp")->getWorkInfo($userId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } else {
            $this->out_arr['error_code'] = 'getWork_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }

    /**
     * ==============================获取教育信息===============
     */
    private function getEduInfo()
    {
        $userId = $this->in_arr['userid'];
        $re = A("Jhttp")->getEduInfo($userId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } else {
            $this->out_arr['error_code'] = 'getEdu_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }

    /**
     * ==============================获取行业信息===============
     */
    private function getIndustry()
    {
        $parentId = $this->in_arr['parentid'];
        $re = A("Jhttp")->getIndustry($parentId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } else {
            $this->out_arr['error_code'] = 'getIndustry_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }

    /**
     * ==============================获取行业标签===============
     */
    private function getSkillLabel()
    {
        $industryId = $this->in_arr['industryid'];
        $re = A("Jhttp")->getSkillLabel($industryId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } else {
            $this->out_arr['error_code'] = 'getSkillLabel_sys_error';
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }

    /**
     * ==============================获取聊天未读信息个数===============
     */
    public function getTalkNum($unReadMessage_dealerid)
    {
        $map['f_dealerid'] = $unReadMessage_dealerid;
        $map['f_status'] = 1;
        $map['f_read_web'] = 0;  //0未读，1已读


        $re = M('talk')->where($map)->count();
        return $re;
    }


    /**
     * ==============================获取聊天列表===============
     */
    public function getTalkList()
    {
        $map['f_dealerid'] = $this->in_arr['dealerid'];
        $map['f_status'] = 1;

        $re = M('talk')->where($map)->order('f_indexid  asc')->select();
//        echo M('talk')->getLastSql();
//        dump($re);
//        exit;

        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无洽谈信息';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        }
    }

    /**
     * ==============================添加聊天内容===============
     */
    private function addTalk()
    {
        $dealerid = $this->in_arr['dealerid'];
        $userid = isset($this->in_arr['userid']) ? $this->in_arr['userid'] : 0;
        $companyid = isset($this->in_arr['companyid']) ? $this->in_arr['companyid'] : 0;
        $content = $this->in_arr['content'];
        $time = time();
        $tindexid = isset($this->in_arr['tindexid']) ? $this->in_arr['tindexid'] : 0;

        //添加操作
        $re = D('Talk')->addTalk($dealerid, $userid, $companyid, $content, $time, $tindexid);
        if ($re != 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $re;
            cookie('now_talkid', $re);
        } elseif ($tindexid > 0) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['taskid'] = $tindexid;
            cookie('now_talkid', $tindexid);
        } else {
            $this->out_arr['error_code'] = 'add_error';
            $this->out_arr['error_text'] = '添加聊天内容失败';
        }
    }

    /**
     * ==============================删除聊天内容===============
     */
    private function deleteTalk()
    {
        $indexId = $this->in_arr['indexid'];
        $re = D('Talk')->deleteTalk($indexId);
        if ($re) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            //$this->out_arr['list']=$re;
        } else {
            $this->out_arr['error_code'] = 'delete_error';
            $this->out_arr['error_text'] = '数据删除失败';
            // $this->out_arr['list']="";
        }
    }

    /**
     * ===============部门添加=============
     */
    private function  addDept()
    {
        $deptName = $this->in_arr['deptName'];
        $companyId = $this->in_arr['companyId'];
        $parentId = $this->in_arr['parentId'];
        $re = A('Jhttp')->addDept($deptName, $companyId, $parentId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
//            dump($this->in_arr);
//            dump($re);
//            exit;
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = '添加失败';
        }
    }

    /***
     * =========部门更新==================
     */
    private function updateDept()
    {
        $deptName = $this->in_arr['deptName'];
        $companyId = $this->in_arr['companyId'];
        $parentId = $this->in_arr['parentId'];
        $departId = $this->in_arr['departId'];
        $re = A('Jhttp')->updateDept($deptName, $companyId, $parentId, $departId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            echo $re;
            exit;
            $this->out_arr['error_code'] = 'false';
            $this->out_arr['error_text'] = '更新失败';
        }
    }

    /**
     * =========部门删除============
     */
    private function   delteDept()
    {
        $departId = $this->in_arr['departId'];
        $re = A('Jhttp')->delteDept($departId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
            $this->out_arr['error_code'] = 'false';
            $this->out_arr['error_text'] = '删除失败';
        }
    }

    /**
     * ======获取部门列表===========
     */
    private function  getDeparts()
    {
        $companyId = $this->in_arr['companyId'];
        $re = A('Jhttp')->getDeparts($companyId);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $arr['list'];
        } else {
            $this->out_arr['error_code'] = 'false';
            $this->out_arr['error_text'] = '获取失败';
        }
    }

    /**
     * =====添加部门下员工信息
     */
    private function  addDeptuser()
    {
        $companyId = $this->in_arr['companyId'];
        $departId = $this->in_arr['departId'];
        $nickName = $this->in_arr['nickName'];
        $trueName = $this->in_arr['trueName'];
        $officePhone = $this->in_arr['officePhone'];
        $otherPhone = $this->in_arr['otherPhone'];
        $email = $this->in_arr['email'];
        $userLevel = $this->in_arr['userLevel'];
        $mobile = $this->in_arr['mobile'];
        $sex = $this->in_arr['sex'];
        $password = $this->in_arr['password'];
//        $password = md5("123456");
//        dump($password);
        $fax = $this->in_arr['fax'];
        $homePhone = $this->in_arr['homePhone'];
        $homeAddress = $this->in_arr['homeAddress'];
        $birthday = $this->in_arr['birthday'];
        $idCard = $this->in_arr['idCard'];
        $headLogo = $this->in_arr['headLogo'];
        $invitationCode = $this->in_arr['invitationCode'];


        $position = $this->in_arr['position'];


//        var_dump($password);
//         var_dump($this->in_arr);exit;
        $re = A('Jhttp')->addDeptuser($companyId, $departId, $nickName, $trueName, $officePhone, $otherPhone, $email, $userLevel, $mobile, $sex, $password, $fax, $homePhone, $homeAddress, $birthday, $idCard, $headLogo, $invitationCode,$position);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        } else {
//         	echo $re;
            //用户存在即电话号码已存在
            $this->out_arr['error_code'] = 'false';
            $this->out_arr['error_text'] = '添加用户信息失败';
        }
    }

    //获取部门下的员工信息
    private function  getUsersByDepart()
    {
        $departId = $this->in_arr['departId'];
        $queryStart = $this->in_arr['queryStart'];
        $queryEnd = $this->in_arr['queryEnd'];
        $re = A('Jhttp')->getUsersByDepart($departId, $queryStart, $queryEnd);
        $arr = json_decode($re, true);
        $errorCode = $arr['resCode'];
        if ($errorCode == "000000") {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['list'] = $arr['list'];
            $this->out_arr['error_text'] = '';
        } else {
//         	echo $re;
            $this->out_arr['error_code'] = 'false';
            $this->out_arr['error_text'] = '获取用户信息失败';
        }
    }

    //获取经销商进程列表
    private function  getDealerList()
    {
        $dealerid = $this->in_arr['dealerid'];

        $re = M('business_progress')->where('f_dealerid=' . $dealerid)->limit(1)->order('f_id desc')->select();
        $result = array();
        if ($re[0]['f_proname']=='contract' && $re[0]['f_prostatus']=='1') {
            $data["f_dealerid"]=$dealerid;
            $data["f_proname"]='contract';
            $data["f_prostatus"]=2;
            $result = M('business_progress')->where($data)->select();
        }
        if (!empty($result)) {
            $re = $result;
        }

        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无进程列表';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        }
    }

    //获取授权书
    private function  getWarrantList()
    {
        $dealerid = $this->in_arr['dealerid'];

        $re = M('dealerbaseinfo')->where('f_dealerid=' . $dealerid)->find();
        if ($re["f_dealer_strats"] == 1) {
            $re['url'] = C('WebUrl') . U('mobileweb/authority/index') . "?dealerid=" . $dealerid;
        } else {
            $re['url'] = "";
        }

        if (count($re) <= 0) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无授权书';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        }
    }


    //获取随手答题页面
    private function  getChoicesList()
    {
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:"";
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:"";
        $mobilesystem = isset($this->in_arr['mobilesystem'])?$this->in_arr['mobilesystem']:"";
        $url = C('WebUrl') . U('mobileweb/Events/answerClass') . "?userid=" . $userid . "&taskid=" . $taskid . "&mobilesystem=" . $mobilesystem;
        if (""==$userid ||""==$taskid) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '加载失败';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['url'] = $url;
        }
    }

    //获取随手答题与页面任务预览
    private function  getChoicesListPreview()
    {
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:"";
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:"";
        $mobilesystem = isset($this->in_arr['mobilesystem'])?$this->in_arr['mobilesystem']:"";
        $url = C('WebUrl') . U('mobileweb/Events/problemPreview') . "?userid=" . $userid . "&taskid=" . $taskid . "&mobilesystem=" . $mobilesystem;
       if (""==$userid ||""==$taskid) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '加载失败';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['url'] = $url;
        }
    }

    //获取随手调研页面
    private function  getChooseList()
    {
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:"";
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:"";
        $mobilesystem = isset($this->in_arr['mobilesystem'])?$this->in_arr['mobilesystem']:"";
        $url = C('WebUrl') . U('mobileweb/Events/surveyClass') . "?userid=" . $userid . "&taskid=" . $taskid . "&mobilesystem=" . $mobilesystem;
       if (""==$userid ||""==$taskid) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '加载失败';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['url'] = $url;
        }
    }

    //获取随手推荐页面
    private function  getSpreadList()
    {
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:"";
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:"";
        $url = C('WebUrl') . U('mobileweb/Events/spreadClass') . "?userid=" . $userid . "&taskid=" . $taskid;
       if (""==$userid ||""==$taskid) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '加载失败';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['url'] = $url;
        }
    }


    //获取随手推荐任务预览
    private function  getSpreadListPreview()
    {
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:"";
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:"";

        $url = C('WebUrl') . U('mobileweb/Events/spreadPreview') . "?userid=" . $userid . "&taskid=" . $taskid;

       if (""==$userid ||""==$taskid) {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '加载失败';
        } else {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['url'] = $url;
        }
    }

    private function writelog($txt)
    {
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        //$txt = "Bill Gates\n";
        fwrite($myfile, "=====" . $txt);
        fclose($myfile);
    }

    //上传通讯录
    private function upContacts()
    {
        $basetxt = $this->in_arr['jsontxt'];
        $jsontxt = base64_decode($basetxt);
        $userid = $this->in_arr['userid'];
        //判断传的数据是否为空
        if (!empty($jsontxt)) {
            $javapost['userId'] = $userid;
            $javapost['key'] = $basetxt;
            $re = A("Jhttp")->in_u(json_encode($javapost));//发送给JAVA
            $re_arr = json_decode($re, true);
            $own_phone = $re_arr['mobile'];//自己的手机号，环信使用
            if ($re_arr['resCode'] == "000000") {
                foreach ($re_arr['list'] as $key => $val) {
                    if (empty($val['mobile'])) {
                        $val['mobile'] = '_';
                    }
                    if (empty($val['name'])) {
                        $val['name'] = '_';
                    }
                    if (isset($val['sameFriendCount'])) {
                        $val['userInfo']['userCompanyName'] = $val['userCompanyName'];//写入公司名称
                        //存入数据库的信息
                        $arr[] = array('f_userid' => $userid, 'f_mobile' => $val['mobile'], 'f_name' => $val['name'], 'f_status' => $val['status'], 'f_frienduserid' => $val['frienduserid'], 'sameFriendCount' => $val['sameFriendCount']);
                        //返回给手机端的信息
                        $arr_back[] = array('f_id' => $key, 'f_userid' => $userid, 'f_mobile' => $val['mobile'], 'f_name' => $val['name'], 'f_status' => $val['status'], 'f_frienduserid' => $val['frienduserid'], 'sameFriendCount' => $val['sameFriendCount'], 'userinfo' => $val['userInfo']);
                        //存入好友详情数据库的信息
                        $arr_detail[] = array('f_fid' => $val['frienduserid'], 'f_detail' => A('Fun')->JSON($val['userInfo']));
                        //列出好友的手机号，环信使用
                        $arr_fri[] = array('f_mobile' => $val['mobile']);
                    } else {
                        //存入数据库的信息
                        $arr[] = array('f_userid' => $userid, 'f_mobile' => $val['mobile'], 'f_name' => $val['name'], 'f_status' => $val['status'], 'f_frienduserid' => $val['frienduserid'], 'sameFriendCount' => 0);
                        //返回给手机端的信息
                        $arr_back[] = array('f_id' => $key, 'f_userid' => $userid, 'f_mobile' => $val['mobile'], 'f_name' => $val['name'], 'f_status' => $val['status'], 'f_frienduserid' => $val['frienduserid'], 'sameFriendCount' => 0);
                    }
                }
                //通讯录
                M("contacts")->addAll($arr, array(), true);
                //通讯录好友详情
                M("contacts_detail")->addAll($arr_detail, array(), true);
                A('Api/Easemob')->easemob_friend($arr_fri, $own_phone);

                $this->out_arr['error_code'] = 'success';
                $this->out_arr['error_text'] = '';
                $this->out_arr['list'] = $arr_back;
//                pt($arr_fri);
//                pt($arr_detail);
//                pt($arr);
//                pt($arr_back);
//                exit;
                //添加好友关系

            } else {
                $this->out_arr['error_code'] = 'sys_error';
                $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($re_arr['resCode']);
            }
        } else {
            $this->out_arr['error_code'] = 'empty';
            $this->out_arr['error_text'] = '上传数据为空';
        }

    }

    //获取通讯录
    private function getContacts()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $re = M("contacts")->field('f_userid', true)->where($map)->select();
        if ($re) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无数据';
        }
    }

    /**
     * 获取通讯录
     */
    private function  manageContacts()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $re = M("contacts")->field('f_userid', true)->where($map)->select();
//        pt($re);
        foreach ($re as $key => $val) {
            $re[$key]['sameFriendCount'] = $val['sameFriendCount'];
            if ($val['f_frienduserid'] != 0) {
                $map_1['f_fid'] = $val['f_frienduserid'];
                $re_1 = M("contacts_detail")->field('f_detail')->where($map_1)->find();
                $re[$key]['userinfo'] = json_decode($re_1['f_detail'], true);
            }
        }
//        pt($re);
        //echo M("contacts")->getLastSql();
        if ($re) {
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
            $this->out_arr['list'] = $re;
        } else {
            $this->out_arr['error_code'] = 'list_empty';
            $this->out_arr['error_text'] = '暂无数据';
        }

    }

    /**
     * 处理通讯录
     */
//      private  function  manageContacts(){
//        $re_list = $this->getContractsMath();
//        foreach ($re_list as $key => $value) {
//            if ($value['f_status']==1|$value['f_status']=='1') {
//                $result = A('Jhttp')->getUserinfo2($value['f_frienduserid']);
//                $result = json_decode($result,true);
//                $re_list[$key]['userinfo']=$result['list'];
//                $result_friend_count = A('Jhttp')->getSameFriendCount($this->in_arr['userid'],$value['f_frienduserid']);
//                $result_friend_count = json_decode($result_friend_count,true);
//                $re_list[$key]['sameFriendCount']=$result_friend_count['count'];
//
//            }
//        }
//
//        if($re_list){
//            $this->out_arr['error_code'] = 'success';
//            $this->out_arr['error_text'] = '';
//            $this->out_arr['list'] = $re_list;
//        }else{
//            $this->out_arr['error_code'] = 'list_empty';
//            $this->out_arr['error_text'] = '暂无数据';
//        }
//
//    }

    /**
     * 处理通讯录数据
     */
    function getContractsMath()
    {
        $map['f_userid'] = $this->in_arr['userid'];
        $re = M("contacts")->field('f_userid', true)->where($map)->select();
        $str = '';
        for ($i = 0; $i < count($re); $i++) {
            $trueMath = str_replace('-', '', $re[$i]['f_mobile']);
            $trueMath = str_replace('(', '', $trueMath);
            $trueMath = str_replace(')', '', $trueMath);
            $trueMath = str_replace(' ', '', $trueMath);
            if ($i == 0) {
                $str .= $trueMath;
            } else {
                $str .= '|' . $trueMath;
            }
        }

        $re1 = A('Jhttp')->addUser2User($this->in_arr['userid'], $str);
        $re1_count = json_decode($re1, true);

        $re1_userId = explode("|", $re1_count['userId']);
        $re1_key = explode("|", $re1_count['key']);
        $re1_value = explode("|", $re1_count['value']);
        for ($i = 0; $i < count($re1_key) - 1; $i++) {

            if ($re1_value[$i] == 1 | $re1_value[$i] == '1') {
                $map_1['f_status'] = 1;
                $map_1['f_frienduserid'] = $re1_userId[$i];
                $re2 = M("contacts")->where('f_id=' . $re[$i]['f_id'])->save($map_1);
            }

        }

        $re_list = M("contacts")->field('f_userid', true)->where($map)->select();

        return $re_list;
    }


    //记录打开APP
    private function openApp()
    {
        $map['f_udid'] = $this->in_arr['udid'];
        $map['f_deviceid'] = $this->in_arr['deviceid'];
        $map['f_time'] = time();

        $re = M('openapp')->where("f_deviceid='" . $map['f_deviceid'] . "'")->find();
        if (!$re) {
            M('openapp')->add($map);
        }
    }

    //小宝上关于说明的内容
    private function aboutapp()
    {
        $map['type_label'] = $this->in_arr['type_label'];
        $arr = M("aboutapp")->find();
//        pt($arr);
        $this->out_arr['error_code'] = 'success';
        $this->out_arr['error_text'] = '';
        $this->out_arr[$map['type_label']] = $arr[$map['type_label']];
    }

    //版本认证
    private function versions_oath(){
        $versions = $this->in_arr['versions'];
        if($versions==C('Versions')){
            $this->out_arr['error_code'] = 'success';
            $this->out_arr['error_text'] = '';
        }else{
            $this->out_arr['error_code'] = 'versions_error';
            $this->out_arr['error_text'] = '请更新版本';
        }
    }

    //版本认证
    private function receive(){
        $userid = $this->in_arr['userid'];
        $taskid = $this->in_arr['taskid'];

        $name = $this->in_arr['name'];
        $phone = $this->in_arr['phone'];
        $code = $this->in_arr['code'];
        $location = $this->in_arr['location'];
        $address = $this->in_arr['address'];

    }

    /*
     * 微信登录
     * 通过微信unionId获取用户信息
     * @param unionId
     * return arr 用户信息
     */

    private function weixinLogin()
    {

        //调用java接口
        $unionId = $this->in_arr['unionId'];
        $result = A("Jhttp")->weixinLogin($unionId);

        $result_arr = json_decode($result, true);
        $errorCode = $result_arr['resCode'];

        $f_url = D('files')->getFileUrl($result_arr['list']['headLogo']);
        $result_arr['list']['headLogoUrl'] = $f_url;

        if ($errorCode == '000000') {
            $this->out_arr = $result_arr;
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        } else {
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }

    }


    /*
     * 微信绑定
     * 通过微信unionId获取用户信息
     * @param unionId,mobile,password
     * unionId 微信的$unionId
     * mobile 手机号
     * password 用户密码
     * return arr 用户信息
     */

    private function addWeixin()
    {
        //调用java接口
        $unionId = $this->in_arr['unionId'];
        $mobile = $this->in_arr['mobile'];
        $password = $this->in_arr['password'];

        if( isset($this->in_arr['companyId']) ){ //厂商端调用
            $companyId = $this->in_arr['companyId'];
            $result = A("Jhttp")->addWeixin($unionId,$mobile,$password,$companyId);
        }else{  //app端调用
            $result = A("Jhttp")->addWeixin($unionId,$mobile,$password);
        }

        $result_arr = json_decode($result, true);
        $errorCode = $result_arr['resCode'];

        $f_url = D('files')->getFileUrl($result_arr['list']['headLogo']);
//        $result_arr['list']['headLogoUrl'] = C("WebUrl")."Public/upfile/".$f_url;
        $result_arr['list']['headLogoUrl'] = $f_url;

        if ($errorCode == '000000') {
            $this->out_arr = $result_arr;
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        } else {
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }


    }

    //经销商获取厂商列表
    private function getFacList(){
        $re = A("Jhttp")->getFacList($this->in_arr['userid'],$this->in_arr['companyid']);
        $arr = json_decode($re,true);
        $errorCode = $arr["resCode"];
        if ($errorCode == '000000') {
            $this->out_arr["list"] = $arr["list"];
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        } else {
            $this->out_arr['error_code'] = $errorCode;
            $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
        }
    }


    //接受电话会议回调，格式：XML
    public function mtCallback(){
        //接受
        $xml = file_get_contents('php://input');
        //XML转数组，并转JSON
        $string = json_encode((array)simplexml_load_string($xml));
        //重新把JSON转成数组
        $arr = json_decode($string,true);
        //写入日志
        \Think\Log::write("METTINGBACK_IN:::".json_encode($arr),"NOTICE");

        //处理业务



    }




}