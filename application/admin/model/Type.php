<?php

namespace app\admin\model;

use think\Model;

class Type extends Model
{
    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
//执行需要自动完成的字段
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    public function getTree($pid = 0, $target = [])
    {
        $ts           = $this->field('*')->where('pid', '=', $pid)->order('sort', 'desc')->select();
        static $level = 1;
        foreach ($ts as $t) {
            $target[$t->id]          = $t->toArray();
            $target[$t->id]['level'] = $level;
            $level++;
            $target = $this->getTree($t->id, $target);
            $level--;
        }
        return $target;

    }
    public function getOnlineAttr($value)
    {
        $status = [
            0 => "<span class='glyphicon glyphicon-remove text-danger'></span>",
            1 => "<span class='glyphicon glyphicon-ok text-success'></span>",
        ];
        return $status[$value];
    }
}
