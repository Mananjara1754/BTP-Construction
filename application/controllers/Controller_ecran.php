<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_ecran extends Admin_controller{

    
    public function insert_ecran(){
        $nom_ecran = $this->input->post("nom_ecran");
        try {
           $this->model_ecran->insert_ecran($nom_ecran);
           $this->vers_crud_ecran();
        } catch (\Throwable $th) {
            $data['error'] = $th->getMessage();
            $this->load->view('errors/index',$data);
        }
	}
    public function vers_crud_ecran(){
        $id_ecran = $this->input->get('id_ecran');
        $dataliste['title'] = "Insertion ecran";
        $dataliste['pages'] = "crud_ecran";
        if(isset($id_ecran)){
            $dataliste['update'] = $this->model_generalise->findById("ecran",$id_ecran);
        }
        $dataliste['ecran'] = $this->get_all_ecran();
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $this->load->view('pages-template-admin', $dataliste);
	}
    public function update_ecran(){
        try {
            $id_ecran = $this->input->post('id_ecran');
            $nom_ecran = $this->input->post('nom_ecran');
            $this->model_ecran->update_ecran($id_ecran,$nom_ecran);
            $this->vers_crud_ecran();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function delete_ecran($id_ecran){
        try {
            $this->model_ecran->delete_ecran($id_ecran);
            $this->vers_crud_ecran();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>