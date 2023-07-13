<?php 
require_once 'inc/ini.php';

if ($user->isAdmin) {
    if($user->request->isPost) {
        if (isset($_POST['date_block']) && isset($_GET['user_id'])) {
            if ($admin->blockUser($user->request->get('user_id'), $user->request->post('date_block'))) {
                $responce->redirect('users.php', []);
            }
        }    
    }
} else {
    $responce->redirect('index.php', []);
}
