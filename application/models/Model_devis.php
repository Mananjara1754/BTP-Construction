<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_devis extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function getDevis($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('v_devis');
        return $query->result_array();
        //return $this->model_generalise->findByRequest("select * from v_devis limit ".$limit." offset ".$offset."");
    }
    public function getDevisClient($id_client,$limit, $offset) {
        // $this->db->limit($limit, $offset);
        // $query = $this->db->get('v_devis');
        // return $query->result_array();
        return $this->model_generalise->findByRequest("select * from v_devis where id_client='".$id_client."' limit ".$limit." offset ".$offset."");
    }
    public function getDateFin($id_maison,$date_debut){
        $maison = $this->model_generalise->findById("maison",$id_maison);
        $date_fin = date('Y-m-d',strtotime($date_debut.'+'.$maison['duree_fabrication'].' days'));
        return $date_fin;
    }
    public function getMontantDevis($id_maison,$id_finition){
        $finition = $this->model_generalise->findById("finition",$id_finition);
        $montant = $this->model_generalise->findByRequest("select id_maison,sum(montant_travaux)as montant from v_maison_travaux 
        where id_maison ='".$id_maison."' group by id_maison
        ;");
        
        if(isset($montant[0]['montant'])){
            return $montant[0]['montant'] + (($montant[0]['montant']*$finition['augmentation']));
        }
        return 0;
    }
    public function getMontantDevisSansMarge($id_maison){
        $montant = $this->model_generalise->findByRequest("select id_maison,sum(montant_travaux)as montant from v_maison_travaux 
        where id_maison ='".$id_maison."' group by id_maison
        ;");
        if(isset($montant[0]['montant'])){
            return $montant[0]['montant'];
        }
        return 0;
    }
    public function detailsDevis($id_devis){
        return $this->model_generalise->findByRequest("select * from v_details_devis where id_devis='".$id_devis."'");
    }
    public function totaleDevis($id_devis){
        return $this->model_generalise->findByRequest("select * from v_details_devis where id_devis='".$id_devis."'");
    }
    public function insertDevis($id_client,$id_maison,$id_finition,$id_lieu,$date_debut,$numero_client){
        if($id_maison == null){
            throw new Exception("Maison null");
        }
        if($id_maison == null){
            throw new Exception(" aucun numero client");
        }
        if($id_finition == null){
            throw new Exception("Finition null");
        }
        if($date_debut == null){
            throw new Exception("Date null");
        }
        // if($id_lieu == null){
        //     throw new Exception("Finition null");
        // }
        $date_fin = $this->getDateFin($id_maison,$date_debut);
        // echo "<br>dateFin".$date_fin;
        
         $montant_devis = $this->getMontantDevis($id_maison,$id_finition);
        //  echo "<br>Montant dev".$montant_devis;
         //echo $montant_devis;
        $montant_devis_sans = $this->getMontantDevisSansMarge($id_maison);
        // echo "<br>Sans".$montant_devis_sans;
        $maison = $this->model_generalise->findById("maison",$id_maison);
        $finition = $this->model_generalise->findById("finition",$id_finition);
        $lieu = $this->model_generalise->findById("lieu",$id_lieu);
        if(!isset($lieu)){
            $lieu = null;
        }
        $this->db->trans_start();
       // $this->db->insert('devis', $data);
        $request = "insert into devis (id_maison,id_finition,id_client,id_lieu,nom_lieu,nom_maison,surface,nom_finition,date_debut,date_fin,montant_devis,montant_devis_sans,duree_fabrication,augmentation,numero_client) values('%s','%s','%s','%s','%s','%s',%f,'%s','%s','%s',%f,%f,%f,%f,'%s') returning id_devis";
        $request = sprintf($request,$id_maison,$id_finition,$id_client,$lieu['id_lieu'],$lieu['nom_lieu'],$maison['nom_maison'],$maison['surface'],$finition['nom_finition'],$date_debut,$date_fin,$montant_devis,$montant_devis_sans,$maison['duree_fabrication'],$finition['augmentation'],$numero_client);
        $id_devis = $this->model_generalise->findByRequest($request)[0]['id_devis'];
        // echo "<br>IdDevis".$id_devis;
        // if(isset($devis['id_devis'])){
        //    $id_devis = $devis['id_devis'];
        // }
        $this->db->query("insert into devis_travaux (id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux) select '".$id_devis."' as id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux from v_maison_travaux where id_maison = '".$id_maison."'");
       // echo "Requete farany : <br>";
        //echo "insert into devis_travaux (id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux) select '".$id_devis."' as id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux from v_maison_travaux where id_maison = '".$id_maison."'";
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    public function insertDevisWithRef($id_client,$id_maison,$id_finition,$id_lieu,$date_debut,$date_devis,$ref_devis){
        if($id_maison == null){
            throw new Exception("Maison null");
        }
        if($date_debut == null){
            throw new Exception("Date null");
        }
        
        if($id_finition == null){
            throw new Exception("Finition null");
        }
        // if($id_lieu == null){
        //     throw new Exception("Finition null");
        // }
        $date_fin = $this->getDateFin($id_maison,$date_debut);
        // echo "<br>dateFin".$date_fin;
        
         $montant_devis = $this->getMontantDevis($id_maison,$id_finition);
        //  echo "<br>Montant dev".$montant_devis;
         //echo $montant_devis;
        $montant_devis_sans = $this->getMontantDevisSansMarge($id_maison);
        // echo "<br>Sans".$montant_devis_sans;
        $maison = $this->model_generalise->findById("maison",$id_maison);
        $finition = $this->model_generalise->findById("finition",$id_finition);
        $lieu = $this->model_generalise->findById("lieu",$id_lieu);
        $client = $this->model_generalise->findById("client",$id_client);
        if(!isset($lieu)){
            $lieu = null;
        }
        $this->db->trans_start();
       // $this->db->insert('devis', $data);
        $request = "insert into devis (id_maison,id_finition,id_client,id_lieu,nom_lieu,nom_maison,surface,nom_finition,date_debut,date_fin,montant_devis,montant_devis_sans,duree_fabrication,augmentation,ref_devis,date_devis,numero_client) values('%s','%s','%s','%s','%s','%s',%d,'%s','%s','%s',%f,%f,%f,%f,'%s','%s','%s') returning id_devis";
        //echo "<br>finition".$finition['augmentation'];
        $request = sprintf($request,$id_maison,$id_finition,$id_client,$lieu['id_lieu'],$lieu['nom_lieu'],$maison['nom_maison'],$maison['surface'],$finition['nom_finition'],$date_debut,$date_fin,$montant_devis,$montant_devis_sans,$maison['duree_fabrication'],$finition['augmentation'],$ref_devis,$date_devis,$client['numero_client']);
        $id_devis = $this->model_generalise->findByRequest($request)[0]['id_devis'];
        // echo "<br>IdDevis".$id_devis;
        // if(isset($devis['id_devis'])){
        //    $id_devis = $devis['id_devis'];
        // }
        $this->db->query("insert into devis_travaux (id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux) select '".$id_devis."' as id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux from v_maison_travaux where id_maison = '".$id_maison."'");
       // echo "Requete farany : <br>";
        //echo "insert into devis_travaux (id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux) select '".$id_devis."' as id_devis,id_unite,id_travaux,nom_unite,nom_travaux,code_travaux,qte,prix_unitaire,montant_travaux from v_maison_travaux where id_maison = '".$id_maison."'";
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    public function updateDevis($id_devis, $nom_devis) {
        if($nom_devis == null){
            throw new Exception("Nom null");
        }
        $newdata = [
            'nom_devis' => trim($nom_devis)
        ];
        $this->db->where('id_devis', $id_devis);
        $this->db->update('devis', $newdata);
    }
    public function delete_devis($id_devis) {
        $sql = "DELETE from devis where id_devis = '$id_devis'";
        $this->db->query($sql);
    }

}

?>