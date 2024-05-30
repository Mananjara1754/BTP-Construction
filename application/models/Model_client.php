<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_client extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function verifClient($numero) {
        $val = 'not_found';
        $request = "SELECT * from client where numero_client = %s";
        $request = sprintf($request,$this->db->escape($numero));
        $query = $this->db->query($request);
        $row = $query->row_array();
        if(isset($row)) {
            $val = $row['id_client'];
        }
        return $val;
    }
    public function inscription($nom,$utilisateur,$mdp,$verif,$sexe,$dtn) {
        if($verif != $mdp){
            throw new Exception("Erreur coonfirmation du mdp");
        }
        if($nom == " "){
            throw new Exception("Erreur nom");
        }
        $data = [
            'nom_client' => trim($nom),
            'utilisateur' => $utilisateur,
            'mdp' => $mdp,
            'sexe' => $sexe,
            'dtn_client' => $dtn
        ];
        $this->db->insert('client', $data);
    }
    public function inscription_client($numero) {
        if($numero == "null"){
            throw new Exception("Erreur nom");
        }
        $data = [
        
            'numero_client' => trim($numero)
        ];
        $this->db->insert('client', $data);

    }
    public function get_client($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('client');
        return $query->result_array();
    }
    public function insertClient($nom_client,$mdp,$utilisateur,$sexe,$dtn) {
        if($nom_client == null || $mdp == null){
            throw new Exception("Nom null");
        }
        $data = [
            'nom_client' => trim($nom_client),
            'mdp' => trim($mdp),
            'utilisateur' => trim($utilisateur),
            'sexe' => $sexe,
            'dtn_client' => $dtn
        ];
        $this->db->insert('client', $data);
    }
    public function update_client($id_client, $nom_client,$mdp) {
        $newdata = [
            'nom_client' => trim($nom_client),
            'mdp' => trim($mdp)
        ];
        $this->db->where('id_client', $id_client);
        $this->db->update('client', $newdata);
    }
    public function delete_client($id_client) {
        $sql = "DELETE from client where id_client = '$id_client'";
        $this->db->query($sql);
    }


   
}

?>