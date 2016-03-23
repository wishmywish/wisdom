<?php
namespace Mobileweb\Controller;
use Think\Controller;
class ShareController extends Controller {
    function index(){
        set_theme();
        $this->display();
    }
}
