<?php
namespace app\index\controller;

use think\Controller;
use think\validate;

class User extends Controller
{
    public function register()
    {
        return $this->fetch();
    }
    public function doRegister()
    {

        $data = input('param.');
        if (!captcha_check($data['captcha'])) {
            $this->error('验证码错误');
        }

        // // 验证器
        // // 验证规则
        // $rule = ['username' => 'require|length:2,30|unique:user', 'password' => 'require|min:6', 'repassword' => 'require|confirm:password'];
        // //报错信息
        // $message = ['username.require' => '用户名不能为空', 'username.length' => '用户长度不正确(2-30位)', 'username.unique' => '用户已经存在', 'password.require' => '密码不能为空', 'password.min' => '密码最短是6位', 'repassword.require' => '确认密码不能为空', 'repassword.confirm' => '两次密码不一致'];
        // $v       = new validate($rule, $message);
        //使用助手函数获取验证器对象
        $v = validate('User');
        if (!$v->check($data)) {
            $this->error($v->getError());
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
            $this->success('注册成功');
        } else {
            $this->error('注册失败');
        }

    }
    public function login()
    {
        return $this->fetch();
    }
    public function doLogin()
    {

        $data = input('param.');
        if (!captcha_check($data['captcha'])) {
            $this->error('验证码错误');

        }
        $user = db('user')
            ->field('id,username')
            ->where('username', '=', $data['username'])
            ->where('password', '=', md5($data['password']))
            ->find();
        if ($user) {
            session('user', $user);
            $this->success('登录成功', url('index/index/index'));
        } else {
            $this->error('登录失败');
        }

    }
    public function logout()
    {
        session('user', null);
        return $this->redirect('index/article/index');
    }
    public function center()
    {
        $user = model('User')->find(session('user.id'));
        $this->assign('user', $user);
        return view();
    }

}
