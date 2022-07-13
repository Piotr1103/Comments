<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;
use think\facade\Validate;
use think\exception\ValidateException;
use app\model\Comments as CommentsModel;
use app\validate\Comments as CommentsValidate;

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
        //獲取POST數據
        $data = $request->param();

        try{
            validate(CommentsValidate::class)->batch(true)->check($data);
        }catch(ValidateException $e){
            //需引入think\exception\ValidateException方能取得錯誤內容並加入API數據中
            //Base類定義的msg參數為string，若開啟batch(true)批量錯誤提示則getError返回數組，須將其扁平化為字串
            return $this->create([], implode('|', $e->getError()), 400);
        }

        $id = CommentsModel::create($data)->getData('id');

        if(empty($id)){
            return $this->create([], '寫入失敗~', 400);
        }else{
            return $this->create($id, $id.'寫入成功~', 200);
        }
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
