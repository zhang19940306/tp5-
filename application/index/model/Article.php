<?php

namespace app\index\model;

use think\Model;

/**
 * author 马洋
 *
 */
class Article extends Model
{
// 开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    // 查看文章作者
    public function author()
    {

        return $this->belongsTo('Admin', 'admin_id', 'id');
    }
    public function articleNum()
    {
        return $this->hasMany('Article', 'category_id')->count();
    }
    public function comments()
    {
        return $this->morphMany('Comment', ['comment_type', 'comment_id'], 'Article')->field('id,user_id,comment,created_at')->order('created_at', 'desc')->paginate(4);
    }
}
