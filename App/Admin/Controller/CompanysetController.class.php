<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanysetController
 *
 * @author Administrator
 */

namespace Admin\Controller;
use Think\Controller;
class CompanysetController extends CommonController {
    /**
     * 企业设置
     */
     public function index(){

         //获取行业分类
         $industry = A("Api/Jhttp")->getIndustry();
         $industry_arr = json_decode($industry,true);
//         var_dump($industry_arr);exit;


         //获取已有的企业设置信息
         $companyId = empty(cookie("companyId"))?session("companyId"):cookie("companyId");
//         var_dump($companyId);
         $companyInfo = A("Api/Jhttp")->getCompanyInfo($companyId);
         $companyInfo_arr = json_decode($companyInfo,true);
         $business_licence='';
         $core_logo='';
         $prod_licence='';
         $food_per='';
         $san_license='';
         $com_fiels=$companyInfo_arr['list'];
         if($com_fiels){
             if($com_fiels["taxRegCertificate"]!=null){
                 $business_licence=M("files")->where("f_id=".$com_fiels["taxRegCertificate"])->find();
             }

             if($com_fiels["companyLogo"]!=null){
                 $core_logo=M("files")->where("f_id=".$com_fiels["companyLogo"])->find();
             }

             if($com_fiels["productionLicense"]!=null){
                 $prod_licence=M("files")->where("f_id=".$com_fiels["productionLicense"])->find();
             }

             if($com_fiels["foodDistribLicense"]!=null){
                 $food_per=M("files")->where("f_id=".$com_fiels["foodDistribLicense"])->find();
             }

             if($com_fiels["hygieneLicense"]!=null){
                 $san_license=M("files")->where("f_id=".$com_fiels["hygieneLicense"])->find();
             }

         }

         $this->assign("business_licence",$business_licence);
         $this->assign("core_logo",$core_logo);
         $this->assign("prod_licence",$prod_licence);
         $this->assign("food_per",$food_per);
         $this->assign("san_license",$san_license);
         $this->assign("cInfo",$companyInfo_arr['list']);
         $this->assign("industry",$industry_arr['list']);
         $this->display();
    }
}
