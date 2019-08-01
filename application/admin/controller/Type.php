<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Request;

class Type extends AdminBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $ts = model('type')->getTree();
        $this->assign('ts', $ts);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $ts = model('type')->getTree();
        $this->assign('ts', $ts);
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('param.');

        $res = model('type')->save($data);
        if ($res) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
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
    public function edit()
    {

        $id   = input('param.id');
        $data = model('type')->find($id);
        $ts   = model('type')->getTree();

        $this->assign('data', $data);
        $this->assign('ts', $ts);
        return $this->fetch();
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

        $data = input('param.');
        $res  = model('type')->isUpdate(true)->save($data);
        if ($res) {
            $this->success('更新成功', url('admin/type/index'));
        } else {
            $this->error('更新失败');
        }
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
