<?php

namespace app\api\model;

use think\Model;

/**
 * 接口模块的商品模型
 */
class Product extends Model
{
    protected $autoWriteTimestamp = true;
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
        return $this->where($where)->order('create_time', 'desc')->paginate(10, ['query' => $c]);
    }
}
