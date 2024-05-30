<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_finition extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function get_finition($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('finition');
        return $query->result_array();
    }
    
    public function insert_finition($nom_finition,$augmentation) {
        if($nom_finition == null){
            throw new Exception("Nom null");
        }
        if($augmentation <= 0 ){
            throw new Exception("Negatif et null");
        }
        $data = [
            'nom_finition' => trim($nom_finition),
            'augmentation' => trim($augmentation)
        ];
        $this->db->insert('finition', $data);
    }
    public function updateFinition($id_finition, $nom_finition,$augmentation) {
        if($nom_finition == null){
            throw new Exception("Nom null");
        }
        if($augmentation <= 0 ){
            throw new Exception("Negatif et null");
        }
        $newdata = [
            'nom_finition' => trim($nom_finition),
            'augmentation' => trim($augmentation)
        ];
        $this->db->where('id_finition', $id_finition);
        $this->db->update('finition', $newdata);
    }
    public function deleteFinition($id_finition) {
        $sql = "DELETE from finition where id_finition = '$id_finition'";
        $this->db->query($sql);
    }

}

?>