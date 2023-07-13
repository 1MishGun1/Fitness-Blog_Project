<?php
class Postt extends Data
{
    public $user;

    public $post_id;
    public $title;
    public $users_id_user;
    public $preview;
    public $content;
    public $create_at;
    public $update_at;
    public $image;

    public $commentCount = 0;

    public $validTitle;
    public $validPreview;
    public $validContent;

    public function __construct($user) {
        $this->user = $user;
        $get = $this->user->request->get();
        if (isset($get['post'])) {
            $this->findOne($get['post']);
        }
    }

    public function validatePost() {
        if (empty($this->title)) {
            $this->validTitle = "Заполните заголовок";
        }
        if (empty($this->preview)) {
            $this->validPreview = "Заполните превью";
        }
        if (empty($this->content)) {
            $this->validContent = "Заполните поле контента";
        }
    }

    public function save() {
        $res = true;
        $content = $this->changeToBr($this->content);
        if (isset($this->post_id)) {
            $res = $this->user->mySql->query("UPDATE Posts SET title = '$this->title', 
                                            preview = '$this->preview', content = '$this->content', 
                                            update_at = NOW(), image = '$this->image' WHERE post_id = '$this->post_id'");
        } else {
            if (!($this->user->mySql->query("Insert into Posts 
                    (title,users_id_user,preview,content,image) 
                    Values ('{$this->title}', '{$this->user->user_id}', '{$this->preview}', '{$content}', '$this->image')"))) {
                        $res = false;
                    }
            $mas = $this->user->mySql->doQuery("Select post_id From Posts Where title = '$this->title'");
            $this->post_id = $mas[0]['post_id'];
        }
        return $res;
    }

    public function findOne($id) {
        $arr = $this->user->mySql->doQuery("Select count(comment_id) as commentCount, 
                                            Posts.* From Posts Join Comments ON Comments.posts_id_post = Posts.post_id 
                                            Where post_id = '$id'");
        if ($arr) {
           $this->loadData($arr[0]); 
        }
    }

    public function getLogin($user_id) {
        $arr = $this->user->mySql->doQuery("Select login From Users Where user_id = '$user_id'");
        if (isset($arr[0]['login'])) {
            return $arr[0]['login'];
        }
    }

    public function doPostList($kol = null) {
        $res = $this->user->mySql->doQuery("Select * From Posts Order by create_at DESC" . 
        (isset($kol) ? " LIMIT $kol" : ""));
        if ($res) {
            foreach ($res as $key => $val) {
                $mas = $this->user->mySql->doQuery("Select count(comment_id) as count
                                                    From Comments
                                                    Where posts_id_post = '{$val['post_id']}'");
                $res[$key]['countPost'] = $mas[0]['count'];
            }
            return $res;
        }
        return false;
    }

    public function get10LastPosts() {
        return $this->doPostList(10);
    }

    public function saveImage() {
        if ($_FILES["image"]['name'] !== "") {
            $tmp_name = $_FILES["image"]["tmp_name"];
            $this->image = "images/" . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($tmp_name, $this->image)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
