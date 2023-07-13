<?php
class Request 
{
    public $isPost;
    public $isGet;

    public function __construct() {
        $this->isPost = $_SERVER["REQUEST_METHOD"] == "POST";
        $this->isGet = $_SERVER["REQUEST_METHOD"] == "GET";
    }

    public function clearInput($parameter) {
        return trim(strip_tags($parameter));
    }

    public function clearArray($arr) {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $arr[$key] = $this->clearArray($val);
            }
            $arr[$key] = $this->clearInput($val);
        }
        return $arr;
    }

    public function post($parameter = null) {
        if (is_null($parameter)) {
            return $this->clearArray($_POST);
        } else {
            return $this->clearInput($_POST[$parameter]);
        }
    }

    public function get($parameter = null) {
        if (is_null($parameter)) {
            return $this->clearArray($_GET);
        } else {
            return $this->clearInput($_GET[$parameter]);
        }
    }

    public function hostRequest() {
        return $_SERVER['HTTP_HOST'];
    }

    public function getToken() {
        if (isset($_GET["token"])) {
            return $_GET["token"];
        }
        return null;
    }
}
