<?php
namespace Api\Controller;
use Think\Controller;
use Think\Upload;
class UpfileController extends Controller {
    
    private $maxSize = 20971520;//文件最大上传大小
    private $savePath = '';//保存路径
    private $exts = 'jpg,gif,png,jpeg,doc,docx,xls,xlsx,ppt,pptx,pdf,rar,zip';//上传的文件类型
    private $autoSub = true;//自动子目录保存文件
    private $subName = array('date', 'Ymd');
    private $rootPath = './Public/upfile/'; //保存根路径
    private $mimes = '';//允许上传的文件MiMe类型
    
    //接受自定义的参数
    function initialize($options)
    {
        foreach($options as $k => $v)
        {
            $this->$k = $v;
        }
    }
    
    public function upfile() {
        $type = I('get.type',2);
        //pt($_FILES['upfile']);
        $this->upF($type);
    }
    
    //上传文件,$up_exts,$filesize
    function upF($type=1, $size=0, $exts='gif,jpg,png,doc,docx,pdf,rar,xls,xlsx,ai,cdr,jpeg,zip,ppt,pptx'){
        header("Content-Type: text/html;charset=utf-8");

        $extsFlag = true;
        // 消息附件添加
        if($type == 4) {
            $this->maxSize = 5242880;
            $exts = 'jpg,png,gif,doc,xls,ppt,txt,docx,xlsx,pptx';
            // $exts='exe,reg,bat';
            // $extsFlag = false;
        }
        // 流程附件添加
        if($type == 5) {
            $this->maxSize = 5242880;
            $exts = 'jpg,png,gif,doc,xls,ppt,txt,docx,xlsx,pptx';
            // $exts='exe,reg,bat';
            // $extsFlag = false;
        }
        // 公告附件添加
        if($type == 6) {
            $this->maxSize = 20971520;
            $exts = 'jpg,png,gif,doc,xls,ppt,txt,pdf,docx,xlsx,pptx';
            // $exts='exe,reg,bat';
            // $extsFlag = false;
        }

        $config = array(
            'maxSize'    =>    $this->maxSize,
            'mimes'      =>    $this->mimes, 
            'exts'       =>    $exts,
            'extsFlag'   =>    $extsFlag,
            'rootPath'   =>    $this->rootPath,
            'autoSub'    =>    $this->autoSub,
            'savePath'   =>    $this->savePath,
            'subName'    =>    $this->subName,
        );
        $map = array();//定义一个数据，存放上传信息
        $upload = new Upload($config, 'Local');//实例化上传类
        $houzhui = explode(",", $exts);//后缀名数组
        $info = $upload->upload($_FILES);//上传文件,并返回上传后的文件信息

        if(!empty($info)){
            if ($size!=0) {
                if ($info['upfile']['size'] > $size) {
                    $map['error_txt'] = '文件过大';
                    $map['error_no'] = '123456';
                    echo json_encode($map);
                    return false;
                }
            }

            if($type == 4 || $type == 5 || $type == 6) {
                if (!in_array($info['upfile']['ext'], $houzhui)) {
                    $map['error_txt'] = '文件格式不符合要求';
                    $map['error_no'] = '654321';
                    echo json_encode($map);
                    return false;
                }
            } else {
                if (!in_array($info['upfile']['ext'], $houzhui)) {
                    $map['error_txt'] = '文件格式不符合要求';
                    $map['error_no'] = '654321';
                    echo json_encode($map);
                    return false;
                }
            }
        }

        if(!empty($info)){
            $info['fileid'] = D('Files')->actionData($info);

            if($type==1){//默认，合合扫描
                $map['f_fileid'] = $info['fileid'];
                $map['f_path'] = $info['upfile']['savepath'].$info['upfile']['savename'];
                $map['path'] = $config['rootPath']."/".$info['upfile']['savepath'].$info['upfile']['savename'];
                $map['size'] = $info['upfile']['size'];
                $map['fileid'] = $info['fileid'];
                return $map;
            }elseif($type==3){//其他通过接口上传
                return $info;
            }else{//前端直接调用返回
                echo json_encode($info);
            }
        }else{
            if($type==1){
                $map['error_txt'] = $upload->getError();
                $map['error_no'] = '999999';
                return $map;
            }elseif($type==3){
                $map['error_txt'] = $upload->getError();
                $map['error_no'] = '999999';
                return $map;
            }else{
                $map['error_txt'] = $upload->getError();
                $map['error_no'] = '999999';
                echo json_encode($map);
            }
        }
    }
}
