<?php
require_once 'autoloader.php';
require_once 'config.php';

$mysql = new MySql($connect['host'], $connect['user'], $connect['password'], $connect['database']);
$request = new Request();
$user = new User($request, $mysql);
$responce = new Responce($user);
$menu = new Menu($arr, $responce);
$post = new Postt($user);
$comment = new Comment($responce, $post);
$admin = new Admin($user);

function createCommentsList($comment, $parent = null, $i = 0) {
    $current = '';
    if ($res = $comment->getCommentInfo($parent)) {
        foreach ($res as $key => $value) {
            $id = $res[$key]['comment_id'];
            $text = "<li style='padding-left:" . $i . "px;' class='comment'>
                <div class='vcard bio'>
                    <img height='50px' src='" . $res[$key]['avatar'] ."' alt='Image placeholder'>
                </div>
                <div class='comment-body'>
                <div class='d-flex justify-content-between'>
                <h3>" . $comment->getLogin($res[$key]['users_id_user']) . "</h3>" .
                ($comment->responce->user->isAdmin ?
                "<a href='" . $comment->responce->getLink('post.php', ['post' => $comment->post->post_id, 'del' => $id]) . "' class='text-danger' style='font-size: 1.8em;' 
                title='Удалить'>🗑</a>" : '') . "</div>
                <div class='meta'>" . $comment->convertDate($res[$key]['create_at'])  . "</div>
                    <p>" . $comment->addBrComment($res[$key]['comment']) . "</p>" .	
                    ($comment->responce->user->user_id !== $res[$key]['users_id_user'] && !$comment->responce->user->isAdmin && !$comment->responce->user->isGuest ? "<p><a href='" . 
                    $comment->responce->getLink('answer.php', ['post' => $comment->post->post_id, 'comment' => $res[$key]['comment_id']]) .
                     "' class='reply'>Ответить</a></p>" : "") .
                "</div>" . ($res[$key]['countComments'] > 0 ? createCommentsList($comment, $id, $i + 40) : '') .
            "</li>";
            $current .= $text;
        }
        return $current;
    }
}
