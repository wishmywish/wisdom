<?php
/**
 * 数据库对接 of SqlModel
 *
 * @author LuoQQ
 */
namespace Api\Model;
use Think\Model;
class TalkModel extends Model {
    protected $tableName = 'talk';

    //============================添加聊天内容==============================================
    public function addTalk($dealerid,$userid,$companyid,$content,$time,$tindexid) {
        $t = M('talk');
        $map['f_dealerid'] = $dealerid;
        $map['f_userid'] = $userid;
        $map['f_companyid'] = $companyid;
        $map['f_content'] = $content;
        $map['f_datetime'] = $time;
        //pt($map);
        //exit;
        if($tindexid=="0" || $tindexid==0){
            return $t->add($map);
        }else{
            $t->where('f_indexid='.$tindexid)->save($map);
            return $tindexid;
        }
    }

    //============================删除聊天内容==============================================
     
    public function deleteTalk($indexId){
        $t = M('talk');
        $map['f_status']='0';
        return $t->where('f_indexid='.$indexId)->save($map);
    }


}
