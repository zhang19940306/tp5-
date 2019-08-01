<?php

namespace app\common\controller;

use think\Controller;

/**
 *
 */
class AdminBase extends Controller
{
    /**
     * 初始化内容
     * @return [type] [description]
     */
    protected function _initialize()
    {
        if (!session('?admin')) {
            $this->error('请先登录>>>>>', url('admin/admin/login'));
        }
    }
}
