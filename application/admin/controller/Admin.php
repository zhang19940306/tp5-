<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Admin extends Controller
{
    protected $beforeActionList = ['checkAdmin' => ['except' => 'login,dologin']];
    public function checkAdmin()
    {
        if (!session('?admin')) {
            $this->error('请登录>>>', url('admin/admin/login'));
        }
    }
    public function logout()
    {
        session('admin', null);
        return $this->redirect('admin/admin/login');
    }
    public function doLogin()
    {

        $data = input('param.');
        if (!captcha_check($data['captcha'])) {
            $this->error('验证码错误');
        }
        $admin = db('admin')
            ->where('username', '=', $data['username'])
            ->where('password', '=', md5($data['password']))
            ->find();
        if ($admin) {
            session('admin', $admin);
            $this->success('登录成功', url('admin/index/index'));
        } else {
            $this->error('登录失败');
        }
    }

    public function login()
    {

        // return $this->fetch();
        return view();
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model('admin')

            ->getList();

        $this->assign('data', $data);
        return view();
    }

    /**
     * 显示创建资源表单页
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
