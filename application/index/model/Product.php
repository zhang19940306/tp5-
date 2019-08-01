<?php

namespace app\index\model;

use think\Model;

class Product extends Model
{
    /**
     * 查询首页轮播图
     * @return [type] [description]
     */

    public function getSlide()
    {
        return $this->field('id,title,image')->where('image', '<>', '')->where('online', '=', 1)->where('recommend', '=', 1)->order('create_time', 'desc')->limit(5)->select();
    }
    public function getHomeNewest($num = 4)
    {
        return $this->field('id,image')->where('image', '<>', '')->where('online', '=', 1)->order('create_time', 'desc')->limit($num)->select();
    }
    public function getHomeHotest($num = 4)
    {
        return $this->field('id,image,title')->where('image', '<>', '')->where('online', '=', 1)->order('view', 'desc')->limit($num)->select();
    }
    public function getBy($tids)
    {
        return $this->field('id,title,image')->where('type_id', 'in', $tids)->where('online', '=', 1)->order('create_time', 'desc')->paginate(8);
    }
    public function getList($tids)
    {

        return $this->field('id,title,image')->where('type_id', 'in', $tids)->where('online', '=', 1)->order('view', 'desc')->limit(3)->select();
    }
    public function comments()
    {
        return $this->morphMany('Comment', ['comment_type', 'comment_id'], 'Product')->field('id,user_id,comment,created_at')->paginate(10);
    }
}
