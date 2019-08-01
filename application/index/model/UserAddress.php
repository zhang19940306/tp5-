<?php

namespace app\index\model;

use think\Model;

/**
 *
 */
class UserAddress extends Model
{
    protected $autoWriteTimestamp = true;
    protected $insert             = ['user_id'];
    public function setUserIdAttr()
    {
        return session('user.id');
    }
    public function getAddress()
    {
        return $this->where('user_id', '=', session('user.id'))->order('create_time', 'desc')->select();
    }
    public function province()
    {
        return $this->belongsTo('Region', 'province_id');
    }
    public function city()
    {
        return $this->belongsTo('Region', 'city_id');
    }
    public function district()
    {
        return $this->belongsTo('Region', 'district_id');
    }
}
