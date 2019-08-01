<?php
namespace app\index\controller;

use think\Controller;

class Article extends Controller
{
    public function index()
    {
        $list = model('article')
            ->order('created_at', 'desc')
            ->paginate(5);

        $list1 = model('article')
            ->order('browse_times', 'desc')
            ->limit(5)
            ->select();

        $list2 = model('article')
            ->order('created_at', 'desc')
            ->limit(5)
            ->select();
        $this->assign([
            'list2' => $list2,
            'list1' => $list1,
            'list'  => $list,
        ]);
        return $this->fetch();
    }
    public function read()
    {
        $id = input('param.id');
        // print_r($id);

        $res = model('article')
            ->find($id);

        $list1 = model('article')
            ->order('browse_times', 'desc')
            ->limit(5)
            ->select();

        $list2 = model('article')
            ->order('created_at', 'desc')
            ->limit(5)
            ->select();
        db('article')->where('id', '=', $id)->setInc('browse_times');
        $this->assign('res', $res);
        $this->assign('comments', $res->comments());
        $this->assign('list1', $list1);
        $this->assign('list2', $list2);
        return $this->fetch();

    }
}
