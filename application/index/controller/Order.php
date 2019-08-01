<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

/**
 *
 */
class Order extends Controller
{

    public function confirm()
    {
        $pids     = explode('_', input('param.pids'));
        $nums     = explode('_', input('param.nums'));
        $pidnums  = array_combine($pids, $nums);
        $products = [];
        foreach ($pids as $pid) {
            $products[$pid]      = model('Product')->find($pid);
            $products[$pid]->num = $pidnums[$pid];
            $address             = model('UserAddress')->getAddress();

        }
        $this->assign('products', $products);
        $this->assign('address', $address);
        return view();
    }

    public function add()
    {
        $pids       = explode('_', input('param.pids'));
        $nums       = explode('_', input('param.nums'));
        $pidnums    = array_combine($pids, $nums);
        $address_id = input('param.address_id');
        //开启事务
        Db::startTrans();
        $order = [];
        foreach ($pids as $pid) {

            $product = model('Product')->find($pid);

            $order[] = [
                'order_sn'       => 'D' . date('YmdHis') . mt_rand(10000, 100000),
                'user_id'        => session('user.id'),
                'product_id'     => $pid,
                'product_price'  => $product->price,
                'product_number' => $pidnums[$pid],
                'order_amount'   => round($product->price * $pidnums[$pid], 2),
                'address_id'     => $address_id,
                'status'         => 0,
            ];

            //扣除商品的库存
            $r2 = db('Product')->where('id', '=', $pid)->setDec('stock', $pidnums[$pid]);
            if (!$r2) {
                //回滚事务
                Db::rollback();
            }
        }
        //添加订单
        $r1 = model('Order')->saveAll($order);
        if ($r1) {
            //提交事务
            Db::commit();
            $this->success('下单成功');
        } else {
            //回滚事务
            Db::rollback();
            $this->error('下单失败');
        }

    }
    public function index()
    {
        $list = model('Order')->where('user_id', '=', session('user.id'))->order('create_time', 'desc')->paginate(5);
        $this->assign('list', $list);
        return view();
    }
}
