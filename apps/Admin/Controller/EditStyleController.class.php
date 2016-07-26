<?php
namespace Admin\Controller;
use Think\Controller;
class EditStyleController extends Controller {

    public function web(){

        $name = I('name','one');

        $this->assign('CompanyID', I('get.CompanyID'));
        $this->display('web_'.$name);
    }

    public function mobile(){

        $name = I('name','one');
//        $this->assign('HTTP_HOST', I('server.HTTP_HOST'));
        $this->assign('CompanyID', I('get.CompanyID'));
        $this->display('mobile_'.$name);
    }

}