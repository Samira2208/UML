<?php
namespace ism\models;
use ism\lib\DateFormat;
use ism\lib\AbstractModel;

class EtudiantModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "etudiant";
        $this->primaryKey = "id";
    }
        public function insertEtu(array $user){
        extract($user);
        $sql = "INSERT INTO etudiant 
        (matriculeEtu,nomEtu,prenomEtu,dateNaissanceEtu,sexeEtu,classeEtu,
        competenceEtu,parcoursEtu)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, [$matricule,$nom,$prenom,DateFormat::createDateEn(),$sexe,$classe,$competence,$avatar,$parcours]);
        return $result["count"] == 0 ? false : true;
    }
    public function showEtuByClasse(string $classe):array{
        $sql="SELECT * FROM $this->tableName WHERE classe=?";
        $result=$this->showEtuByClasse($sql,[$classe],true);
        return $result["count"]==0?[]:$result["data"];
    }

    public function updateEtu(array $user):bool{
        extract($user);
        $sql="UPDATE $this->tableName SET nomETU=? WHERE matriculeEtu=? ";
        $result= $this->persit($sql,[$user],true);
        return $result["count"] == 0 ? true : false;

    }

}