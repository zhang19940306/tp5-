<?php

namespace app\index\model;

use think\Model;

class Type extends Model
{
    public function getNav()
    {
        $res    = $this->field('id,pid,title')->where('online', '=', 1)->select();
        $target = [];
        foreach ($res as $t) {
            $target[$t->id] = $t->toArray();
        }
        return $this->renderTree($target);
    }
    public function renderTree($target)
    {
        $tree = [];
        foreach ($target as $t) {
            if (isset($target[$t['pid']])) {
                $target[$t['pid']]['_children'][] = &$target[$t['id']];
            } else {
                $tree[] = &$target[$t['id']];
            }
        }
        return $tree;

    }
    public function getID($pid, $target = [])
    {
        $ts = $this->field('id')->where('pid', '=', $pid)->select();
        foreach ($ts as $t) {
            $target[] = $t->id;
            $target   = $this->getID($t->id, $target);
        }

        return $target;
    }

}
