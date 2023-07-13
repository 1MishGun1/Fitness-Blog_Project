<?php 
class MySql extends mysqli
{
    public $isConnected = false;

    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
        if (is_null($this->connect_error)) {
            $this->isConnected = true;
        } 
    }

    public function doQuery($code) {
        $result = $this->query($code);
        $assocMas = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $assocMas[] = $row;
            }  
        }     
        return $assocMas;
    }

    public function checkUnique($nameTable, $field, $searchValue) {
        $res = false;
        $text = "Select count(*) as count From $nameTable Where $field = '$searchValue'";
        if ($query = $this->query($text)) {
            $row = $query->fetch_assoc();
            $res = $row['count'] == 0;
        }
        return $res;
    
    }
}
