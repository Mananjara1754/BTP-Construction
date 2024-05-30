<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Client_controller.php');
class Controller_devis extends Client_controller{

    public function infoDevis($id_devis){
        $dataliste['title'] = "Information devis";
        $dataliste['pages'] = "details_devis";
        $dataliste['numero_client'] = $this->session->userdata("numero_client");
        $dataliste['details'] = $this->model_devis->detailsDevis($id_devis);
        $dataliste['paiement'] = $this->model_generalise->findByRequest("select * from paiement where id_devis ='".$id_devis."'"); 
        $dataliste['somme_payee'] = $this->model_generalise->findByRequest("select id_devis,sum(montant_payee) as somme_payee from paiement where id_devis='".$id_devis."' group by id_devis;");
        $this->load->view('pages-template', $dataliste);
	}

    public function insertDevis(){
        $id_maison = $this->input->post("id_maison");
        $id_finition = $this->input->post("id_finition");
        $date_debut = $this->input->post("date_debut");
        $id_client = $this->session->userdata("id_client");
        $id_lieu = $this->input->post("id_lieu");
        $numero_client = $this->session->userdata("numero_client");
        try {
           $this->model_devis->insertDevis($id_client,$id_maison,$id_finition,$id_lieu,$date_debut,$numero_client);
           $this->versCrudDevis();
        } catch (\Throwable $th) {
            $data['error'] = $th->getMessage();
            $this->load->view('errors/index',$data);
        }
	}
 
    public function versCrudDevis(){
        $id_devis = $this->input->get('id_devis');
        $dataliste['title'] = "Insertion devis";
        $dataliste['pages'] = "crud_devis";
        $dataliste['numero_client'] = $this->session->userdata("numero_client");
        $id_client = $this->session->userdata("id_client");
        if(isset($id_devis)){
            $dataliste['update'] = $this->model_generalise->findById("devis",$id_devis);
        }

        $config['base_url'] = base_url() . 'Controller_devis/versCrudDevis';
        $NB = $this->model_generalise->findCountById("id_client",$id_client,"devis");
        $config['total_rows'] = $NB;
        $config['per_page'] = 5;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $dataliste['devis'] = $this->model_devis->getDevisClient($id_client,$config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();

        //$dataliste['devis'] = $this->model_generalise->findByRequest("select * from devis where id_client='".$id_client."'");   
        $dataliste['finition'] = $this->getCache('finition');
        $dataliste['maison'] = $this->getCache('maison');    
        $dataliste['lieu'] = $this->getCache('lieu');               
        $this->load->view('pages-template', $dataliste);
    }
    
    public function updateDevis(){
        try {
            $id_devis = $this->input->post('id_devis');
            $nom_devis = $this->input->post('nom_devis');
            $this->model_devis->updateDevis($id_devis,$nom_devis);
            $this->versCrudDevis();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}
    public function delete_devis($id_devis){
        try {
            $this->model_devis->delete_devis($id_devis);
            $this->versCrudDevis();
         } catch (\Throwable $th) {
             $data['error'] = $th->getMessage();
             $this->load->view('errors/index',$data);
         }
	}

    
}
?>