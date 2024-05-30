<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_travaux extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function getTravaux($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('v_travaux');
        return $query->result_array();
    }
    
    public function insert_maison_travaux($id_maison,$id_travaux,$qte) {
        if($id_maison == null || $id_travaux == null){
            throw new Exception("Nom null");
        }
        if($qte < 0){
            throw new Exception("Non null");
        }
        $data = [
            'id_maison' => $id_maison,
            'id_travaux' => $id_travaux,
            'qte' => $qte
        ];
        $this->db->insert('maison_travaux', $data);
    }
    public function insert_travaux($code_travaux,$id_unite,$prix_unitaire,$nom_travaux) {
        if($nom_travaux == null){
            throw new Exception("Nom null");
        }
        if($prix_unitaire<=0){
            throw new Exception("Prix null ou negative");
        }
        $data = [
            'code_travaux' => $code_travaux,
            'id_unite' => $id_unite,
            'prix_unitaire' => $prix_unitaire,
            'nom_travaux' => $nom_travaux
        ];
        $this->db->insert('travaux', $data);
    }
    public function updateTravaux($id_travaux, $nom_travaux,$code_travaux,$id_unite,$prix_unitaire) {
        if($prix_unitaire <= 0){
            throw new Exception("Prix negative ou null");
        }
        if($nom_travaux == null){
            throw new Exception("Nom travaux null");
        }
        if($code_travaux == null){
            throw new Exception("Code travaux null");
        }
        if($id_unite == null){
            throw new Exception("Unite null");
        }
        $newdata = [
            'nom_travaux' => trim($nom_travaux),
            'code_travaux' => trim($code_travaux),
            'id_unite' => trim($id_unite),
            'prix_unitaire' => trim($prix_unitaire)
        ];
        $this->db->where('id_travaux', $id_travaux);
        $this->db->update('travaux', $newdata);
    }
    public function deleteTravaux($id_travaux) {
        $sql = "DELETE from travaux where id_travaux = '$id_travaux'";
        $this->db->query($sql);
    }


   
}

?>