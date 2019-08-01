<?php

namespace app\api\model;

use think\Model;

/**
 * 接口模块的商品模型
 */
class User extends Model
{
    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    // 添加场景下自动完成
    protected $insert = ['balance' => 200];

    //修改器 ： set 字段名 Attr
    public function setPasswordAttr($value)
    {
        return md5($value);
    }
}
