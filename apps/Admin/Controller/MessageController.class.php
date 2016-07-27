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

        if (!empty($_REQUEST['CSV'])) {
            $this->indexCsv($map);
            exit();
        } else {
            $list = $this->lists('Message', $map);
            $this->assign('_list', $list);
        }

        $this->display();
    }

    public function indexCsv($map)
    {
        $csv=new \Think\Csv();
        $field = 'message_id,title,name,tel,email,address,content,add_ip,add_time';
        $list = $this->lists('Message', $map, '',$field, false);
        $csv_title=array('ID','留言主题','联系人','联系电话','联系邮箱','联系地址','留言内容','IP','添加时间');
        if (!empty($list)) {
            foreach ($list as $k => &$v) {
                $v['content']  = preg_replace('/<br \/>/', PHP_EOL, $v['content']);
                $v['add_ip']   = long2ip($v['add_ip']);
                $v['add_time'] = time_format($v['add_time']);
            }
        }

        $csv->put_csv($list,$csv_title);
    }

}