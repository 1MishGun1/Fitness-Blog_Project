<?php 
class User extends Data
{
    public $userTableName = "Users";

    public $user_id;
    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $rules;
    public $avatar;

    public $validBlock;
    public $validName;
    public $validSurname;
    public $validLogin;
    public $validEmail;
    public $validPass;
    public $validPass_rep;
    public $validRules;
    public $roles_id_role;

    public $token;
    public $block_time;
    public $is_block;

    public $isAdmin = false;
    public $isGuest = true;

    public $mySql;
    public $request;

    public function __construct($req, $sql) {
        $this->request = $req;
        $this->mySql = $sql;
        if ($this->request->getToken()) {
            $this->identity();
        }
    }

    public function validateResister() {
        if (empty($this->name)) {
            $this->validName = 'Поле имени пустое!';
        }
        if (empty($this->surname)) {
            $this->validSurname = 'Поле фамилии пустое!';
        }
        if (empty($this->login)) {
            $this->validLogin = 'Поле логина пустое!';
        } else if ($this->mySql->doQuery("Select * From Users Where login = '$this->login'")) {
            $this->validLogin = "Такой login уже зарегистрирован!";
        }

        if (empty($this->email)) {
            $this->validEmail ='Поле почты пустое!';
        } else if ($this->mySql->doQuery("Select * From Users Where email = '$this->email'")) {
            $this->validEmail = "Такой email уже зарегистрирован!";
        }

        if (empty($this->password)) {
            $this->validPass = 'Не введён пароль!';
        } else if (strlen($this->password) < 6) {
            $this->validPass = 'Пароль должен быть не менее 6 символов!';
        } 
        if ($this->password_repeat !== $this->password) {
            $this->validPass_rep = 'Пароли не совпадают!';
        }
        if (empty($this->rules)) {
            $this->validRules = 'Необходимо согласиться с правилами регистрации!';
        }
    }

    public function saveImage() {
        if ($_FILES["avatar"]['name'] !== "") {
            $tmp_name = $_FILES["avatar"]["tmp_name"];
            $this->avatar = "images/" . basename($_FILES["avatar"]["name"]);
            if (move_uploaded_file($tmp_name, $this->avatar)) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->avatar = 'images/default.png';
            return true;
        } 
    }

    public function genToken($length = 14) {
        $choose = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $leng = strlen($choose);
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $choose[rand(0, $leng - 1)];
        }
        return $token;
    }

    public function save() {
        $res = false;
        $pass = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "Insert into Users (Name, Surname, Patronymic, Login, Email, Password, Roles_id_role, avatar) 
                  Values ('$this->name', '$this->surname', '$this->patronymic', '$this->login', '$this->email',
                  '$pass', 2, '$this->avatar')";
        if ($this->mySql->query($query)) {
            $res = true;
        }
        return $res;
    } 

    public function validateLogin() {
        $query = $this->mySql->doQuery("Select password From Users Where login = '$this->login'")[0]['password'];
        if (empty($this->login)) {
            $this->validLogin = 'Поле логина пустое';
        } 
        if (empty($this->password)) {
            $this->validPass = 'Поле пароля пустое';
        } else if (!password_verify($this->password, $query)) {
            $this->validPass = 'Неправильный логин или пароль!';
        }
    }

    public function getLogin($id) {
        $login = $this->mySql->doQuery("Select login from Users Where user_id = '$id'")[0]['login'];
        if (isset($login)) {
            return $login;
        }
        return false;
    }

    public function load($data) {
        $this->loadData($data);
        $this->isAdmin();
    }

    public function isAdmin() {
        if ($this->roles_id_role) {
            return $this->isAdmin = $this->getRoleTitle($this->roles_id_role) == 'admin';
        }
    }

    public function getRoleTitle($roleId) {
        return $this->mySql->doQuery("SELECT title FROM roles WHERE role_id = '{$roleId}'")[0]["title"];
    }
    
    public function login() {
        $res = false;
        $que = $this->mySql->doQuery("Select * From $this->userTableName Where login = '$this->login'");
        if ($que) {
            $this->load($que[0]);
            if ($this->is_block) {
                $this->validBlock = "Пользователь заблокирован до " . $this->convertDate($this->block_time);
                return false;
            }
            $token = $this->genToken();
            while (!($this->mySql->checkUnique($this->userTableName, 'token', $token))) {
                $token = $this->genToken();
            }
            $this->isGuest = false;
            $this->token = $token;
            $this->mySql->query("UPDATE $this->userTableName SET token = '$this->token' WHERE user_id = '$this->user_id'");
            if (empty($this->password)) {
                $res = false;
            } else {
                $res = true;
            }
        }
        return $res;
    }

    public function identity($id = false) {
        if ($id) {
            $arr = $this->mySql->doQuery("Select * From $this->userTableName Where user_id = $this->user_id");
        } else {
            $a = $this->request->getToken();
            $arr = $this->mySql->doQuery("Select * From $this->userTableName Where token = '$a'");
        }
        if ($arr) {
            $this->isGuest = false;
            $this->load($arr[0]);
        }
    }

    public function logout() {
        $q = "UPDATE $this->userTableName SET Token = NULL Where token = '$this->token'";
        $this->isGuest = true;
        $this->isAdmin = false;
        if ($this->mySql->query($q)) {
            return true;
        }
        return false;
    }

    public function getUserInfo() {
        if ($res = $this->mySql->doQuery("Select user_id, name, surname, login, email, block_time, is_block From Users Where roles_id_role = 2")) {
            return $res;
        }
        return false;
    }
}
