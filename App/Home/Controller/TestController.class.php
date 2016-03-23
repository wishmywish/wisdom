<?php
/**
 * 部门的	增删查改
 * 员工的	增删查改
 * @author Administrator
 */
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	static public $treeList = array();
	
        // $ret=A("Test")->getMenulist();
        // $this->assign("ret",$ret);
        // var_dump($ret);
        // exit;
    function  index(){
        // $ret=A("Test")->getMenulist();
        $ret=$this->getMenulist();
        $this->assign("ret",$ret);
        $this->display();
        // var_dump($ret);
        // exit;
    }
    
    //获取部门列表(公共部分，不要轻易修改)
    function getMenulist(){ 
    	set_theme();
    	
    	$deptListArr = array();	//树状部门关系
    	
    	$result = M("syscolumn")->select();	//公司下已有部门列表
    	
    	// $deptListArr = json_decode($result,true); //json->数组   	
 	    
    	$deptListArr_tree = $this->tree($result);	//树状显示
    	// dump($deptListArr_tree);
    	// exit;
    	return $deptListArr_tree;  
    	  	
    }    

   
    //树状显示
    static public function tree(&$arr,$pid=0,$count=0){
    	foreach( $arr as $key=>$vo ){    		
    		if( $vo['f_sys_column_pid'] == $pid ){
    			$vo['count'] = $count;    			
    			self::$treeList[] = $vo;
    			unset($arr[$key]);
    			self::tree($arr,$vo['f_syscolumn_id'],$count+1);
    		}  		
    	}  
    	
    	return self::$treeList;
    }  
    
}
