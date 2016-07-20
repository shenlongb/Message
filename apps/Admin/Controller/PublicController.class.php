<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 申龙彪 <shenlongb@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\Controller;

/**
 * 后台首页控制器
 * @author 申龙彪 <shenlongb@vip.qq.com>
 */
class PublicController extends \Think\Controller {

    /**
     * 后台用户登录
     * @author 申龙彪 <shenlongb@vip.qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            /* 检测验证码 TODO: */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }

            /* 调用接口登录 */
            $uid = D('User')->login($username, $password);
            if(0 < $uid){ //UC登录成功
                $this->success('登录成功！', U('Index/index'));
            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('User')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

    public function getPostAdd()
    {
        if(IS_POST) {
            $data = array();
            $data['user_id'] =  I('post.CompanyID', '');
            $data['title']   =  I('post.title', '');
            $data['name']    =  I('post.name', '');
            $data['tel']     =  I('post.tel', '');
            $data['address'] =  I('post.address', '');
            $data['content'] =  I('post.content', '');

            $Message = D("Message"); // 实例化User对象
            if (!$Message->create($data)){
                $this->error($Message->getError());
                exit();
            }else{
                if (0 < $Message->add()) {
                    $this->success('留言成功！');
                    exit();
                }
                // 验证通过 可以进行其他数据操作
            }
            $this->error('留言失败！');
        }
    }

    public function password($uid=0)
    {
        if (!empty($uid)){
            echo think_encrypt($uid);
        }
    }

}
