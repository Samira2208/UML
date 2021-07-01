<?php
namespace ism\models;
use ism\lib\AbstractModel;
use ism\lib\DataBase;
use ism\lib\Session;
class UserModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "utilisateur";
        $this->primaryKey = "login";
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

    public function insert(array $user):bool{
        extract($user);
        $sql= "INSERT INTO user 
        (login,password,nom,role,avatar)
        VALUES 
        (?,?,?,?,?)";
        $result=$this->persit($sql,[$login,$password,$nom, $role,$avatar]);
        return $result["count"]==0?false:true;
    }

    public function insertEtu(array $user){
        extract($user);
        $sql = "INSERT INTO etudiant 
        (matriculeEtu,nomEtu,prenomEtu,dateNaissanceEtu,sexeEtu,classeEtu,
        competenceEtu,parcoursEtu)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, [$matricule,$nom,$prenom,$date,$sexe,$classe,$competence,$avatar,$parcours]);
        return $result["count"] == 0 ? false : true;
    }

    public function insertProf(array $user){
        extract($user);
        $sql = "INSERT INTO professeur 
        (matriculeProf,nomProf,prenomProf,dateNaissanceProf,sexeProf,gradeProf,classeProf,
        moduleProf)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, [$matricule, $nom, $prenom, $date, $sexe, $classe, $competence, $avatar, $parcours]);
        return $result["count"] == 0 ? false : true;
    }
    public function delete(string $login){
        $sql = "DELETE FROM utilisateur WHERE login=?
        ";
    }
    public function update(array $user):int{
        $sql = "UPDATE utilisateur SET login = ? , password=? WHERE login = ?";
        extract($user);
        $result=$this->persit($sql , [$login, $password , Session::getSession("user_connect")['login']]);
        return $result["count"] == 0 ? false : true;
    }

    public function insertAC(array $user){
        
    }

    public function insertRP(array $user){
        
    }

}
