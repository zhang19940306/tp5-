<?php

namespace app\index\validate;

use think\Validate;

/**
 *
 */
class User extends Validate
{
    // 验证器
    // 验证规则
    protected $rule = ['username' => 'require|length:2,30|unique:user', 'password' => 'require|min:6', 'repassword' => 'require|confirm:password'];
    //报错信息
    protected $message = ['username.require' => '用户名不能为空', 'username.length' => '用户长度不正确(2-30位)', 'username.unique' => '用户已经存在', 'password.require' => '密码不能为空', 'password.min' => '密码最短是6位', 'repassword.require' => '确认密码不能为空', 'repassword.confirm' => '两次密码不一致'];
}
