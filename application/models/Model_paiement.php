<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_paiement extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function get_paiement($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('paiement');
        return $query->result_array();
    }
    public function verifPaiementRef($id_devis,$montant_payee,$date_paiement,$ref_paiement) {
        if($date_paiement == null){
            throw new Exception("Date null");
        }
        if($montant_payee <= 0 ){
            throw new Exception("Montant nehgatif ou null");
        }
        $reste_payee = null;
        $data = [
            'montant_payee' => trim($montant_payee),
            'id_devis' => $id_devis,
            'date_paiement' => trim($date_paiement),
            'ref_paiement' => trim($ref_paiement)
        ];
        $devis = $this->model_generalise->findById("devis",$id_devis);
        if($devis['montant_devis'] < $montant_payee+$devis['montant_payee']){
            throw new Exception("Montant mihoatra".number_format($montant_payee+$devis['montant_payee']-$devis['montant_devis'],2,'.',' '));
        }
        if($devis['etat_devis'] != 0){
            throw new Exception("Efa voaloha");
        }
        $this->db->trans_start();
       // $this->db->insert('devis', $data);
        $this->db->insert('paiement', $data);
        $ETAT_PAIEMENT = 0;
        if($montant_payee+$devis['montant_payee'] == $devis['montant_devis']){
            $ETAT_PAIEMENT = 20;
        }
        $newdata = [
            'montant_payee' => $montant_payee+$devis['montant_payee'],
            'etat_devis' => $ETAT_PAIEMENT
        ];
        $this->db->where('id_devis', $id_devis);
        $this->db->update('devis', $newdata);
    
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    public function insertPaiement($id_devis,$montant_payee,$date_paiement) {
        if($date_paiement == null){
            throw new Exception("Date null");
        }
        if($montant_payee <= 0 ){
            throw new Exception("Montant nehgatif ou null");
        }
        $reste_payee = null;
        $data = [
            'montant_payee' => trim($montant_payee),
            'id_devis' => $id_devis,
            'date_paiement' => trim($date_paiement)
        ];
        $devis = $this->model_generalise->findById("devis",$id_devis);
        if($devis['montant_devis'] < $montant_payee+$devis['montant_payee']){
            throw new Exception("Montant mihoatra".number_format($montant_payee+$devis['montant_payee']-$devis['montant_devis'],2,'.',' '));
        }
        if($devis['etat_devis'] != 0){
            throw new Exception("Efa voaloha");
        }
        $this->db->trans_start();
       // $this->db->insert('devis', $data);
        $this->db->insert('paiement', $data);
        $ETAT_PAIEMENT = 0;
        if($montant_payee+$devis['montant_payee'] == $devis['montant_devis']){
            $ETAT_PAIEMENT = 20;
        }
        $newdata = [
            'montant_payee' => $montant_payee+$devis['montant_payee'],
            'etat_devis' => $ETAT_PAIEMENT
        ];
        $this->db->where('id_devis', $id_devis);
        $this->db->update('devis', $newdata);
    
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    public function verifPaiement($ref_paiement) {
        $val = true;
        $row = $this->model_generalise->findByRequest("select * from paiement where ref_paiement = '".$ref_paiement."'");
        if(isset($row[0]['id_paiement'])) {
            $val = false;
        }
        return $val;
    }
    public function update_paiement($id_paiement, $nom_paiement) {
        $newdata = [
            'nom_paiement' => trim($nom_paiement)
        ];
        $this->db->where('id_paiement', $id_paiement);
        $this->db->update('paiement', $newdata);
    }
    public function delete_paiement($id_paiement) {
        $sql = "DELETE from paiement where id_paiement = '$id_paiement'";
        $this->db->query($sql);
    }
}

//Animation - gzip ny url - css all -  data ao anaty cache

?>