<?php

namespace app\index\model;

use think\Model;

/**
 *
 */
class Comment extends Model
{
    //开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $insert     = ['user_id'];
    /**
     * 修改器：设置评论作者
     */
    public function setUserIdAttr()
    {
        return session('user.id');
    }
    /**
     * [author ] 查询评论的作者
     * @return
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
}
