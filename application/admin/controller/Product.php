<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Request;

class Product extends AdminBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $data = model('Product')->getList();
        $this->assign('data', $data);

        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $ts = model('Type')->getTree();

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
        $file = request()->file('image');
        if ($file) {
            //执行上传
            $path = ROOT_PATH . 'public/static/upload';
            $info = $file
                ->validate([
                    'ext'  => 'jpg,jpeg,png,gif',
                    'size' => 2048000,
                ])
                ->move($path);
            if ($info) {
                //保存上传路径
                $data['image'] = $info->getSaveName();
            } else {
                $this->error($file->getError());
            }
        }

        $res = model('Product')->save($data);
        if ($res) {
            $this->success('添加成功', url('admin/Product/index'));
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

        $data = model('Product')->find($id);
        $ts   = model('Type')->getTree();
        $this->assign('ts', $ts);
        $this->assign('data', $data);
        return view();
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
        $file = request()->file('image');
        if ($file) {
            //执行上传
            $path = ROOT_PATH . 'public/static/upload';
            $info = $file
                ->validate([
                    'ext'  => 'jpg,jpeg,png,gif',
                    'size' => 2048000,
                ])
                ->move($path);
            if ($info) {
                //保存上传路径
                $data['image'] = $info->getSaveName();
            } else {
                $this->error($file->getError());
            }
        }
        $res = model('Product')->isUpdate(true)->save($data);
        if ($res) {
            $this->success('更新成功', url('admin/product/index'));
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
    public function delete()
    {
        $id  = input('param.id');
        $res = db('Product')->delete($id);
        if ($res) {
            $this->success('删除成功', url('admin/product/index'));
        } else {
            $this->error('删除失败');
        }
    }
    public function add()
    {
        $data = input('param.');
        $res  = model('admin')->where('');
    }
}
