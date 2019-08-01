<?php

namespace app\index\model;

use think\Model;

/**
 *
 */
class Cart extends Model
{
    protected $autoWriteTimestamp = true;
    protected $insert             = ['user_id'];
    public function setUserIdAttr()
    {
        return session('user.id');
    }
    public function product()
    {
        return $this->belongsTo('Product', 'product_id');
    }
    public function getUserCart($uid)
    {
        return $this->field('id,product_id,number')->where('user_id', '=', $uid)->order('update_time', 'desc')->select();
    }
}
