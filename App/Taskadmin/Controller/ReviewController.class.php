<?php
namespace Taskadmin\Controller;
use Think\Controller;
class ReviewController extends Controller {
    
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display('reviewIndex');
    }

    /**
     * 任务详情
     */
    public function showDetail() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getCompanyInfo();//取公司的详细数据

        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $this->display();
    }

    /**
     * 经销商以及业务员详情
     */
    public function detail() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getDetail();//取经销商以及业务员的详细数据

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

    function dealerExport(){
        $str = "经销商名称,经营区域,渠道类型,主营行业,年营业额,流动资金,销售人数,品牌个数,网点数量,物流车数,资源优势,业务员姓名,联系电话\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("getDealerExport")['list'] as $key => $value) {
            $value['f_companynameone'] = str_replace("\"", "\"\"", $value['f_companynameone']);
            $value['f_companynameone'] = str_replace(",", "，", $value['f_companynameone']);
            $f_companynameone = iconv('utf-8','GB2312//IGNORE',$value['f_companynameone']); //中文转码  

            $value['f_area'] = str_replace("\"", "\"\"", $value['f_area']);
            $value['f_area'] = str_replace(",", "，", $value['f_area']);
            $f_area = iconv('utf-8','GB2312//IGNORE',$value['f_area']); //中文转码 

            $value['f_channeltype'] = str_replace("\"", "\"\"", $value['f_channeltype']);
            $value['f_channeltype'] = str_replace(",", "，", $value['f_channeltype']);
            $f_channeltype = iconv('utf-8','GB2312//IGNORE',$value['f_channeltype']); //中文转码 

            $value['f_mainindustry'] = str_replace("\"", "\"\"", $value['f_mainindustry']);
            $value['f_mainindustry'] = str_replace(",", "，", $value['f_mainindustry']);
            $f_mainindustry = iconv('utf-8','GB2312//IGNORE',$value['f_mainindustry']); //中文转码 

            $value['f_advantage'] = str_replace("\"", "\"\"", $value['f_advantage']);
            $value['f_advantage'] = str_replace(",", "，", $value['f_advantage']);
            $f_advantage = iconv('utf-8','GB2312//IGNORE',$value['f_advantage']); //中文转码 

            $value['trueName'] = str_replace("\"", "\"\"", $value['trueName']);
            $value['trueName'] = str_replace(",", "，", $value['trueName']);
            $trueName = iconv('utf-8','GB2312//IGNORE',$value['trueName']); //中文转码 
                                                 
            $str .= $f_companynameone.",".$f_area.",".$f_channeltype.",".$f_mainindustry.",".$value['f_yearturnover'].",".$value['f_floatingcapital'].",".$value['f_salesqty'].",".$value['f_famousbrandqty'].",".$value['f_latticepointqty'].",".$value['f_salesqty'].",".$f_advantage.",".$trueName.",".$value['mobile']."\n"; //用引文逗号分开   
        } 

        $filename = '经销商详情'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

}
