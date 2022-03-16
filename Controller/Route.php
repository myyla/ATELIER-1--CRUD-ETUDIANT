<?php
 require_once 'Controller/ControllerEtudiant.php'; 
 require_once 'View/view.php';

 class  Route{

 private $ctrlEtudiant;

 public function __construct() {
    $this->ctrlEtudiant = new ControllerEtudiant(); 
}


public function routeRequete() { 
     
try {
        if (isset($_GET['action'])) 
        {

                if ($_GET['action'] == 'etudiant') {
                            $this->ctrlEtudiant->getEtus(); 
                }
                else if($_GET['action'] == 'add'){

                $this->ctrlEtudiant->addE(); 

               } else if($_GET['action'] == 'save'){
               //var_dump($_POST);
               //exit;
               $this->ctrlEtudiant->saveE(); 
        
               }else if($_GET['action'] == 'delete'){
               //var_dump($_POST);
               //exit;
               $this->ctrlEtudiant->deleteE();
               }
               else if($_GET['action'] == 'update'){
               //var_dump($_POST); 
               //exit;
               $this->ctrlEtudiant->updateE($_POST['old_cne']);
               }
               else if($_GET['action'] == 'getrow'){
               //var_dump($_POST);
               //exit;
                $this->ctrlEtudiant->getOne($_POST['cne_update']);
        }
        else{
            throw new Exception("Action non valide");
        } 
    }
}
catch (Exception $e) {

        $this->erreur($e->getMessage()); 
}
 }
   // Affiche une erreur
 private function erreur($msgErreur) {

 $view = new view("Error"); 
 $view->generer(array('msgErreur' => $msgErreur));

 } 

}