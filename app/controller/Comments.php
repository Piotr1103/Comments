<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;
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
        //$data = CommentsModel::field('uid, content')->paginate(2);
        $data = CommentsModel::field('uid, content')
                ->page($this->page, $this->pageSize)
                ->select();

        if($data->isEmpty()){
            return $this->create($data, '數據不存在', 204);
        }else{
            //改為繼承基類返回數據
            return $this->create($data, '熱騰騰的數據上桌了');
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
        //
        return CommentsModel::where('cid', $id)->select();
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
