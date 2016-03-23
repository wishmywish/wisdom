<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/24
 * Time: 14:45
 */

namespace Taskadmin\Controller;
use Think\Controller;


class BankController extends Controller
{
    public $no;
    function cBank(){
        header("Content-Type: text/html;charset=GB2312");
        //$id = I('get.id');
        $sum = I('get.sum');
        $arr = M("banknamelist")->field("banknamelist.id,banknamelist.bankname,banknolist.sno")->join("LEFT JOIN banknolist ON banknolist.nameid = banknamelist.id")->select();
//        pt($arr);
//        exit;
        for($i=0;$i<$sum;$i++){
//            echo count($arr)-1;
            $sno = $arr[rand(0,count($arr)-1)]['sno'];
//            echo $sno;
            $mno = rand(111111111,999999999);
            $eno = rand(1111,9999);
            $this->no[$i]['bankno'] = $sno.$mno.$eno;
            $this->no[$i]['bankname'] = $arr[rand(0,count($arr)-1)]['bankname'];
        }
        $this->explodeCard();
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

    function explodeCard(){
        $str = "���п�,��������\n";
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach ($this->no as $key => $value) {
            $value['bankname'] = str_replace("\"", "\"\"", $value['bankname']);
            $value['bankname'] = str_replace(",", "��", $value['bankname']);
            $bankname = iconv('utf-8','GB2312//IGNORE',$value['bankname']);

            $bankno = iconv('utf-8','GB2312//IGNORE',$value['bankno']);

            $str .= $bankno."��,".$bankname."\n";
        }

//        pt($str);

        $filename = '银行卡'.'.csv';
        $this->export_csv($filename,$str);

    }
}