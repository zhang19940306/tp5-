<?php

namespace app\api\controller;

use Endroid\QrCode\QrCode;
use think\Controller;

class Index extends Controller
{
    public function index()
    {

        $data        = model('Product')->getSlide();
        $product_nav = model('Type')->getNav();
        $new         = model('Product')->getHomeNewest();
        $hotext      = model('Product')->getHomeHotest();
        $this->assign('hotext', $hotext);
        $this->assign('new', $new);
        $this->assign('product_nav', $product_nav);
        $this->assign('data', $data);
        return json($data, $product_na, $new, $hotext);
    }

    public function think()
    {
        $hi    = "hello word";
        $user  = ['username' => '赵亮', 'created' => time()];
        $users = [['username' => '赵亮', 'created' => time()], ['username' => '张举', 'created' => time()], ['username' => '刘杨', 'created' => time()]];
        $obj   = json_decode(json_encode($user));
        $this->assign('hello', $hi);
        $this->assign('user', $user);
        $this->assign('obj', $obj);
        $this->assign(['hello' => $hi,
            'user'                 => $user,
            'obj'                  => $obj,
            'users'                => $users]);
        return $this->fetch();
    }
    public function erwima()
    {
        $url = "
BEGIN:VCARD
VERSION:2.1
N:Gump;Forrest
FN:Forrest Gump
ORG:Gump Shrimp Co.
TITLE:Shrimp Man
TEL;WORK;VOICE:(111) 555-1212
TEL;HOME;VOICE:(404) 555-1212
ADR;WORK:;;100 Waters Edge;Baytown;LA;30314;United States of America
LABEL;WORK;ENCODING=QUOTED-PRINTABLE:100 Waters Edge=0D=0ABaytown, LA 30314=0D=0AUnited States of America
ADR;HOME:;;42 Plantation St.;Baytown;LA;30314;United States of America
LABEL;HOME;ENCODING=QUOTED-PRINTABLE:42 Plantation St.=0D=0ABaytown, LA 30314=0D=0AUnited States of America
EMAIL;PREF;INTERNET:forrestgump@walladalla.com
REV:20080424T195243Z
END:VCARD";
        $qrcode = new QrCode($url);
        header("Content-type:" . $qrcode->getContentType());
        echo $qrcode->writeString();
        exit;
    }
}
