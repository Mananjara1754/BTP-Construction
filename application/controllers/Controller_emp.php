<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_emp extends Admin_controller{

    
    public function insert_emp(){
        $nom_emp = $this->input->post("nom_emp");
        try {
           $this->model_emp->insert_emp($nom_emp);
           $this->vers_crud_emp();
        } catch (\Throwable $th) {
            $data['error'] = $th->getMessage();
            $this->load->view('errors/index',$data);
        }
	}
 
    public function vers_crud_emp(){
        $id_emp = $this->input->get('id_emp');
        $dataliste['title'] = "Insertion emp";
        $dataliste['pages'] = "crud_emp";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        if(isset($id_emp)){
            $dataliste['update'] = $this->model_generalise->findById("emp",$id_emp);
        }
        $config['base_url'] = base_url() . 'Controller_emp/vers_crud_emp';
        $config['total_rows'] = 14;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $dataliste['emp'] = $this->model_emp->get_emp($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
    
        // Passer les données à la vue
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function update_emp(){
        try {
            $id_emp = $this->input->post('id_emp');
            $nom_emp = $this->input->post('nom_emp');
            $this->model_emp->update_emp($id_emp,$nom_emp);
            $this->vers_crud_emp();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function delete_emp($id_emp){
        try {
            $this->model_emp->delete_emp($id_emp);
            $this->vers_crud_emp();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>