<?php
/**
 * 数组排版后打印
 * @param array $arr 不规则的数组
 * @return array
 */
function pt($arr){
    echo "<pre>";
    print_r($arr);
}
/**
 * 设置主题
 */
 function set_theme($theme=''){
        //判断是否存在设置的模板主题
        if(empty($theme)){
           $theme_name=C('DEFAULT_THEME');
        }else{
           if(is_dir (MODULE_PATH.'View/'.$theme )){
              $theme_name=$theme;             
           }else{
              $theme_name=C('DEFAULT_THEME');
           }           
           
        }
        //替换COMMON模块中设置的模板值  
        if(C('Current_Theme')){
            C('TMPL_PARSE_STRING',str_replace (C('Current_Theme') ,  $theme_name ,  C('TMPL_PARSE_STRING') ));        
        }else{
            C('TMPL_PARSE_STRING',str_replace ( "MODULE_NAME" ,  MODULE_NAME ,  C('TMPL_PARSE_STRING') ));    
            C('TMPL_PARSE_STRING',str_replace ( "DEFAULT_THEME" ,  $theme_name ,  C('TMPL_PARSE_STRING') ));
        }
        C('Current_Theme',$theme_name);
        C('DEFAULT_THEME', $theme_name);
 }
 
 /**
  * 验证码
  */
 function verify(){
    $Verify = new \Think\Verify();
    $Verify->fontSize = 20;
    $Verify->length   = 4;
    $Verify->useNoise = true;
    $Verify->codeSet = '0123456789';
    $Verify->useCurve = false;
    $Verify->imageW = 0;
    $Verify->imageH = 0;
    $Verify->useImgBg = false;
    $Verify->expire = 600;
    $Verify->entry();
 }
 /**
 * 验证码检查 
 */  
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    if($verify->check($code, $id)){
        echo 1;
    }else{
        echo 0;
    }
}

function postData($url, $data)
{
	/*
	$ch = curl_init();
	$timeout = 300;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$handles = curl_exec($ch);
	curl_close($ch);
	return $handles;
	*/

	return A('Api/YYInfo')->conf($data);
	
}
