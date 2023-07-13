<?php 
class Data
{
    public function validateData() {
        foreach (get_object_vars($this) as $key => $val) {
            if (is_string($val)) {
                if (strpos($key, 'valid') !== false && $val !== '') {
                    return true;
                }  
            }
        }
        return false;
    }

    public function loadData($arr) {
        foreach ($arr as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function changeToBr($str) {
        return preg_replace("/\v+|\\\r\\\n/ui",'<br>', $str);
    }

    public function changeToRn($str) {
        return preg_replace("/<br>/ui", "\r\n", $str);
    }

    public function convertDate($date) {
        $dateTime = DateTime::createFromFormat("Y-m-d H:i:s", $date);
        return $dateTime->format('d.m.Y H:i:s');
    }

    public function unconvertDate($date) {
        $dateTime = DateTime::createFromFormat('d.m.Y H:i:s', $date . ':00');
        return $dateTime->format("Y-m-d H:i:s");
    }

}