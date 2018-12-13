<?php

namespace app\index\model;

use think\Model;

class Admin extends Model
{
    public function getLoginInfo($data)
    {
        return $data;
    }
}
