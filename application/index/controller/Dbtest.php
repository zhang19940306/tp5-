<?php

namespace app\index\controller;

use think\Db;

class Dbtest
{
    public function index()
    {
        // echo __CLASS__;
        $db = Db::name('user');
        // print_r($db);
    }
    //
    //index/dbtext/insert
    public function insert()
    {
        $db   = Db::table('coding_user');
        $user = ['username' => 'db' . mt_rand(1000, 100000),
            'password'          => md5('abc123'),
            'created_at'        => time(),
            'nick_name'         => '赵亮',
            'user_photo'        => '',
            'updated_at'        => time(),

        ];
        $users = [
            ['username'  => 'db' . mt_rand(1000, 100000),
                'password'   => md5('abc123'),
                'created_at' => time(),
                'nick_name'  => '赵亮',
                'user_photo' => '',
                'updated_at' => time()],
            ['username'  => 'db' . mt_rand(1000, 100000),
                'password'   => md5('abc123'),
                'created_at' => time(),
                'nick_name'  => '张举',
                'user_photo' => '',
                'updated_at' => time()],
            ['username'  => 'db' . mt_rand(1000, 100000),
                'password'   => md5('abc123'),
                'created_at' => time(),
                'nick_name'  => '刘洋',
                'user_photo' => '',
                'updated_at' => time()],
            ['username'  => 'db' . mt_rand(1000, 100000),
                'password'   => md5('abc123'),
                'created_at' => time(),
                'nick_name'  => '马洋',
                'user_photo' => '',
                'updated_at' => time()],
        ];

        $res = $db->insertAll($users);

        echo $res;
    }

    //删除操作
    public function delete()
    {
        // $db = Db::name('user')->delete(4);
        $res = Db::name('user')->delete([5, 6]);
        echo $res;
    }
    //更新操作
    public function update()
    {
        // $data = [
        //     'nick_name'  => '小新',
        //     'updated_at' => time(),
        // ];
        // $res = db('user')->where('id', '=', 2)->update($data);
        $res = db('article')
            ->where('id=1')
            ->setInc('browse_times');
        echo $res;
    }
    //查询操作
    public function select()
    {
        // $user = db('user')->find(2);
        // print_r($user);
        //

        $users = db('user')
            ->field('id,username')
            ->order('created_at', 'desc')
            ->limit(3)
            ->select();

        print_r($users);

    }
}
