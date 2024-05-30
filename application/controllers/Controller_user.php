<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_user extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
    }
	public function index(){
        $this->load->view('body/client');
	}
    public function inscription(){
        $this->load->view('body/inscription');
    }
    public function cache(){
        $this->load->driver('cache',array('adapter' => 'file','backup' => 'file'));
        $key = 'data';
        $data = array('nom'=>'Joh','mdp'=>'John le mdp');
        if(!$this->cache->get($key)){
            $this->cache->save($key,$data,600);
            echo 'succes';
        }else{
            echo "Donne recuperer cahe";
            var_dump($this->cache->get($key));
        }
    }
    public function mettreAJour(){
        $this->load->model('model_generalise');
        $finition = $this->model_generalise->findAll("finition");
        $lieu = $this->model_generalise->findAll("lieu");
        $maison = $this->model_generalise->findAll("maison");
        $this->mettreEnCache('lieu',$lieu);
        $this->mettreEnCache('maison',$maison);
        $this->mettreEnCache('finition',$finition);
    }
    
    public function admin(){
        $this->load->view('body/index');
    }
    
    public function client(){
        $this->load->view('body/index');
    }
    public function vers_produit()
	{
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "produit";
        $this->load->view('pages-template-admin', $dataliste);
	}
    
    
    public function vers_validation_demande()
	{
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "validation_demande";
        $this->load->view('pages-template-admin', $dataliste);
	}

    public function vers_insert_service()
	{
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "insert_service";
        $this->load->view('pages-template-admin', $dataliste);
	}
    public function vers_demande_proformat()
	{
        $dataliste['id_role'] = $this->session->userdata("id_role");
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "demande_proformat";
        $this->load->view('pages-template-admin', $dataliste);
	}


}
?>
