<?php
require_once "Etudiant.php";

class EtudiantTransaction{

    private $db;    // Instance de PDO
  
    public function __construct(){
        try
        {
          $this->db= new PDO('mysql:host=localhost;dbname=crud;charset=utf8', 'root', '');
        }
        catch(Exception $e) {
            die('Erreur : '.$e->getMessage()); 
        }      
    }

    // POUR L'Ajout d'un Etudiant
    public function save($etudiant){

        $q= $this->db->prepare('INSERT INTO etudiant(nom, prenom,age,cne ) VALUES(:nom, :prenom, :age,:cne)');
      
        $q->bindValue(':nom', $etudiant->getNom()); 
        $q->bindValue(':prenom', $etudiant->getPrenom() ); 
        $q->bindValue(':age', $etudiant->getAge(), PDO::PARAM_INT);
        $q->bindValue(':cne', $etudiant->getCne());
        $q->execute();
       
        header('Location: http://localhost/CRUD-ETUDIANT/index.php?action=etudiant');
    }

    //POUR LA SUPPRESSION 
    public function delete($cne){
      $q=$this->db->prepare("DELETE FROM etudiant WHERE cne=:cne");
      $q->execute(array('cne'=>$cne));

      header('Location: http://localhost/CRUD-ETUDIANT/index.php?action=etudiant');
    }

     //POUR LA MODIFICATION
     public function update($cne){
        $q=$this->db->prepare("UPDATE etudiant SET nom=:nom,prenom=:prenom,age=:age,cne=:cne WHERE cne=:old_cne");
    
        $q->execute(array( 'nom' =>$_POST['nom'],
        'prenom' => $_POST['prenom'],
        'age' => $_POST['age'],
        'cne'=>$_POST['cne'],
        'old_cne'=>$cne
        ));
    header('Location: http://localhost/CRUD-ETUDIANT/index.php?action=etudiant');
    }

    //POUR SELECTIONNER UNE SEULE LIGNE
   public function getrow($cne){
    $q=$this->db->prepare("SELECT * FROM etudiant WHERE cne=:cne");
    $q->execute(array('cne'=>$cne));
    $row=$q->fetch(PDO::FETCH_ASSOC);
    return $row;
    }

    //POUR SELECTIONNER TOUS
    public function getAll(){
    $q  = $this->db->query('SELECT * FROM etudiant ORDER BY nom');
    $etudiants =  array();

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
        $p= new Etudiant($donnees['nom'] , $donnees['prenom'] , $donnees['age']  , $donnees['cne']);
        array_push($etudiants,$p);
    }
    return $etudiants;
     }

     //----------------------------------
    public function setDb(PDO $db) {
        $this->db = $db; 
    
    }
}
