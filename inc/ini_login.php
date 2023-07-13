<?php 
require_once 'ini.php';

if ($request->isPost) {
    $arr = $request->post();
    $user->loadData($arr);
    $user->validateLogin();
    if ($user->validateData()) {
    } elseif ($user->login()) {
        $responce->redirect('index.php', []);
    }
}

