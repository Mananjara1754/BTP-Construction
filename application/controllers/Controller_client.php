<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_client extends Admin_controller{

    
    public function insertClient(){
        $nom_client = $this->input->post("nom_client");
        $mdp = $this->input->post("mdp");
        $utilisateur = $this->input->post("utilisateur");
        $sexe = $this->input->post('sexe');
        $dtn = $this->input->post('dtn');
        try {
           $this->model_client->insertClient($nom_client,$mdp,$utilisateur,$sexe,$dtn);
           $this->versCrudClient();
        } catch (\Throwable $th) {
            $data['error'] = $th->getMessage();
            $this->load->view('errors/index',$data);
        }
	}
 
    public function versCrudClient(){
        $id_client = $this->input->get('id_client');
        $dataliste['title'] = "Insertion client";
        $dataliste['pages'] = "crud_client";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_client)){
            $dataliste['update'] = $this->model_generalise->findById("client",$id_client);
        }
        $config['base_url'] = base_url() . 'Controller_client/versCrudClient';
        $config['total_rows'] = 14;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $dataliste['client'] = $this->model_client->get_client($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
    
        // Passer les données à la vue
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function update_client(){
        try {
            $id_client = $this->input->post('id_client');
            $nom_client = $this->input->post('nom_client');
            $mdp = $this->input->post('mdp');
            $this->model_client->update_client($id_client,$nom_client,$mdp);
            $this->versCrudClient();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function delete_client($id_client){
        try {
            $this->model_client->delete_client($id_client);
            $this->versCrudClient();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>