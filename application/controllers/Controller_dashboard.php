<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_dashboard extends Admin_controller{
    public function versDashboard(){
        $dataliste['title'] = "Dashboard";
        $dataliste['pages'] = "dashboard";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $annee = $this->input->post('annee');
        $date = $this->input->post('');

        if(isset($annee)){
            $dataliste['montant_mois'] = $this->model_dashboard->getMontantByAnnee($annee);
        }else{
            $dataliste['montant_mois'] = $this->model_dashboard->getMontantMois();
        }
        $dataliste['mois'] = ['','Janvier','Fevrier','Mars','Avril','Mais','Juin','Juillet','Aout','Septembre','Otobre','Novembre','Decembre'];
        
        $dataliste['montant_annee'] = $this->model_dashboard->getMontantAnnee();
        $dataliste['devis'] = $this->getAllDevis();   
        $dataliste['total_devis'] = $this->model_dashboard->getTotalDevis();

        //$dataliste['top_maison'] = $this->model_dashboard->getMaisonPlusVendu();
        $this->load->view('pages-template-admin', $dataliste);
	}
} 

?>