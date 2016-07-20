<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdminController {

    public function index(){
        $this->meta_title = '管理首页';
        $this->display();
    }

}