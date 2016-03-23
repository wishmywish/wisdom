<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/7
 * Time: 14:41
 */

namespace Taskadmin\Controller;
use Think\Controller;

class DealerController extends Controller
{
    function index(){
        set_theme();
        // $access = I('get.access','000000');
        // A("Api/Fun")->isAccess($access);//�жϲ˵�Ȩ��

        $sql = "SELECT DISTINCT  f_industrytype FROM t_dealerlibrary WHERE f_industrytype<>''";
        $result = M('dealerlibrary')->query($sql);

        $this->assign('result',$result);
        $this->display();
    }

    function linkReport(){
        set_theme();

        $this->display('linkReport');
    }

    function modi(){
        set_theme();
        $id = I('id');
        $result = M('dealerlibrary')->where('f_indexid='.$id)->find();

        // var_dump($id);
        // var_dump($result);exit();
        $this->assign('reModi',$result);
        $this->assign('id',$id);
        $this->display();
    }

    //���ӵ绰����
    function addShowNote(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//����Ƿ��¼

        $id = I('get.id');
        $selectId = I('get.selectId');
        $this->assign('saleId',$id);
        $this->assign('selectid',$selectId);

        $this->display();
    }
    
    //��ȡ����������
    function showdealer(){
        $area=I("get.area","");
        if(!empty($area)){
            $map['f_area'] = array("LIKE",$area);
        }
        $industrytype=I("get.industrytype","");
        if(!empty($industrytype)){
            $map['f_industrytype'] = $industrytype;
        }
        $dealername=I("get.dealername","");
        if(!empty($dealername)){
            $map['f_dealername'] = array("LIKE",$dealername);
        }
        $status=I("get.status","");
        if(!empty($status)){
            $map['f_status'] = $status;
        }

        $re = M("dealerlibrary")->where($map)->select();
        echo json_encode($re);
    }

    public function detail() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//����Ƿ��¼
        $reModi = A('Api/Web')->getDealDetail();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $this->display();
    }

    function export_csv($filename,$data)   
    {   
        header("Content-type:text/csv");   
        header("Content-Disposition:attachment;filename=".$filename);   
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
        header('Expires:0');   
        header('Pragma:public'); 
        echo $data;
    } 

    function explodeAll(){

        foreach (session("dealerList") as $key => $value) {
            $value['f_dealername'] = str_replace("\"", "\"\"", $value['f_dealername']);
            $value['f_dealername'] = str_replace(",", "��", $value['f_dealername']);
            $f_dealername = iconv('utf-8','GB2312//IGNORE',$value['f_dealername']); //����ת��   

            $value['f_industrytype'] = str_replace("\"", "\"\"", $value['f_industrytype']);
            $value['f_industrytype'] = str_replace(",", "��", $value['f_industrytype']);
            $f_industrytype = iconv('utf-8','GB2312//IGNORE',$value['f_industrytype']); //����ת��   

            $value['f_area'] = str_replace("\"", "\"\"", $value['f_area']);
            $value['f_area'] = str_replace(",", "��", $value['f_area']);
            $f_area = iconv('utf-8','GB2312//IGNORE',$value['f_area']); //����ת��   

            $value['f_chargeperson'] = str_replace("\"", "\"\"", $value['f_chargeperson']);
            $value['f_chargeperson'] = str_replace(",", "��", $value['f_chargeperson']);
            $f_chargeperson = iconv('utf-8','GB2312//IGNORE',$value['f_chargeperson']); //����ת��   

            $value['f_channeltype'] = str_replace("\"", "\"\"", $value['f_channeltype']);
            $value['f_channeltype'] = str_replace(",", "��", $value['f_channeltype']);
            $f_channeltype = iconv('utf-8','GB2312//IGNORE',$value['f_channeltype']); //����ת��   

            $value['f_status'] = str_replace("\"", "\"\"", $value['f_status']);
            $value['f_status'] = str_replace(",", "��", $value['f_status']);
            $f_status = iconv('utf-8','GB2312//IGNORE',$value['f_status']); //����ת��   

            $value['f_desctiption'] = str_replace("\"", "\"\"", $value['f_desctiption']);
            $value['f_desctiption'] = str_replace(",", "��", $value['f_desctiption']);
            $f_desctiption = iconv('utf-8','GB2312//IGNORE',$value['f_desctiption']); //����ת��   

            $str .= $f_dealername.",".$f_industrytype.",".$f_area.",".$value['f_moblie'].",".$f_chargeperson.",".$f_channeltype.",".$f_status.",".$f_desctiption."\n"; //�����Ķ��ŷֿ�   
        } 

        $filename = '�������б�'.'.csv'; //�����ļ���   
        $this->export_csv($filename,$str); //����   

    }

}