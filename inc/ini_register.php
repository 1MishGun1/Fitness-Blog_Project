<?php 
require_once 'ini.php';

if ($user->request->isPost) {
    $arr = $user->request->post();
    $user->loadData($arr);
    $user->validateResister();
    if ($user->validateData()) {
    } else if ($user->saveImage()) {
        if ($user->save()) {
            $responce->redirect('index.php', []);
        }
    }
}
    