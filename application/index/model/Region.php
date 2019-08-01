<?php

namespace app\index\model;

use think\Model;

/**
 *
 */
class Region extends Model
{

    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = false;

}
