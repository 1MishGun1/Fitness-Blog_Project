<?php 
require_once 'inc/ini.php';

if (isset($_GET['post'])) {
    $post->findOne($user->request->get('post'));
    if ($user->isAdmin || $user->user_id == $post->users_id_user && $post->commentCount == 0) {
        if (isset($_GET['delete'])) {
            $admin->deletePosts($post->users_id_user, $post->post_id);
            $responce->redirect('posts.php', []);
        }
        if (isset($_GET['del'])) {
            if ($admin->delComment($user->request->get('del'))) {
                $responce->redirect('post.php', ['post' => $post->post_id]);
            }
        } 
    }
    
} 

if ($request->isPost && !$user->isGuest) {
    $comment->findOne();
    $mas = $request->post();
    $comment->loadData($mas);
    $comment->validateComment();
    if ($comment->validateData()) {
    } elseif ($comment->saveComment()) {
        $responce->redirect('post.php', ['post' => $comment->posts_id_post]);
    }
}



