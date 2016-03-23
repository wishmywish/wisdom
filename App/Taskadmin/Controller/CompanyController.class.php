<?php
namespace Taskadmin\Controller;
use Think\Controller;
class CompanyController extends Controller {
    //put your code here
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display();
    }

    //公司详情
    function showCompanyDetail(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->showCompanyDetail();//公司详情
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        $this->display('companyDetail');
    }

    //公司相關照片
    function showCompanyPhotos(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->showCompanyDetail();//公司详情
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
            if ($reModi['list']['taxRegCertificate']!=null) {
                $map[0]=M('files')->where("f_id=".$reModi['list']['taxRegCertificate'])->find();
            }else {
                $map[0]="";
            }
            if ($reModi['list']['companyLogo']!=null) {
                $map[1]=M('files')->where("f_id=".$reModi['list']['companyLogo'])->find();
            }else {
                $map[1]="";
            }
            if ($reModi['list']['productionLicense']!=null) {
                $map[2]=M('files')->where("f_id=".$reModi['list']['productionLicense'])->find();
            }else {
                $map[2]="";
            }
            if ($reModi['list']['foodDistribLicense']!=null) {
                $map[3]=M('files')->where("f_id=".$reModi['list']['foodDistribLicense'])->find();
            }else {
                $map[3]="";
            }
            if ($reModi['list']['hygieneLicense']!=null) {
                $map[4]=M('files')->where("f_id=".$reModi['list']['hygieneLicense'])->find();
            }else {
                $map[4]="";
            }
            
            $this->assign('map', $map);
        }
        $this->display('companyPhotos');
        
    }

    //下载导入样例
    function example(){
        header("Content-type:text/html;charset=utf-8"); 

        $file_name="companyImport.xls"; 
        //用以解决中文不能显示出来的问题 
        $file_name=iconv("utf-8","gb2312",$file_name); 
        $file_sub_path=__Root__."/Public/upfile/download/"; 

        $file_path=$file_sub_path.$file_name; 
        
        $link = __ROOT__."/Public/upfile/download/".$file_name;
        Header("HTTP/1.1 303 See Other");
        Header("Location:".$link);
    }

    //导入企业
    function addCompany() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $this->display();
    }

    //导入企业
    function import() {
        set_theme();
        header("Content-type:text/html;charset:utf-8");
        //全局变量
        $succ_result=0;
        $error_result=0;
        $file=$_FILES['filename'];
        $max_size="2000000"; //最大文件限制（单位：byte）
        $fname=$file['name'];
        $ftype=strtolower(substr(strrchr($fname,'.'),1));
        $dir=dirname(__FILE__);                       //获取当前脚本的绝对路径
        $dir=str_replace("//","/",$dir)."/";

         //文件格式
        $uploadfile=$file['tmp_name'];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(is_uploaded_file($uploadfile)){
                if($file['size']>$max_size){
                    echo "文件过大！"; 
                    exit;
                }
                if($ftype!='xls' && $ftype!='xlsx' && $ftype!='xlsm' && $ftype!='xltx' && $ftype!='xltm' && $ftype!='xlsb' && $ftype!='xlam'){
                    echo "文件格式错误！";
                    exit;   
                }
            }else{
                echo "文件为空！";
                exit; 
            } 
        }
        $filename='uploadFile.xls'; 
        $result=move_uploaded_file($uploadfile,$dir.$filename);//假如上传到当前目录下
        if($result)  //如果上传文件成功，就执行导入excel操作
        {
            require_once dirname(dirname(__FILE__)).'/ExcelImport/Classes/PHPExcel.php'; 
            require_once dirname(dirname(__FILE__)).'/ExcelImport/Classes/PHPExcel/IOFactory.php';
            require_once dirname(dirname(__FILE__)).'/ExcelImport/Classes/PHPExcel/Reader/Excel5.php';
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
            $objPHPExcel = $objReader->load($dir.$filename); 

            $sheet = $objPHPExcel->getSheet(0); 

            $highestRow = $sheet->getHighestRow(); // 取得总行数 
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $arr_result=array();
            $strs=array();

            for($j=2;$j<=$highestRow;$j++)
            { 
                unset($arr_result);
                unset($strs);
                for($k='A';$k<= $highestColumn;$k++)
                { 
                 //读取单元格
                    $arr_result  .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
                }
                $strs=explode(",",$arr_result);
                $re = A('Api/Jhttp')->companyAdd($strs[0],$strs[1],$strs[2],$strs[3],$strs[4],$strs[5]);
                $content = json_decode($re, true);
                if($content['resCode']=='000000' || $content['resCode']==000000){
                    $succ_result+=1;
                }else{
                    $error_result+=1;
                }
            }
        }
        $this->assign('succ_result',$succ_result);
        $this->assign('error_result',$error_result);

        unlink($dir.$filename); 

        $this->display();
    }

}
