<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_finition extends Admin_controller{

    public function versCrudFinition(){
        $id_finition = $this->input->get('id_finition');
        $dataliste['title'] = "Insertion finition";
        $dataliste['pages'] = "crud_finition";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_finition)){
            $dataliste['update'] = $this->model_generalise->findById("finition",$id_finition);
        }
        $config['base_url'] = base_url() . 'Controller_finition/versCrudFinition';
        $NB = $this->model_generalise->findCount("finition");
        $config['total_rows'] = $NB;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $dataliste['finition'] = $this->model_finition->get_finition($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
    
        // Passer les données à la vue
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function versUpdateFinition($id_finition){
        $dataliste['title'] = "Insertion finition";
        $dataliste['pages'] = "crud_finition";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_finition)){
            $dataliste['update'] = $this->model_generalise->findById("finition",$id_finition);
        }
        $config['base_url'] = base_url() . 'Controller_finition/versCrudFinition';
        $NB = $this->model_generalise->findCount("finition");
        $config['total_rows'] = $NB;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $dataliste['finition'] = $this->model_finition->get_finition($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
    
        // Passer les données à la vue
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function updateFinition(){
        try {
            $id_finition = $this->input->post('id_finition');
            $nom_finition = $this->input->post('nom_finition');
            $augmentation = $this->input->post('augmentation');
            $this->model_finition->updateFinition($id_finition,$nom_finition,$augmentation);
            $this->versCrudFinition();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function deleteFinition($id_finition){
        try {
            $this->model_finition->deleteFinition($id_finition);
            $this->versCrudFinition();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>