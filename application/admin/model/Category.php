<?php

namespace app\admin\model;

use think\Model;

/**
 *
 */
class Category extends Model
{

    # 开启时间的自动完成
    protected $autoWriteTimestamp = true;

    # 指定自动完成的时间字段
    protected $updateTime = 'updated_at';
    protected $createTime = 'created_at';

    public function getCs()
    {

        return $this->field('id,category_name')->order('sort_number', 'desc')->select();
    }
    public function getList()
    {
        return $this->order('sort_number', 'desc')->paginate();
    }
    public function articleNum()
    {
        return $this->hasMany('Article', 'category_id')->count();
    }
}
