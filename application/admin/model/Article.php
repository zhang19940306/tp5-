<?php

namespace app\admin\model;

use think\Model;

/**
 *
 */
class Article extends Model
{

    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
    //执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $insert     = ['admin_id'];
    public function setAdminIdAttr()
    {
        return session('admin.id');
    }
    public function author()
    {

        return $this->belongsTo('Admin', 'admin_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }
    public function getIsOnlineAttr($value)
    {
        $status = [
            0 => "<span class='text-danger'>下线</span>",
            1 => "<span class='text-success'>上线</span>",

        ];
        return $status[$value];
    }
}
