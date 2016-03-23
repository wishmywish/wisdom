<?php
namespace Manage\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        set_theme();//载入主题
        $this->display();
    }
}