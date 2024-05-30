<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Service extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function verifLogin($utilisateur, $mdp) {
        $val = 'not_found';
        $request = "SELECT * from service where (utilisateur = %s or nom = %s) and mdp = %s";
        $request = sprintf($request,$this->db->escape($utilisateur), $this->db->escape($utilisateur), $this->db->escape($mdp));
        // echo $request;  
        $query = $this->db->query($request);
        $row = $query->row_array();
        if(isset($row)) {
            $val = $row['id_service'];
        }
        return $val;
    }
    public function inscription($nom,$utilisateur,$mdp,$verif) {
        if($verif != $mdp){
            throw new Exception("Erreur coonfirmation du mdp");
        }
        if($nom == " "){
            throw new Exception("Erreur nom");
        }
        $data = [
            'nom' => $nom,
            'utilisateur' => $utilisateur,
            'mdp' => $mdp
        ];
         $this->db->trans_start();
        $this->db->insert('service', $data);
        $service_all = $this->model_generalise->findAll('service');
        $service = $service_all[count($service_all)-1];
        $id_service = null;
        if(isset($service['id_service'])){
           $id_service = $service['id_service'];
        }
        $data2 = [
            'id_service' => $id_service,
            'id_role' => 'ROLE2'
        ];
        $this->db->insert('service_role',$data2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

    }
    public function get_service_role_by_id($id_service) {
        // $sql = "SELECT * FROM service_role where id_service = '".$id_service."'";
        $sql = "SELECT service_role.id_role,service.nom FROM service_role join service on service.id_service = service_role.id_service where service_role.id_service = '".$id_service."'";
        //echo $sql;
        $role = $this->model_generalise->findByRequest($sql);
        if(count($role)!=0){
            return $role;
        }
        return null;
    }
   

    public function check_proformat() {
        $sql = "SELECT  (now()::date - date_arret) as h from proformat order by date_arret DESC, id_proformat DESC limit 1";
        $query = $this->db->query($sql);
        $query = $query->row_array();
        if($query["h"] < 0 ){
            throw new Exception("Proformat expire, demander a nouveau");
        }
    }

    public function valider_besoin_service($id_besoin_service) {
        try {
            //code...
            $this->load->model('model_bon_commande');
            $this->check_proformat();
            $this->model_bon_commande->predict_un_bon_commande($id_besoin_service);
            $newdata = [
                'etat' => 10
            ];
            $this->db->where('id_besoin_service', $id_besoin_service);
            $this->db->update('besoin_service', $newdata);

        } catch (Exception $e) {
            throw $e;
        }
        
    }
    
    public function insert_besoin_service($id_article, $qte, $livraison_partielle, $etat, $id_service) {
        $data = [
            'id_article' => $id_article,
            'qte' => $qte,
            'livraison_partielle' => $livraison_partielle,
            'etat' => $etat,
            'id_service' =>$id_service
        ];
        $this->db->insert('besoin_service', $data);
    }
    
    
    public function update_besoin_service($id_besoin_service, $qte, $livraison_partielle, $etat) {
        $newdata = [
            'qte' => $qte,
            'livraison_partielle' => $livraison_partielle,
            'etat' => $etat
        ];
        $this->db->where('id_besoin_service', $id_besoin_service);
        $this->db->update('besoin_service', $newdata);
    }

    
    
    public function insert_proformat($id_fournisseur, $prix_produits, $date = null) {

        $data = [
            'id_fournisseur' => $id_fournisseur,
            'prix_produits' => json_encode($prix_produits)
        ];
        if($date != null) {
            $data = [
                'id_fournisseur' => $id_fournisseur,
                'prix_produits' => json_encode($prix_produits),
                'date_arret' => $date
            ];
        }
        $this->db->insert('proformat', $data);
    }

    public function prix_to_string($prix_produits) {
        $result = '';
        foreach ($prix_produits  as $item) {
            $result .= $item['article'] . ' HT : ' . $item['pu_h_taxe'] . ', Tva : ' . $item['tva'] . " ; ";
        }
        return $result;
    }

    public function demande_proformat($date = null) {
        $this->load->model('model_fournisseur');
        $this->load->model('model_message');
        $fournisseurs = $this->model_generalise->findAll("fournisseur");
        foreach($fournisseurs as $f) {
            $prix_produits = $this->model_fournisseur->prix_article_fournisseur($f["id_fournisseur"]);
            $this->insert_proformat($f["id_fournisseur"], $prix_produits, $date);
            $date_string = date("y-m-j");
            if($date != null) {
                $date_string = $date;
            }
            $message_envoye = "Bonjour, notre societe demande un proformat arrete a la date de $date_string";
            $message_recu = "Bonjour, voici nos prix par article arrete a la date de $date_string :\n";
            $message_recu = $message_recu." ".$this->prix_to_string($prix_produits); 
            // $this->model_message->insert_message($f["id_fournisseur"], $message_envoye , "envoye");
            // $this->model_message->insert_message($f["id_fournisseur"], $message_recu , "recu");
            // $this->model_message->sendEmail_Societe_to_Fournisseur($message_envoye);
            // $this->model_message->sendEmail_Fournisseur_to_Societe($message_recu );
        }
    }

    public function list_proformat ( $id_fournisseur ){
        $request = "SELECT * FROM proformat WHERE  id_fournisseur = '$id_fournisseur'  ORDER BY date_arret DESC,id_proformat DESC LIMIT 1";
        $query = $this->db->query($request);
        $result = $query->row_array();
        $decodedResult = "";
        $this->load->model('model_fournisseur');
        // Decode the JSON string to an array
        if (!empty($result['prix_produits'])) {
            $decodedResult = json_decode($result['prix_produits'], true);
            //$decodedResult = json_decode($decodedResult, true);   
        }
        $data = [
            "id_proformat" => $result['id_proformat'],
            "id_fournisseur" => $id_fournisseur,
            "fournisseur" => $this->model_fournisseur->nom($id_fournisseur),
            "date_arret" => $result['date_arret'],
            "prix_produits" => $decodedResult
        ];
    return $data;        
    }

    public function list_proformat_by_id ( $id_proformat ){
        $request = "SELECT * FROM proformat WHERE  id_proformat = '$id_proformat' ";
        $query = $this->db->query($request);
        $result = $query->row_array();
        $decodedResult = "";
        $this->load->model('model_fournisseur');
        // Decode the JSON string to an array
        if (!empty($result['prix_produits'])) {
            $decodedResult = json_decode($result['prix_produits'], true);
            //$decodedResult = json_decode($decodedResult, true);   
        }
        $data = [
            "id_proformat" => $result['id_proformat'],
            "id_fournisseur" => $result['id_fournisseur'],
            "fournisseur" => $this->model_fournisseur->nom($result['id_fournisseur']),
            "date_arret" => $result['date_arret'],
            "prix_produits" => $decodedResult
        ];
    return $data;        
    }

    public function all_proformat() {
        $val = array();
        $fournisseurs = $this->model_generalise->findAll('fournisseur');
        foreach($fournisseurs as $f) {
            array_push($val, $this->list_proformat($f['id_fournisseur']) );
        }
        return $val;
    }

    
    public function update_proformat($id_proformat, $prix_produits) {
        $newdata = [
            'prix_produits' => json_encode($prix_produits)
        ];
        $this->db->where('id_proformat', $id_proformat);
        $this->db->update('proformat', $newdata);
    }
    
    
}

?>