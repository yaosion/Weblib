<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
class Admin extends Controller
{
    public function login()
    {
        return  $this->fetch();
    }
}
