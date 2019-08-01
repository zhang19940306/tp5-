<?php

namespace app\api\controller;

use think\Controller;
use think\Validate;

class User extends Controller
{
    /**
     * 接口
     * @return [type] [description]
     */
    public function doregister()
    {
        $data = input('param.');

        // 验证器
        // 验证规则
        $rule = ['username' => 'require|length:2,30|unique:user', 'password' => 'require|min:6', 'repassword' => 'require|confirm:password'];
        //报错信息
        $message = ['username.require' => '用户名不能为空', 'username.length' => '用户长度不正确(2-30位)', 'username.unique' => '用户已经存在', 'password.require' => '密码不能为空', 'password.min' => '密码最短是6位', 'repassword.require' => '确认密码不能为空', 'repassword.confirm' => '两次密码不一致'];
        $v       = new validate($rule, $message);
        // 使用助手函数获取验证器对象

        if (!$v->check($data)) {
            // $this->error($v->getError());
            return json($v->getError(), 3001);
        }

        $file = request()->file('user_photo');
        if ($file) {
            //执行上传
            $path = ROOT_PATH . 'public/static/upload';
            $info = $file->move($path);
            if ($info) {
                //保存上传路径
                $data['user_photo'] = $info->getSaveName();
            }
        }

        $array = model('user')
            ->allowField(true)
            ->save($data);
        if ($array) {
            return json(1);
        } else {
            return json(0, 3002);
        }
    }
}
