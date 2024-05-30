<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_travaux extends Admin_controller{

    
    // public function insert_travaux(){
    //     $nom_travaux = $this->input->post("nom_travaux");
    //     try {
    //        $this->model_travaux->insert_travaux($nom_travaux);
    //        $this->versCrudTravaux();
    //     } catch (\Throwable $th) {
    //         $data['error'] = $th->getMessage();
    //         $this->load->view('errors/index',$data);
    //     }
	// }
 
    public function versCrudTravaux(){
        $id_travaux = $this->input->get('id_travaux');
        $dataliste['title'] = "Insertion travaux";
        $dataliste['pages'] = "crud_travaux";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_travaux)){
            $dataliste['update'] = $this->model_generalise->findById("travaux",$id_travaux);
        }
        $config['base_url'] = base_url() . 'Controller_travaux/versCrudTravaux';
        //$config['base_url'] = base_url() . 'travaux-btp/';
        $NB = $this->model_generalise->findCount("travaux");
        $config['total_rows'] = $NB;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $dataliste['travaux'] = $this->model_travaux->getTravaux($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
        $dataliste['unite'] = $this->getAllUnite();
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_updateTravaux($id_travaux){
        $dataliste['title'] = "Insertion travaux";
        $dataliste['pages'] = "crud_travaux";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_travaux)){
            $dataliste['update'] = $this->model_generalise->findById("travaux",$id_travaux);
        }
        //$config['base_url'] = base_url() . 'Controller_travaux/versCrudTravaux';
        $config['base_url'] = base_url() . 'travaux-btp';
        $NB = $this->model_generalise->findCount("travaux");
        $config['total_rows'] = $NB;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $dataliste['travaux'] = $this->model_travaux->getTravaux($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
        $dataliste['unite'] = $this->getAllUnite();
        // Passer les données à la vue
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function updateTravaux(){
        try {
            $id_travaux = $this->input->post('id_travaux');
            $nom_travaux = $this->input->post('nom_travaux');
            $id_unite = $this->input->post('id_unite');
            $code_travaux = $this->input->post('code_travaux');
            $prix_unitaire = $this->input->post('prix_unitaire');
            $this->model_travaux->updateTravaux($id_travaux,$nom_travaux,$code_travaux,$id_unite,$prix_unitaire);
            $this->versCrudTravaux();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function deleteTravaux($id_travaux){
        try {
            $this->model_travaux->deleteTravaux($id_travaux);
            $this->versCrudTravaux();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>