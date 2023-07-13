<?php 
require_once 'inc/ini.php';

if ($user->isAdmin) {
    $admin->updateBlock();
    if (isset($_GET['block'])) {
        if ($admin->blockUser($user->request->get('block')) && $admin->deletePosts($user->request->get('block'))) {
            $responce->redirect('users.php', []);
        }
    }
} else {
    $responce->redirect('index.php', []);
}