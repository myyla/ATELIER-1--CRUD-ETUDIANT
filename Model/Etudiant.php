<?php

class Etudiant{

    private $id_Etudiant;
    private $nom;
    private $prenom;
    private $age;
    private $cne;

    public function __construct ( $nom=NULL, $prenom=NULL, $age=NULL , $cne=NULL){

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age =  $age; 
        $this->cne = $cne;
    }


    public function getId() {
        return $this->id_Etudiant; 
    }

    public function getNom() {
        return $this->nom; 
    }

    public function getPrenom() {
        return $this->prenom; 
    }

    public function getAge() {
        return $this->age; 
    }

    public function getCne() {
        return $this->cne; 
    }
}