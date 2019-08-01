<?php

namespace app\admin\model;

use think\Model;

/**
 *
 */
class Admin extends Model
{
    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function role()
    {
        return $this->belongsTo('AdminRole', 'role_id');
    }
    public function getList()
    {
        return $this->order('created_at', 'desc')->paginate(5);
    }
}
