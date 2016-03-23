<?php
namespace Taskadmin\Controller;
use Think\Controller;
class PowerController extends Controller {
    
    public function index(){
        header("Content-Type: text/html;charset=utf-8");
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display();

    }

    //增加用户
    public function add_user(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $result = M('sysaccess')->select();
        $this->assign('result', $result);
        // var_dump($result);exit();
        $this->display();
    }


    //修改用户
     public function modi_user(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $reModi = A('Api/Web')->modiUserData();//取要修改的记录数据
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);

        }
        
        $result = M('sysaccess')->select();
        $this->assign('result', $result);

// var_dump($reModi);exit();

        $this->display();
    }

    //增加角色
    public function add_access(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $re = M("sysaccessfield")->order('f_id asc')->select();

        $Count=M("sysaccessfield")->where('f_fieldpid=0')->select();
        $lastCount=$Count[count($Count)-1];
        $relist = A("Fun")->showAccess($re,$idField='f_id',$pidField='f_fieldpid');

        $this->assign('relist', $relist);
        $this->assign('lastCount', $lastCount);

        $this->display();
    }

    //修改角色
     public function modi_access(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $re = M("sysaccessfield")->order('f_id asc')->select();

        $Count=M("sysaccessfield")->where('f_fieldpid=0')->select();
        $lastCount=$Count[count($Count)-1];

        $reModi = A('Api/Web')->modiAccessClass();//取要修改的记录数据

        foreach ($re as $key => $value) {
            $re[$key]['isChecked'] = 0;
        }

        $result = $reModi['list']['accessvalue'];

        foreach ($result as $key => $value) {
            if ($value[0]=='100') {
                $re[0]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[1]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[2]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[3]['isChecked'] = 1;
                    }
                    if ($value=='d') {
                        $re[4]['isChecked'] = 1;
                    }
                    if ($value=='e') {
                        $re[5]['isChecked'] = 1;
                    }
                    if ($value=='f') {
                        $re[6]['isChecked'] = 1;
                    }
                    if ($value=='g') {
                        $re[7]['isChecked'] = 1;
                    }
                    if ($value=='h') {
                        $re[8]['isChecked'] = 1;
                    }
                    if ($value=='i') {
                        $re[9]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='200') {
                $re[10]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[11]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='300') {
                $re[12]['isChecked'] = 1;
            }
            if ($value[0]=='400') {
                $re[13]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[14]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[15]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[16]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='500') {
                $re[17]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[18]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[19]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[20]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='600') {
                $re[21]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[22]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='800') {
                $re[23]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[24]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[25]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[26]['isChecked'] = 1;
                    }
                    if ($value=='d') {
                        $re[27]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='900') {
                $re[28]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[29]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[30]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[31]['isChecked'] = 1;
                    }
                    if ($value=='d') {
                        $re[32]['isChecked'] = 1;
                    }
                    if ($value=='e') {
                        $re[33]['isChecked'] = 1;
                    }
                    if ($value=='f') {
                        $re[34]['isChecked'] = 1;
                    }
                    if ($value=='g') {
                        $re[35]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='1000') {
                $re[36]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[37]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='1100') {
                $re[38]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[39]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[40]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='1200') {
                $re[41]['isChecked'] = 1;
            }
            if ($value[0]=='1300') {
                $re[42]['isChecked'] = 1;
            }
            if ($value[0]=='1400') {
                $re[43]['isChecked'] = 1;
                foreach ($value[1] as $key => $value) {
                    if ($value=='a') {
                        $re[44]['isChecked'] = 1;
                    }
                    if ($value=='b') {
                        $re[45]['isChecked'] = 1;
                    }
                    if ($value=='c') {
                        $re[46]['isChecked'] = 1;
                    }
                    if ($value=='d') {
                        $re[47]['isChecked'] = 1;
                    }
                }
            }
            if ($value[0]=='1800') {
                $re[48]['isChecked'] = 1;
            }
        }
        
        $relist = A("Fun")->showAccess($re,$idField='f_id',$pidField='f_fieldpid');

        $this->assign('relist', $relist);
        $this->assign('reModi', $reModi);
        $this->assign('lastCount', $lastCount);

        $this->display();
    }



}