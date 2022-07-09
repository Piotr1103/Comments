<?php
namespace app\controller;

use think\Response;

abstract class Base
{
	protected function create($data, $msg='數據請求成功', $code=200, $type='json')
	{
        //標準API數據結構
        $result = [
            //狀態碼
            'code'  => $code,
            //消息
            'msg'   => $msg,
            //數據
            'data'  => $data
        ];

        //返回API接口
        return Response::create($result, $type);
	}
}