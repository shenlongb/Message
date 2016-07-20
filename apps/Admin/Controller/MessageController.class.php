<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends AdminController {

    public function index(){

        $map['status']  =   array('egt',0);
        $session = session('user_auth');
        $userId  = I('get.user_id',0,'int');
        if ($session['type'] != 2) {
            $map['user_id'] = array('eq',$session['uid']);
        }
        if ($userId) {
            if ($session['type'] == 2) {
                $map['user_id'] = array('eq',$userId);
            }
        }

        $list   = $this->lists('Message', $map);
        $this->assign('_list', $list);

        $this->display();
    }

}