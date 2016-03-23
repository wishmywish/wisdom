<?php
namespace Home\Controller;
use Think\Controller;
class DealerController extends Controller {

    public function index()
    {

        set_theme();//载入主题
//        $url1=__ROOT__."/Public/upfile/download/智慧招商服务合同之结清算协议（企业版）6.1.docx";
        $url2=__ROOT__."/Public/upfile/download/资金监管专用账户的说明.jpg";
//        $this->assign("url1",$url1);
        $this->assign("url2",$url2);
        $this->display();
    }
  
    public function showDetail()
    {
        set_theme();//载入主题
        $reModi = A('Api/Web')->isTrue();//取要修改的记录数据
//        var_dump($reModi);exit();
//        exit;
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        
        $this->display('index');
    }

    public  function  companyContact(){ //企业合同下载


    }


    /**
     * 经销商与厂商的合同是否上传
     * 通过表t_business_progress 判断进程
     * f_proname 为contract 0 开始到这个阶段但还没进行，上一阶段完成 1表示经销商合同上传完成  2表示厂商合同上传完成(即表示两个合同都上传完成)
     *
     */
    public function two_contact_upload(){

        $dealerid = I('dealerid'); //经销商id
        $map = array('f_dealerid'=>$dealerid,'f_proname'=>'contract','f_prostatus'=>2);
        $result = M('business_progress')->where($map)->find();
        if( $result ){  //两个合同都已上传成功
            echo 1;
        }else{
            echo 0;
        }


    }


    /**
     * 发货单是否上传
     * 通过表t_business_progress 判断进程
     * f_proname Settlement 1
     *
     */
    public function is_settlement(){

        $dealerid = I('dealerid'); //经销商id
        $map = array('f_dealerid'=>$dealerid,'f_proname'=>'dispatch','f_prostatus'=>1);
        $result = M('business_progress')->where($map)->find();
        if( $result ){  //货款已结算
            echo 1;
        }else{
            echo 0;
        }


    }






     
}
