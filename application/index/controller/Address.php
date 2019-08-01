<?php

namespace app\index\controller;

use think\Controller;

/**
 *
 */
class address extends Controller
{
    public function index()
    {
        $list = model('UserAddress')->getAddress();
        $this->assign('list', $list);
        return view();
    }
    /**
     * 根据父ID返回"省市县"
     * @return [type] [description]
     */
    public function region()
    {
        $parentid = input('param.parentid');
        $res      = db('region')->field('id,name,firstletter')->where('parentid', '=', $parentid)->order('firstletter', 'asc')->select();
        return json($res);
    }
    public function add()
    {
        $data = input('param.');
        $res  = model('UserAddress')->save($data);
        if ($res) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
    }
    public function set($id)
    {
        #将当前用户的所有地址，状态设置为0
        $r = model('UserAddress')->where('user_id', '=', session('user.id'))->setField('status', 0);
        #将当前地址设置为默认
        $res = model('UserAddress')->where('id', '=', $id)->setField('status', 1);
        if ($res) {
            $this->success('设置成功');
        } else {
            $this->error('设置失败');
        }

    }
}
