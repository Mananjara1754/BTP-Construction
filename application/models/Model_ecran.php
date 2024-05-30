<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ecran extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function insert_ecran($nom_ecran) {
        // if($nom_ecran == null){
        //     throw new Exception("Nom null");
        // }
        $data = [
            'nom_ecran' => $nom_ecran
        ];
        $this->db->insert('ecran', $data);
    }
    public function update_ecran($id_ecran, $nom_ecran) {
        $newdata = [
            'nom_ecran' => $nom_ecran
        ];
        $this->db->where('id_ecran', $id_ecran);
        $this->db->update('ecran', $newdata);
    }
    public function delete_ecran($id_ecran) {
        $sql = "DELETE from ecran where id_ecran = '$id_ecran'";
        $this->db->query($sql);
    }


   
}

?>