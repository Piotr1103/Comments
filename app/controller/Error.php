<?php
declare (strict_types = 1);

namespace app\controller;

//繼承類中不可重複引用在父類中已引用的模塊

//當控制器不存在時的攔截方法
class Error extends Base
{
    public function index()
    {
        //404
        return $this->create([], '資源不存在~', 404);
    }
}
