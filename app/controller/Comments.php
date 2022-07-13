<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;
use think\facade\Validate;
use app\model\Comments as CommentsModel;

class Comments extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = CommentsModel::field('uid, content')
                ->page($this->page, $this->pageSize)
                ->select();

        //改為繼承基類返回數據，判斷是否取得資源
        if($data->isEmpty()){
            return $this->create($data, '數據不存在', 204);
        }else{
            return $this->create($data, '熱騰騰的數據上桌了', 200);
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //使用withoutField函數來排除id字段的獲取
        $data = CommentsModel::withoutField('id')->find($id);

        //檢查參數型別是否是正確
        if(!Validate::isInteger($id)){
            return $this->create([], 'id參數錯誤~', 400);
        }

        //空數據不可用isEmpty方法來判斷，因此需改成empty函數
        if(empty($data)){
            return $this->create([], '數據不存在', 204);
        }else{
            return $this->create($data, '熱騰騰的數據上桌了', 200);
        }
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
