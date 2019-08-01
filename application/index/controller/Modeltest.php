<?php

namespace app\index\controller;

use app\index\model\User;

class Modeltest
{
    public function index()
    {
        $m1 = new User;
        print_r($m1);

        //函数助手
        $m2 = model('User');
        print_r($m2);
    }
    // 添加数据
    public function insert()
    {
        // 静态方法
        $data = [
            'username'   => 'model_' . mt_rand(1000, 10000),
            'password'   => md5('abc123'),
            'user_photo' => '',
            'nick_name'  => '',
            'updated_at' => time(),
            'created_at' => time(),
        ];
        $res = model('User')->save($data);

        // $res = User::create($data);
        print_r($res);
    }
    // 模型删除数据
    public function delete()
    {
        // 普通方法
        // $u   = User::get(24);
        // $res = $u->delete();

        // $res = User::where('id=23')->delete();

        // 静态方法
        // $res = User::destroy(22);

        $res = User::destroy([11, 21]);
        print_r($res);
    }
    // 模型更新数据
    public function update()
    {
        $data = [
            'id'      => 2,
            'balance' => 200000000,
        ];
        // $res = User::update($data);

        // $res = User::where('id=2')->update(['balance' => 50000000]);

        // $u          = User::get(1);
        // $u->balance = 100000;
        // $res        = $u->save();

        // $u    = User::get(8);
        // $user = [
        //     'balance'    => 100000,
        //     'updated_at' => time(),
        // ];
        // $res = $u->save($user);

        $res = model('User')->save(['balance' => 200000], ['id' => 7]);
        print_r($res);
    }
    // 模型查询数据
    public function select()
    {
        // $user = User::get(2);
        // print_r($user);
        // echo $user->nick_name;
        // print_r($user->toArray());
        // echo ($user->toJson());
        // $res = User::all("1,2,3");
        $res = User::all([1, 2, 3]);
        print_r($res);
    }
}
