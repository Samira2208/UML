<?php
namespace ism\models;
use ism\lib\DateFormat;
use ism\lib\AbstractModel;

class CoursModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "cours";
        $this->primaryKey = "id";
    }
function selectDate():array {
    $sql="SELECT * FROM $this->tableName
    WHERE dateCours=?";
    $result=$this->selectBy($sql);
    return $result["data"];
}
function selectClasse(string $libelleClass):array{
    $sql= "SELECT * FROM professeur 
    WHERE classeProf=? ";
    $result=$this->selectBy($sql,[$libelleClass],true);
    return $result["data"];
   }

function selectProf(string $matriculeProf):array{
    $sql= "SELECT moduleProf FROM professeur 
    WHERE matriculeProf=?";
    $result=$this->selectBy($sql,[$matriculeProf]);
     return $result["data"];
   }

function selectModule(string $libelleCours):array{
    $sql= "SELECT moduleCours FROM professeur
    WHERE moduleProf=?";
    $result=$this->selectBy($sql,[$libelleCours]);
    return $result["data"];

   }

function selectSemestre():array{
    $sql= "SELECT semestreCours FROM cours
    WHERE moduleCours=?";
    $result =$this->selectBy($sql);
    return $result["data"];
    
}
    public function insertCours(array $user):array{
        extract($user);
        $sql= "INSERT INTO $this->tableName 
        (dateCours,classeCours,matriculeProf,moduleCours,semestreCours,nbrHeureCours,heureDebutCours,heureFinCours)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        //$result=$this->persit($sql,[DateFormat::createDateEn(),$classeCours,$matriculeProf,$moduleCours,$semestreCours,$nbrHeureCours,$heureDebutCours,$heureFinCours]);
        return $result["data"];
    }
   
    public function  selectCoursByProf(string $matriculeProf){
        $sql = "SELECT moduleCours FROM  $this->tableName WHERE matriculeProf =?";  
        $result=$this->selectBy($sql, [$matriculeProf], true); 
    } 
    public function selectCoursByClasse(int $classeId):array{
        $sql="SELECT * FROM $this-> tableName t ,classe c WHERE t.classeId =c.idClasse";
        $result =$this->SelectBy($sql,[$classeId], true);
        return $result["data"];
    }
           
    
}
?>