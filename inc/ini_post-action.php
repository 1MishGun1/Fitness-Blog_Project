<?php 
require_once 'inc/ini.php';

if ($request->isPost && !$user->isGuest && !$user->isAdmin) {
    $arr = $request->post();
    $post->loadData($arr);
    $post->validatePost();
    if (!$post->validateData() && $post->saveImage()) {
        if ($post->save()) {
            $responce->redirect('post.php', ['post' => $post->post_id]);
        }
    }
} 