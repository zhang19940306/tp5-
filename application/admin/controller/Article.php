<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;

/**
 *
 */
class Article extends AdminBase
{

    public function doEdit()
    {
        $data = input('param.');
        $file = request()->file('subject_picture');
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
                $data['subject_picture'] = $info->getSaveName();
            } else {
                $this->error($file->getError());
            }
        }
        $res = model('article')->isUpdate(true)->save($data);
        if ($res) {
            $this->success('更新成功', url('admin/article/index'));
        } else {
            $this->error('更新失败');
        }

    }
    public function edit()
    {
        $id = input('param.id');

        $data = model('article')
            ->find($id);
        $cs = model('Category')->getCs();
        $this->assign('cs', $cs);
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 删除操作
     * @return [type] [description]
     */
    public function delete()
    {
        $id  = input('param.id');
        $res = db('article')
            ->delete($id);
        if ($res) {
            $this->success('删除成功');
        } else {

            $this->error('删除失败');
        }

    }

    public function add()
    {
        $cs = model('Category')->getCs();
        $this->assign('cs', $cs);

        return $this->fetch();
    }
    public function doAdd()
    {
        $data = input('param.');
        $file = request()->file('subject_picture');
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
                $data['subject_picture'] = $info->getSaveName();
            } else {
                $this->error($file->getError());
            }
        }

        // $data['admin_id'] = 1;

        $res = model('Article')->save($data);
        if ($res) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
    }
    public function index($where = [])
    {
        $c = input('param.');
        // echo $c['subject'];
        if (isset($c['subject']) && !empty($c['subject'])) {
            $where['subject'] = ['like', '%' . $c['subject'] . '%'];
        }
        $res = model('article')
            ->where($where)
            ->order('created_at', 'desc')
            ->limit(5)
            ->paginate(5, false, ['query' => $c]);
        $this->assign('res', $res);
        return $this->fetch();

    }
}
