<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Request;

class Category extends AdminBase
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model('category')
            ->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $data = input('param.');
        $res  = model('category')
            ->save($data);
        if ($data) {
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
    public function edit($id)
    {

        $res = model('Category')->find($id);
        $this->assign('res', $res);
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
        $res  = model('Category')->isUpdate(true)->save($data);
        if ($res) {
            $this->success('更改成功', url('admin/category/index'));
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
