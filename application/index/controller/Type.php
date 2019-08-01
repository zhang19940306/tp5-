<?php

namespace app\index\controller;

use think\Controller;

/**
 * 商品分类页面
 */
class Type extends Controller
{
    //
    public function read($id)
    {
        $data = model('Type')->find($id);
        $tids = model('Type')->getID($id);
        // 将当前分类id，赋值给$tids
        $tids[] = $id;
        // 根据分类id数组，查询商品信息
        $list = model('Product')->getBy($tids);
        //获取推荐商品
        $list1 = model('Product')->getList($tids);

        $this->assign('list1', $list1);
        $this->assign('list', $list);
        $this->assign('data', $data);

        return view();
    }

}
