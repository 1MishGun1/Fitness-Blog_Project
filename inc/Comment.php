<?php 
class Comment extends Data
{
    public $comment_id;
    public $posts_id_post;
    public $parent_id;
    public $users_id_user;
    public $message;
    public $create_at;
    public $post;
    public $responce;

    public $validateComment;

    public function __construct($responce, $post) {
        $this->post = $post;
        $this->responce = $responce;
    }

    public function findOne($id = null) {
        $this->posts_id_post = $this->post->post_id;
        if (isset($id)) {
            $q = "Select * From Comments Where comment_id = '$id'";
            $arr = $this->responce->user->mySql->doQuery($q)[0];
            if (!$arr) {
                return false;
            } 
            $this->loadData($arr);
        } 
        $this->users_id_user = $this->responce->user->user_id;
    }

    public function saveComment() {
        $res = false;
        if (isset($this->comment_id)) {
            $query = "Insert into Comments (posts_id_post, parent_id, users_id_user, comment) 
                Values ('$this->posts_id_post', '$this->comment_id' ,'$this->users_id_user', '$this->message')";
        } else {
            $query = "Insert into Comments (posts_id_post, users_id_user, comment) 
            Values ('$this->posts_id_post', '$this->users_id_user', '$this->message')";
        }
        if ($a = $this->responce->user->mySql->query($query)) {
            $res = true;
        }
        return $res;
    }

    public function addBrComment($text) {
        if (mb_strlen($text) <= 75) {
            return $text;
        }
        if (strpos($text, ' ')) {
            $words = explode(' ', $text); 
            $lines = [];
            $currentLine = '';
            foreach ($words as $word) {
                if (mb_strlen($currentLine . $word) <= 75) {
                    $currentLine .= $word . ' ';
                } else {
                    $lines[] = rtrim($currentLine);
                    $currentLine = $word . ' ';
                }
            }
            $lines[] = rtrim($currentLine);
            return implode("<br>", $lines);
        } else {
            $text1 = substr($text, 0, 70);
            $text2 = substr($text, 70);
            return $text1 . "<br>" . $this->addBrComment($text2);
        }
        
    }

    public function getLogin($user_id) {
        $arr = $this->responce->user->mySql->doQuery("Select login From Users Where user_id = '$user_id'");
        if (isset($arr[0]['login'])) {
            return $arr[0]['login'];
        }
    }

    public function validateComment() {
        if ($this->message == "") {
            $this->validateComment = 'Вы не можете отправить пустой комментарий!';
        } 
    }

    public function getCommentInfo($parent = null) {
        if (is_null($parent)) {
            $res = $this->responce->user->mySql->doQuery(
                                    "Select * From Comments 
                                    Where posts_id_post = '{$this->post->post_id}'
                                    AND parent_id IS NULL
                                    Order by create_at DESC");  
        } 
        else {
            $res = $this->responce->user->mySql->doQuery(
                "Select * From Comments 
                Where parent_id = '$parent'
                Order by create_at DESC");
        }
        if (!$res) {
            return false;
        }
        foreach ($res as $key => $val) {
            $arr = $this->responce->user->mySql->doQuery("Select avatar From Users Where user_id = '{$val['users_id_user']}'");
            $mas = $this->responce->user->mySql->doQuery("Select count(parent_id) as count
                                                From Comments
                                                Where parent_id = '{$val['comment_id']}'");
            $res[$key]['avatar'] = $arr[0]['avatar'];
            $res[$key]['countComments'] = $mas[0]['count'];
        }
        return $res;
    }
}