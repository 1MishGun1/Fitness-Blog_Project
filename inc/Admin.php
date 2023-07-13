<?php
class Admin extends User
{
    public $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function deleteComment($id) {
        $res = $this->user->mySql->doQuery("Select comment_id
                                            From Comments
                                            Where parent_id = '$id'");
        if (!$res) {
            $this->user->mySql->query("Delete From Comments Where comment_id = '$id'");
        } else {
            foreach ($res as $k => $v) {
                $this->deleteComment($v['comment_id']);
            }
        }
    }

    public function delComment($id) {
        $q = $this->user->mySql->doQuery("Select comment_id From Comments Where comment_id = '$id'");
        if ($q) {
            $this->deleteComment($id);
            $this->delComment($id);
            return true;
        }
        return false;
    }

    public function updateBlock() {
        $mas = $this->user->mySql->doQuery("Select user_id, is_block, block_time From Users");
        foreach ($mas as $key => $value) {
            if ($value['is_block'] == 1) {
                $id = $value['user_id'];
                if ((new DateTime($value['block_time']))->getTimestamp() < (new DateTime())->getTimestamp()) {
                    $q = $this->user->mySql->query("Update Users
                                            Set is_block = 0, block_time = NULL
                                            Where user_id = '$id'");
                    if ($q) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function deletePosts($id_user, $id_post = null) {
        if (is_null($id_post)) {
            $do = $this->user->mySql->doQuery("Select post_id From Posts Where users_id_user = '$id_user'");
        } else {
            $do = $this->user->mySql->doQuery("Select post_id From Posts Where post_id = '$id_post'");
        }
        if ($do) {
            foreach($do as $k => $v) {
                $this->deleteAllComments($v['post_id']);
            }
            return true; 
        }
        return false;
    }

    public function getUpdateCount($id) {
        $res = $this->user->mySql->doQuery("Select count(comment_id) as kol
                                            From Comments 
                                            Where posts_id_post = '$id'");
        return $res[0]['kol'] == 0;
    }
    
    public function deleteAllComments($id_post) {
        if ($this->getUpdateCount($id_post)) {
            if ($this->user->mySql->query("Delete From Posts Where post_id = '$id_post'")) {
                return true;
            }
        } 
        $a = $this->user->mySql->doQuery("Select comment_id From Comments 
                                            Where posts_id_post = '$id_post' AND parent_id IS NULL");                                  
        foreach($a as $k => $v) {
            $this->deleteComment($v['comment_id']);
        }
        $this->deleteAllComments($id_post);
    }

    public function blockUser($id, $timeBlock = false) {
        if ($timeBlock) {
            $convert = $this->unconvertDate($timeBlock);    
            $text = "Update Users Set block_time = '$convert', is_block = 1 Where user_id = '$id'";
        } else {
            $text = "Update Users Set is_block = 1 Where user_id = '$id'";
        }
        if ($this->user->mySql->query($text)) {
            return true;
        } 
    }
}