<?php

namespace app\api\model;

use think\Model;

/**
 *
 */
class Index extends model
{

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
    public function getNav()
    {
        $res    = $this->field('id,pid,title')->where('online', '=', 1)->select();
        $target = [];
        foreach ($res as $t) {
            $target[$t->id] = $t->toArray();
        }
        return $this->renderTree($target);
    }
}
