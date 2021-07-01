<?php
namespace ism\lib;

class PasswordEncoder {

    public static function encode(string $password,  $pwd = PASSWORD_DEFAULT){
        return password_hash ($password, $pwd);
    }

    public static function decode(string $password, string $hash):bool{
       return password_verify($password , $hash);
    }
}