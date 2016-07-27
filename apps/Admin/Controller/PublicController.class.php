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
            $actions = I('get.actions');
            $data['user_id'] = I('post.CompanyID', '');
            $data['title']   = I('post.title', '');
            $data['name']    = I('post.name', '');
            $data['tel']     = I('post.tel', '');
            $data['http_referer'] = I('server.HTTP_REFERER');
            if (empty($data['title'])) {
                $data['title'] = $data['name'].' 的留言';
            }

            if ($actions == 'TWO') { // 模板 2
                $abArr['ab1'] = I('post.ab1', ''); // 选择项目
                $abArr['ab2'] = I('post.ab2', ''); // 对UCC有没有过了解
                $abArr['ab3'] = I('post.ab3', ''); // 您的了解渠道
                $abArr['abr'] = I('post.adr', ''); // 开店意向地址
                $data['content'] = $this->getPostAddTwo($abArr);
            } else {
                $data['email'] = I('post.email', '');
                $data['address'] = I('post.address', '');
                $data['content'] = I('post.content', '');

                $VisitBack = I('post.VisitBack', '');
                if (!empty($VisitBack)) {
                    $data['content'] .= "<br />要求回复时间：" . $VisitBack;
                }
            }
            
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

    public function getPostAddTwo($abArr)
    {
        if (empty($abArr['ab1'])) {
            $this->error('请选择项目！');
        }
        if (empty($abArr['ab2'])) {
            $this->error('请选择对UCC有没有过了解！');
        }
        if (empty($abArr['ab3'])) {
            $this->error('请选择了解渠道！');
        }
        if (empty($abArr['abr'])) {
            $this->error('请输入开店意向地址！');
        }

        return '选择项目:'.$abArr['ab1'].'<br />'.$abArr['ab2'].'<br />'.$abArr['ab3'].'<br />开店意向地址:'.$abArr['abr'];
    }

    public function password($uid=0)
    {
        if (!empty($uid)){
            echo think_encrypt($uid);
        }
    }

}
