<?php

namespace app\index\model;

use think\Model;

/**
 *
 */
class Order extends Model
{

    protected $autoWriteTimestamp = true;
    public function product()
    {
        return $this->belongsTo('Product', 'product_id');
    }
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
    public function address()
    {
        return $this->belongsTo('UserAddress', 'address_id');
    }
}
