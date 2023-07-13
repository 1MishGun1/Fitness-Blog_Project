<?php
class Responce
{
    public $user;

    public function __construct($user) { 
        $this->user = $user;
        if ($this->user->request->getToken() && $this->user->isGuest) {
            $this->redirect('index.php', []);
        }
    }

    public function getLink($url, $mas) {
        if ($url == '#') {
            return $this->getLink('index.php', ['logout' => 'true']);
        }
        if (!$this->user->isGuest && empty($mas['token'])) {
            $mas['token'] = $this->user->token;
        }
        if ($mas && strpos($url,'?') === false) {
            $url .= '?';
        }
        foreach ($mas as $key => $val) {
            $url .= "$key=$val&";
        }
        return $url;
    }

    public function redirect($url, $mas) {
        $path = 'http://' . $this->user->request->hostRequest();
        $path .= rtrim(dirname($_SERVER["PHP_SELF"])) . "/" . $this->getLink($url, $mas);
        header("location: $path");
        exit();
    }


}