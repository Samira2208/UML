<?php
namespace ism\models;
use ism\lib\DateFormat;
use ism\lib\AbstractModel;

class ProfesseurModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "utilisateur";
        $this->primaryKey = "id";
    }
    public function insertProf(array $user){
        extract($user);
        $sql = "INSERT INTO etudiant 
        (matriculeProf,nomProf,prenomProf,dateNaissanceProf,sexeProf,gradeProf,classeProf,
        moduleProf)
        VALUES 
        (?,?,?,?,?,?,?,?)";
        $result = $this->persit($sql, [$matricule, $nom, $prenom,DateFormat::createDateEn(), $sexe, $classe, $competence, $avatar, $parcours]);
        return $result["count"] == 0 ? false : true;
    }
    
}