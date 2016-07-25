<?php
namespace Admin\Model;
use Think\Model;

class MessageModel extends Model {

    /* 模型自动验证 */
    protected $_validate = array(
        array('user_id','checkUserId','参数错误!', self::MUST_VALIDATE, 'callback'), //默认情况下用正则进行验证
        array('tel', '/^[1][0-9]{10}$/', '手机格式不正确!', self::MUST_VALIDATE), // 手机格式不正确
        array('email', '/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/', '邮箱格式不正确!', self::VALUE_VALIDATE), // 邮箱格式不正确
        array('title', '3,50', '标题在3-50字符之间!', self::VALUE_VALIDATE, 'length'), //
        array('name','3,50','请输入正确姓名！',self::MUST_VALIDATE,'length'),
        array('address','5,300','请输入正确地址！',self::VALUE_VALIDATE,'length'),
        array('content','5,1000','请输入正确内容！',self::MUST_VALIDATE,'length'),
    );

    /* 模型自动完成 */
    protected $_auto = array(
        array('add_time', NOW_TIME, self::MODEL_INSERT),
        array('user_id', 'think_decrypt', self::MODEL_BOTH, 'function'),
        array('add_time', NOW_TIME, self::MODEL_INSERT),
        array('add_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('update_time', NOW_TIME),
    );

    /**
     * 检测用户ID是不是正确
     * @param  string $userId 用户加密ID
     * @return boolean          ture，false
     */
    public function checkUserId($user_id){
        if (0 < think_decrypt($user_id)) {
            return true;
        }
        return false;
    }

}