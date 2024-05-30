<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Client_controller.php');
class Controller_paiement extends Client_controller{


    public function insertPaiement(){
        $id_devis = $this->input->post("id_devis");
        $montant_payee = $this->input->post("montant_payee");
        $date_paiement = $this->input->post("date_paiement");
        if(!is_numeric($montant_payee)){
            $response = array(
                'error'=>'le montant doit etre une nombre valide'
            );
        }else{
        try {
           $this->model_paiement->insertPaiement($id_devis,$montant_payee,$date_paiement);
           $response_paiement = true;
           //redirect('Controller_paiement/versPaiement?id_devis='.$id_devis); 
           // $dataliste['title'] = "Insertion paiement";
            // $dataliste['pages'] = "paiement";
            // $dataliste['numero_client'] = $this->session->userdata("numero_client");
            // $dataliste['id_devis']= $id_devis;
            // $dataliste['paiement'] = $this->model_generalise->findByRequest("select * from paiement where id_devis ='".$id_devis."'");   
            // $this->load->view('pages-template', $dataliste);
        } catch (\Throwable $th) {
            $data['error'] = $th->getMessage();
            $response_paiement = $th->getMessage();
            //$this->load->view('errors/index',$data);
        }
        $response = array(
            'response'=>$response_paiement
        );
	}
    error_reporting(E_ERROR | E_PARSE);
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
 
    public function versPaiement($id_devis){
        //$id_devis = $this->input->get('id_devis');
        $dataliste['title'] = "Paiement";
        $dataliste['pages'] = "paiement";
        $dataliste['numero_client'] = $this->session->userdata("numero_client");
        $dataliste['id_devis']= $id_devis;
        $dataliste['paiement'] = $this->model_generalise->findByRequest("select * from paiement where id_devis ='".$id_devis."'");   
        $this->load->view('pages-template', $dataliste);
    }
    
}
?>