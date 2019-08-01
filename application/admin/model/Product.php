<?php

namespace app\admin\model;

use think\Model;

class Product extends Model
{
    // 开启时间自动完成
    protected $autoWriteTimestamp = true;
    //执行需要自动完成的字段
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    protected $insert = ['view' => 1, 'admin_id'];
    public function setAdminIdAttr()
    {
        return session('admin.id');
    }
    public function getList($where = [])
    {
        $c = input('param.');
        if (isset($c['title']) && !empty($c['title'])) {
            $where['title'] = ['like', '%' . $c['title'] . '%'];
        }
        if (isset($c['recommend']) && is_numeric($c['recommend'])) {
            $where['recommend'] = ['=', $c['recommend']];
        }
        if (isset($c['online']) && is_numeric($c['online'])) {
            $where['online'] = ['=', $c['online']];
        }
        if (isset($c['min']) && is_numeric($c['min']) && $c['min'] > 0 && isset($c['max']) && is_numeric($c['max']) && $c['max'] > 0 && $c['min'] <= $c['max']) {
            $where['price'] = ['between', [$c['min'], $c['max']]];
        } else if (isset($c['min']) && is_numeric($c['min']) && $c['min'] > 0 && empty($c['max'])) {
            $where['price'] = ['>=', $c['min']];
        } else if (isset($c['max']) && is_numeric($c['max']) && $c['max'] && $c['max'] > 0 && empty($c[min])) {
            $where['price'] = ['<=', $c['max']];
        }
        return $this->where($where)->order('create_time', 'desc')->paginate(5);
    }
    public function author()
    {

        return $this->belongsTo('Admin', 'admin_id');
    }
    public function type()
    {
        return $this->belongsTo('type', 'type_id');
    }
    public function getOnlineAttr($value)
    {
        $status = [
            0 => "<span class='text-danger'>下线</span>",
            1 => "<span class='text-success'>上线</span>",

        ];
        return $status[$value];
    }
    public function getRecommendAttr($value)
    {
        $status = [
            0 => "<span class='glyphicon glyphicon-remove text-danger'></span>",
            1 => "<span class='glyphicon glyphicon-ok text-success'></span>",
        ];
        return $status[$value];
    }
    public function getTree($type_id = 0, $target = [])
    {
        $ts           = $this->field('*')->where('type_id', '=', $type_id)->order('update_time', 'desc')->select();
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

}
