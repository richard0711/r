<?php

class UserLib {
    
    public function userValidate($data = array()) {
        //params check
        if (!isset($data["username"]) || $data["username"] == '') {
            throw new Exception("Felhasználó név megadása kötelező!", 500);
        }
        if (!isset($data["password"]) || $data["password"] == '') {
            throw new Exception("Jelszó megadása kötelező!", 500);
        }
        if (!isset($data["system"]) || $data["system"] == '') {
            throw new Exception("Hiányzó rendszer azonosító!", 500);
        }
        //user email check
        $User = new User();    
        $user_data = $User->get_users_by_filters(array(
            "email" => $data["username"],
            "active" => 1,
            "system" => $data["system"]
        ));    
        if ($user_data["count"] == 0) {
            throw new Exception("Nem regisztrált felhasználó!", 500);
        } else {
            $user_data = $user_data["data"][0];
        }    
        //user password check
        $enc_password = $this->getEncodedPassword($data["password"], $user_data["salt"]);
        $UserPassword = new UserPassword();
        $user_password_data = $UserPassword->get_user_password_by_filters(array(
            "iduser" => $user_data["iduser"],
            "valid" => date("Y-m-d"),
            "password" => $enc_password["enc_pass"],
            "system" => $data["system"]
        ));
        if ($user_password_data["count"] == 0) {
            throw new Exception("Hibás felhasználónév / jelszó!", 500);
        } else {
            $user_password_data = $user_password_data["data"][0];
        } 
        return $user_data;
    }
    
    public function tokenValidate($Token_str = '', $System = '') {
        log_message('debug', 'tokenValidate Token_str ' . print_r($Token_str, true));
        log_message('debug', 'tokenValidate System ' . print_r($System, true));
        //params check
        if (isset($_COOKIE[config_item('cookie_prefix') . 'Token'])) {
            $Token_str = $_COOKIE[config_item('cookie_prefix') . 'Token'];
        }
        if (!isset($Token_str) || $Token_str == '') {
            throw new Exception("Hozzáférés megtagadva!", 403);
        }
        if (!isset($System) || $System == '') {
            throw new Exception("Hozzáférés megtagadva!", 403);
        }
        //token check
        $Token = new Token();    
        $token_data = $Token->get_token_by_filters(array(
            "token" => $Token_str,
            "system" => $System
        ));    
        if ($token_data["count"] == 0) {
            throw new Exception("Hozzáférés megtagadva!", 403);
        } else {
            $token_data = $token_data["data"][0];
        }    
        $User = new User();
        $user_data = $User->get($token_data["iduser"], true);
        if (count($user_data) == 0) {
            throw new Exception("Hozzáférés megtagadva!", 403);
        }
        $user_data["token"] = $Token_str;
        $user_data["idtoken"] = $token_data["idtoken"];
        return $user_data;
    }
    
    public function getEncodedPassword($password = '', $salt = '') {
        if (strlen(trim($salt)) == 0) {
            $salt = md5(uniqid(rand(), true));
        }
        $enc_pass = hash('sha256', $salt . $password);
        return array("passwd" => $password, "salt" => $salt, "enc_pass" => $enc_pass);
    }
    
    public function setToken($user = array()) {
        //gen token
        $Token = new Token();
        $token_data = array(
            "iduser_system" => $user["iduser_system"],
            "token" => md5(strftime('%Y%m%d%H%M%S')),
            "created" => date("Y-m-d H:i:s"),
            "status" => 1
        );
        $Token->insert($token_data);
        //setcookie
        $this->setCookieByParams('Token', $token_data["token"]);
        return $token_data["token"];
    }
    
    public function delToken($token = array()) {
        //del token
        $Token = new Token();
        $token_data = array(
            "status" => 0
        );
        $Token->update($token["idtoken"], $token_data);
        //setcookie
        $this->delCookieByParams('Token');
        return true;
    }
    
    /**
     * set cookie by passed params
     * @param string $name 
     * @param string $val 
     * @param time $expire default to one year
     */
    public function setCookieByParams($name, $val, $expire = null) {
        setcookie(config_item('cookie_prefix').$name, $val, ($expire) ? $expire : (time() + (10 * 365 * 24 * 60 * 60)), config_item('cookie_path'), "", false);
    }
    
    public function delCookieByParams($name) {
        setcookie(config_item('cookie_prefix').$name, '', time() - 3600);
    }
    
}
