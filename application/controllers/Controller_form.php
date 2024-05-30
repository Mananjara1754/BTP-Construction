<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_form extends My_controller{
 
    public function vers_form(){
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "crud";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->view('pages-template-admin', $dataliste);
	}
    public function versAccueil(){
        if (!$this->session->userdata('id_service')) {
            // Rediriger vers la page de connexion si non authentifié
            redirect('controller_user/admin');
            //echo $this->session->userdata('id_service');
        }
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "accueil";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->view('pages-template-admin', $dataliste);
	}

}
?>