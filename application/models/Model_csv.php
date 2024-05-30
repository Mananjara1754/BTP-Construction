<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_csv extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function insertCsvPaiement($data){ 
        $this->db->query("delete from import_paiement");
        for ($i=0; $i < count($data); $i++) { 
            $this->insertImportPaiement($i+2,$data[$i]['ref_devis'],$data[$i]['ref_paiement'],$data[$i]['date_paiement'],$data[$i]['montant']);
        }
        return $this->insertionDataPaiement();
    }
    public function insertionDataPaiement() {
        $erreur = [];
        $erreur = $this->getErreurPaiement($erreur);
        $NOMBRE_ERREUR = count($erreur);
         if($NOMBRE_ERREUR == 0){
            $import = $this->model_generalise->findAll("import_paiement");
             $this->db->trans_start();
             $id_devis = null;
             $date_paiement = null;
             for ($i=0; $i < count($import); $i++) { 
                 $devis = $this->model_generalise->findBy("devis","ref_devis",$import[$i]['ref_devis']);
                 if(isset($devis['id_devis'])){
                     $id_devis = $devis['id_devis'];
                 }
                 $date_paiement = $this->verifDate($import[$i]['date_paiement']);
                $verif = $this->model_paiement->verifPaiement($import[$i]['ref_paiement']);
                if($verif == true){
                    $this->model_paiement->verifPaiementRef($id_devis,$import[$i]['montant'],$date_paiement,$import[$i]['ref_paiement']);
                }
             }
             if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
             } else {
                 $this->db->trans_commit();
             }
             $this->db->query("delete from import_paiement");
             return null;
         }
         $this->db->query("delete from import_paiement");
         return $erreur;
     }
    public function getErreurPaiement($erreur){
        $import = $this->model_generalise->findAll("import_paiement");
        $NOMBRE_IMPORTER = count($import); 
        for ($i=0; $i < $NOMBRE_IMPORTER; $i++) { 
            if($import[$i]['ref_devis'] == ""){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Erreur de ref devis");
            }
            if($import[$i]['ref_paiement'] == ""){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']."Erreur de ref paiement");
           }
          
            if($import[$i]['montant'] <= 0 ){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['montant']);
            }
            try {
                $date = $this->verifDate($import[$i]['date_paiement']);
            } catch (\Throwable $th) {
                array_push($erreur, "Ligne ".$import[$i]['id_ligne']." ".$import[$i]['date_paiement']);
            }
        }
        return $erreur;
    }
    public function getErreurDevis($erreur){
        $import = $this->model_generalise->findAll("import_devis");
        $NOMBRE_IMPORTER = count($import); 
        for ($i=0; $i < $NOMBRE_IMPORTER; $i++) { 
            if($import[$i]['type_maison'] == ""){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Erreur de donnee sur Type maison");
            }
            if($import[$i]['finition'] == ""){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']."Pas de finition");
           }
           if($import[$i]['lieu'] == ""){
            array_push($erreur,"Ligne ".$import[$i]['id_ligne']."Pas de finition");
        }
            if($import[$i]['taux_finition'] < 0 ){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['taux_finition']);
            }
            try {
                $date = $this->verifDate($import[$i]['date_devis']);
            } catch (\Throwable $th) {
                array_push($erreur, "Ligne ".$import[$i]['id_ligne']." ".$import[$i]['date_devis']);
            }
            try {
                $date = $this->verifDate($import[$i]['date_debut']);
            } catch (\Throwable $th) {
                array_push($erreur, "Ligne ".$import[$i]['id_ligne']." ".$import[$i]['date_debut']);
            }
        }
        return $erreur;
    }
    public function getErreurTravMaison($erreur){
        $import = $this->model_generalise->findAll("import_trav_maison");
        $NOMBRE_IMPORTER = count($import); 
        for ($i=0; $i < $NOMBRE_IMPORTER; $i++) { 
            if($import[$i]['type_maison'] == " "){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Erreur de donnee sur Type maison");
            }
            if($import[$i]['description'] == " "){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']."Pas de description");
           }
            if($import[$i]['surface'] <= 0 ){
                array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['surface']);
            }
            if($import[$i]['prix_unitaire'] <= 0 ){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['prix_unitaire']);
           }
           if($import[$i]['quantite'] <= 0 ){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['quantite']);
           }
           if($import[$i]['duree_travaux'] <= 0 ){
               array_push($erreur,"Ligne ".$import[$i]['id_ligne']." Negative ou  null ".$import[$i]['duree_travaux']);
           }
        }
        return $erreur;
    }
    
    public function insertionData() {
        $erreur = [];
        $erreur = $this->getErreurTravMaison($erreur);
        $erreur = $this->getErreurDevis($erreur);
         $date = null;
         $NOMBRE_ERREUR = count($erreur);
         if($NOMBRE_ERREUR == 0){
             $this->db->trans_start();
             $this->db->query("insert into maison (nom_maison,surface,description,duree_fabrication) select type_maison as nom_maison,surface::float,description,duree_travaux::float as duree_fabrication from import_trav_maison group by type_maison,surface,description,duree_travaux");
             $this->db->query("insert into unite (nom_unite) select unite from import_trav_maison group by unite");
             $all_trav = $this->model_generalise->findByRequest("select code_travaux,unite,prix_unitaire,type_travaux as nom_travaux from import_trav_maison group by code_travaux,unite,prix_unitaire,type_travaux ;");
             $trav_maison = $this->model_generalise->findAll("import_trav_maison");
             $NOMBRE_TRAVAUX = count($all_trav);
             $NOMBRE_TRAVAUX_MAISON = count($trav_maison);
             for ($i=0; $i < $NOMBRE_TRAVAUX; $i++) { 
                $id_unite = $this->model_generalise->findBy("unite","nom_unite",$all_trav[$i]['unite']);
                $this->model_travaux->insert_travaux($all_trav[$i]['code_travaux'],$id_unite['id_unite'],$all_trav[$i]['prix_unitaire'],$all_trav[$i]['nom_travaux']);
             }
             for ($i=0; $i < $NOMBRE_TRAVAUX_MAISON ; $i++) { 
                $maison = $this->model_generalise->findBy("maison","nom_maison",$trav_maison[$i]['type_maison']);
                $travaux = $this->model_generalise->findBy("travaux","code_travaux",$trav_maison[$i]['code_travaux']);
                $this->model_travaux->insert_maison_travaux($maison['id_maison'],$travaux['id_travaux'],$trav_maison[$i]['quantite']);
             }
             $this->db->query("insert into client (numero_client) select client as numero_client from import_devis group by client");
             $this->db->query("insert into finition (nom_finition,augmentation) select finition as nom_finition,taux_finition::float as augmentation from import_devis group by finition,taux_finition");
             $this->db->query("insert into lieu (nom_lieu) select lieu as nom_lieu from import_devis group by lieu");

             $id_client = null;
             $id_maison  = null;
             $id_finition = null;
             $date_debut = null;
             $devis = $this->model_generalise->findAll("import_devis");
             $NOMBRE_DEVIS = count($devis);
             for ($i=0; $i < $NOMBRE_DEVIS; $i++) { 
                 $client = $this->model_generalise->findBy("client","numero_client",$devis[$i]['client']);
                 $maison = $this->model_generalise->findBy("maison","nom_maison",$devis[$i]['type_maison']);
                 $finition = $this->model_generalise->findBy("finition","nom_finition",$devis[$i]['finition']);
                 $lieu = $this->model_generalise->findBy("lieu","nom_lieu",$devis[$i]['lieu']);
                 if(isset($client['id_client'])){
                     $id_client = $client['id_client'];
                 }
                 if(isset($maison['id_maison'])){
                     $id_maison = $maison['id_maison'];    
                 }
                 if(isset($finition['id_finition'])){
                    $id_finition = $finition['id_finition'];
                }
                if(isset($lieu['id_lieu'])){
                    $id_lieu = $lieu['id_lieu'];    
                }
                 $date_debut = $this->verifDate($devis[$i]['date_debut']);
                 $date_devis = $this->verifDate($devis[$i]['date_devis']);
                //  echo $id_client."<br>";
                //  echo $id_maison."<br>";
                //  echo $id_finition."<br>";
                //  echo $id_lieu."<br>";
                //  echo $date_debut."<br>";
                 $this->model_devis->insertDevisWithRef($id_client,$id_maison,$id_finition,$id_lieu,$date_debut,$date_devis,$devis[$i]['ref_devis']);
             }
             if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 
             } else {
                 $this->db->trans_commit();
             }
             $this->db->query("delete from import_trav_maison");
             $this->db->query("delete from import_devis");
             return null;
         }
         $this->db->query("delete from import_trav_maison");
         $this->db->query("delete from import_devis");
         return $erreur;
     }
    public function insertCsvTravaux($data,$devis){    
        $this->db->query("delete from import_trav_maison");
         $this->db->query("delete from import_devis"); 
        for ($i=0; $i < count($data); $i++) { 
            $this->insertImportTravMaison($i+2,$data[$i]['type_maison'],$data[$i]['description'],$data[$i]['surface'],$data[$i]['code_travaux'],$data[$i]['type_travaux'],$data[$i]['unite'],$data[$i]['prix_unitaire'],$data[$i]['quantite'],$data[$i]['duree_travaux']);
        }
        for ($i=0; $i < count($devis); $i++) { 
            $this->insertImportDevis($i+2,$devis[$i]['client'],$devis[$i]['ref_devis'],$devis[$i]['type_maison'],$devis[$i]['finition'],$devis[$i]['taux_finition'],$devis[$i]['date_devis'],$devis[$i]['date_debut'],$devis[$i]['lieu']);
        }
        //var_dump($devis);
        return $this->insertionData();
    }
    public function insertImportDevis($id_ligne,$client,$ref_devis,$type_maison,$finition,$taux_finition,$date_devis,$date_debut,$lieu){
        $data = [
            'id_ligne' => $id_ligne,
            'client' => $client,
            'ref_devis' => $ref_devis,
            'type_maison' => $type_maison,
            'finition' => $finition,
            'taux_finition' =>$taux_finition,
            'date_devis' => $date_devis,
            'date_debut' => $date_debut,
            'lieu' => $lieu
        ];
        $this->db->insert('import_devis', $data);
    }
    
    public function insertImportTravMaison($id_ligne,$type_maison,$description,$surface,$code_travaux,$type_travaux,$unite,$prix_unitaire,$quantite,$duree_travaux){
        $data = [
            'id_ligne' => $id_ligne,
            'type_maison' => $type_maison,
            'type_maison' => $type_maison,
            'code_travaux' => $code_travaux,
            'description' =>$description,
            'surface' => $surface,
            'type_travaux' => $type_travaux,
            'unite' => $unite,
            'prix_unitaire' => $prix_unitaire,
            'quantite' => $quantite,
            'duree_travaux' => $duree_travaux
        ];
        $this->db->insert('import_trav_maison', $data);
    }
    
    public function insertImportPaiement($id_ligne,$ref_devis,$ref_paiement,$date_paiement,$montant){
        $data = [
            'id_ligne' => $id_ligne,
            'ref_paiement' => $ref_paiement,
            'ref_devis' => $ref_devis,
            'date_paiement' => $date_paiement,
            'montant' => $montant
        ];
        $this->db->insert('import_paiement', $data);
    }
    public function transfoDate($date){
        //Manao 20 - > 2025
        $cst = DateTime::createFromFormat('d/m/Y',$date);
        return $cst->format('Y-m-d');
    }
    public function verifDate($dateString){
        $dateString = str_replace('/', '-', $dateString);
        $dateTime = null;
        $timestamp = strtotime($dateString);
        if ($timestamp === false) {
            throw new Exception("La date est invalide.");
        } else {
            $dateTime = date('Y-m-d', $timestamp);
        }
        return $dateTime;
    }
}

?>