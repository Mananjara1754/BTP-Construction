<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_login extends CI_Controller{
    public function verifLogin(){
        $this->load->model('Model_Service');
        $utilisateur = $this->input->post('utilisateur');
        $mdp = $this->input->post('mdp');
        $id_service = $this->Model_Service->verifLogin($utilisateur,$mdp);
        if($id_service == "not_found"){
            $dataliste['error'] =" Verifier votre information";
            $this->load->view('body/index',$dataliste);
        }else{
            $role = $this->Model_Service->get_service_role_by_id($id_service);
            $this->session->set_userdata("id_service",$id_service);
            $this->session->set_userdata("id_role",$role[0]['id_role']);
            $this->session->set_userdata("nom",$role[0]['nom']);
            $this->versAccueilAdmin();
        }
    }
    public function verifClient(){
        $this->load->model('model_client');
        $numero = $this->input->post('numero');
        $id_client = $this->model_client->verifClient($numero);
        if($id_client == "not_found"){
            $this->model_client->inscription_client($numero);
            $this->verifClient();
            // $dataliste['error'] =" Verifier votre information";
            // $this->load->view('body/client',$dataliste);
        }else{
            $info = $this->model_generalise->findById("client",$id_client);
            $this->session->set_userdata("id_client",$id_client);
            $this->session->set_userdata("numero_client",$info['numero_client']);
            $this->versAccueilClient();
        }
    }
    public function inscription(){
        $this->load->model('model_client');
        $utilisateur = $this->input->post('utilisateur');
        $mdp = $this->input->post('mdp');
        $nom = $this->input->post('nom');
        $verif = $this->input->post('verif');
        $sexe = $this->input->post('sexe');
        $dtn = $this->input->post('dtn');
        try {
            //echo $sexe;
            $this->model_client->inscription($nom,$utilisateur,$mdp,$verif,$sexe,$dtn);
            $this->verifClient();
        } catch (\Throwable $th) {
            $dataliste['error'] = $th->getMessage();
            $this->load->view('body/inscription',$dataliste);
        }
    }
    
    public function versAccueilClient(){
        $this->load->model('model_generalise');
        if (!$this->session->userdata('id_client')  ) {
            redirect('client');
        }
        $finition = $this->model_generalise->findAll("finition");
        $lieu = $this->model_generalise->findAll("lieu");
        $maison = $this->model_generalise->findAll("maison");
        $this->mettreEnCache('lieu',$lieu);
        $this->mettreEnCache('maison',$maison);
        $this->mettreEnCache('finition',$finition);
        echo "succes";
        $dataliste['title'] = "Accueil";
        $dataliste['pages'] = "accueil_client";
        $dataliste['numero_client'] = $this->session->userdata("numero_client");
        $dataliste['id_client'] = $this->session->userdata("id_client");
        $this->load->view('pages-template', $dataliste);
	}
    public function versAccueilAdmin(){
        if (!$this->session->userdata('id_service')  ) {
            redirect('admin');
        }
        $dataliste['title'] = "Accueil";
        $dataliste['pages'] = "accueil";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
    $this->load->view('pages-template-admin', $dataliste);
	}

    public function deconnexion()
    {
        $this->session->unset_userdata("id_service");
        $this->session->unset_userdata("id_role");
        $this->session->unset_userdata("nom");
        ob_clean();
        redirect('admin');
    }
    public function deconnexion_client()
    {
        $this->session->unset_userdata('id_client');
        $this->session->unset_userdata('numero_client');
        $this->deleteCache('lieu');
        $this->deleteCache('maison');
        $this->deleteCache('finition');
        ob_clean();
        redirect('client');
    }
}
?>