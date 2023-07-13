<?php 
require_once 'inc/ini.php';

if ($request->isPost && !$user->isGuest) {
    $comment->findOne($request->get('comment'));
    $mas = $request->post();
    $comment->loadData($mas);
    $comment->validateComment();
    if ($comment->validateData()) {
    } elseif ($comment->saveComment()) {
        $responce->redirect('post.php', ['post' => $comment->posts_id_post]);
    }
}
