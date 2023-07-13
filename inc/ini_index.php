<?php 
require_once 'inc/ini.php';

if (!$user->isGuest && isset($_GET['logout'])) {
    if ($user->logout()) {
        $responce->redirect('index.php', []);
    }
} 