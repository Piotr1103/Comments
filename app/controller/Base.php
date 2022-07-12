<?php
namespace app\controller;

use think\Response;
use think\facade\Request;

abstract class Base
{
    protected $page;
    protected $pageSize;

    public function __construct()
    {
        //預設參數透過config助手函數從config\app.php中取得自行定義的參數
        $this->page = (int)Request::param('page', config('app.page'));
        $this->pageSize = (int)Request::param('page_size', config('app.page_size'));
    }

	protected function create($data, string $msg='數據請求成功', int $code=200, string $type='json'):Response
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

    //繼承控制器內部方法不存在時返回的API數據
    public function __call($name, $arguments)
    {
        return $this->create([], '方法不存在~', 404);
    }
}