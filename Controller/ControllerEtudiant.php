<?php
require_once 'Model/Etudiant.php'; 
require_once 'Model/EtudiantTransaction.php';
require_once 'View/view.php'; 

class ControllerEtudiant{
    private $etudiant;
    private $etudiantTransaction;

public function __construct(){
$this->etudiant = new Etudiant();
$this->etudiantTransaction= new EtudiantTransaction();
}


public function getEtus() {
    $etudiants = $this->etudiantTransaction->getAll(); 
    $view = new view("Etudiant"); 
    $view->generer(array('etudiants' => $etudiants));
}


public function addE() {
     
    
    $view = new view("AddEtudiant");        
    $view->generer(array());
} 


public function saveE() {    
    $etudiant=$this->etudiant =new Etudiant($_POST['nom'],$_POST['prenom'],$_POST['age'],$_POST['cne']) ;
    $this->etudiantTransaction->save($this->etudiant);
    getEtus();
}


public function deleteE(){
    $this->etudiantTransaction->delete($_POST['cne_delete']);
}


public function updateE($cne){
    $this->etudiantTransaction->update($cne);
}
public function getOne($cne) {
   $row = $this->etudiantTransaction->getrow($cne); 
   $view = new view("Update"); 
   $view->generer(array('row' => $row));
} 
}
?>