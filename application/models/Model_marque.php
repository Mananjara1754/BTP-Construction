<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_marque extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function get_marque($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('marque');
        return $query->result_array();
    }
    
    public function insert_marque($nom_marque) {
        if($nom_marque == null){
            throw new Exception("Nom null");
        }
        $data = [
            'nom_marque' => trim($nom_marque)
        ];
        $this->db->insert('marque', $data);
    }
    public function update_marque($id_marque, $nom_marque) {
        $newdata = [
            'nom_marque' => trim($nom_marque)
        ];
        $this->db->where('id_marque', $id_marque);
        $this->db->update('marque', $newdata);
    }
    public function delete_marque($id_marque) {
        $sql = "DELETE from marque where id_marque = '$id_marque'";
        $this->db->query($sql);
    }


   
}

?>