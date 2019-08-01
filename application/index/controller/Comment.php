<?php

namespace app\index\Controller;

use think\Controller;

/**
 *
 */
class Comment extends Controller
{
    public function add()
    {
        $data = input('param.');
        $res  = model('Comment')->save($data);
        if ($res) {
            if ($data['comment_type'] == 'Article') {
                db('Article')->where('id', '=', $data['comment_id'])->setInc('comment_number');
            } else if ($data['comment_type'] == 'Product') {
                db('Product')->where('id', '=', $data['comment_id'])->setInc('comment');
            }
            $this->success('评论成功');
        } else {
            $this->error('评论失败');
        }

    }
}
