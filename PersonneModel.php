<?php
namespace ism\models;
use ism\lib\DateFormat;
use ism\lib\AbstractModel;

class PersonneModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "utilisateur";
        $this->primaryKey = "id";
    }

    public function selectUserByLogin(string $login):array{
        $sql= "SELECT * FROM utilisateur 
        WHERE login=?";
        $result=$this->selectBy($sql,[$login],true);
        return $result["count"]==0?[]:$result["data"];
    }
    
    public function loginExiste(string $login):bool{
        $sql= "SELECT * FROM utilisateur WHERE login=:login";
        $result=$this->selectBy($sql,[':login'=>$login],true);
        return $result["count"]==0?false:true;
    }
    public function Delete(string $login):void{
        $sql= "DELETE * FROM utilisateur WHERE login=?";
    }
    

    public function insert(array $user):bool{
        extract($user);
        $sql= "INSERT INTO user 
        (login,password,nom,role,avatar)
        VALUES 
        (?,?,?,?,?)";
        $result=$this->persit($sql,[$login,$password,$nom, $role,$avatar]);
        return $result["count"]==0?false:true;
    }
        public function updateUser(int $id,$data):bool{
            extract($data);
        $sql= "UPDATE `utilisateur` SET `login` =?, nom=?,
        WHERE `id` =$id";
        $result=$this->persit($sql,[$login,$nom]);
        return $result["count"]==0?false:true;
    }


} 
?> 
   