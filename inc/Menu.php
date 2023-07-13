<?php
class Menu 
{
    public $mas;
    public $responce;

    public function __construct($mas, $responce) {
        $this->mas = $mas;
        $this->responce = $responce;
    }

    public function createMenu($name, $echo = '') {
        $url = $this->responce->user->avatar;
        $add = 'class=colorlib-active';
        $echo .= "<aside id='colorlib-aside' role='complementary' class='js-fullheight'>
        <nav id='colorlib-main-menu' role='navigation'><ul>";
        if (!$this->responce->user->isGuest) {
            $echo .= "<li><img src='$url' width='75px' height='75px' style='border-radius: 40px;'>\t" .
            $this->responce->user->login . "</li>";
        }
        foreach ($this->mas as $key => $val) {
            if (!is_array($val)) {
                if ($this->responce->user->isGuest && array_key_last($this->mas) !== $key) {
                    $echo .= "<li><a " . ($val == $name ? $add : '') . " href=" . $this->responce->getLink($val, []) . ">" . $key . "</a></li>";
                } else if (!$this->responce->user->isGuest) {
                    $echo .= "<li><a " . ($val == $name ? $add : '') . " href=" . $this->responce->getLink($val, []) . ">" . $key . "</a></li>";
                }
            } elseif ($this->responce->user->isAdmin && count($val) == 1) {
                foreach($val as $ke => $va) {
                    $echo .= "<li><a " . ($va == $name ? $add : '') . " href=" . $this->responce->getLink($va, []) . ">" . $ke . "</a></li>";
                }
            } elseif ($this->responce->user->isGuest && count($val) > 1) {
                foreach ($val as $k => $v) {
                    if (!(array_key_last($val) == $k)) {
                        $echo .= "<li><a " . ($v == $name ? $add : '') . " href=" . $this->responce->getLink($v, []) . ">" . $k . "</a> /";
                    } else {
                        $echo .= " <a " . ($v == $name ? $add : '') . " href=" . $this->responce->getLink($v, []) . ">" . $k . "</a></li>";
                    }
                }
            } 
        }
        $echo .= "</ul></nav></aside>";
        return $echo;
    }
}