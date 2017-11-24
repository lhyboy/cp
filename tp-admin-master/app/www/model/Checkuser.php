<?php
namespace app\www\model;

use app\common\model\Common;
use think\Db;
use think\Model;

/**

 */
class Checkuser extends Common
{
    //格式化请求参数
    protected function fmtRequest( $request = [] )
    {
        if( empty($request) ) {
            return $request;
        }
        $offset = 0;
        if (isset($request['offset']) && is_numeric($request['offset']) ) {
            $offset = $request['offset'];
            unset($request['offset']);
        }
        $limit = 5;
        if (isset($request['limit']) && is_numeric($request['limit']) ) {
            $limit = $request['limit'];
            unset($request['limit']);
        }
        $ret = [
            'offset'=>$offset,
            'limit'=>$limit,
            'map'=>$request
        ];
        return $ret;
    }
}
