<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_emp extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function get_emp($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('emp');
        return $query->result_array();
    }
    
    public function insert_emp($nom_emp) {
        if($nom_emp == null){
            throw new Exception("Nom null");
        }
        $data = [
            'nom_emp' => trim($nom_emp)
        ];
        $this->db->insert('emp', $data);
    }
    public function update_emp($id_emp, $nom_emp) {
        $newdata = [
            'nom_emp' => trim($nom_emp)
        ];
        $this->db->where('id_emp', $id_emp);
        $this->db->update('emp', $newdata);
    }
    public function delete_emp($id_emp) {
        $sql = "DELETE from emp where id_emp = '$id_emp'";
        $this->db->query($sql);
    }


   
}

?>