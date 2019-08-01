<?php

namespace app\index\controller;

use think\Controller;

/**
 *
 */
class Cart extends Controller
{
    public function add()
    {
        $data = input('param.');
        $f    = db('Cart')->where('id', '=', session('user.id'))->where('product_id', '=', $data['product_id'])->count();
        if ($f) {
            $res = db('Cart')->where('id', '=', session('user.id'))->where('product_id', '=', $data['product_id'])->setInc('number', $data['number']);
            if ($res) {

                return json(1);
            } else {
                return json(0);
            }
        } else {
            $res = model('Cart')->save($data);
            if ($res) {

                return json(1);
            } else {
                return json(0);
            }
        }

        return view();
    }
    public function index()
    {
        if (session('?user')) {
            $res = model('Cart')->getUserCart(session('user.id'));
            $this->assign('res', $res);
            return view();
        } else {
            $this->error('请先登录', url('index/user/login'));
        }

    }
    public function delete($id)
    {
        $id   = input('param.id');
        $data = model('Cart')->where('id', $id)->delete();
        if ($data) {
            $this->success('删除成功', url('index/cart/index'));
        } else {
            $this->error('删除失败');
        }

    }
}
