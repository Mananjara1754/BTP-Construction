<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_Admin_devis extends Admin_controller{

    public function infoDevis($id_devis){
        $dataliste['title'] = "Information devis";
        $dataliste['pages'] = "details_devis";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $dataliste['details'] = $this->model_devis->detailsDevis($id_devis);     
        $dataliste['paiement'] = $this->model_generalise->findByRequest("select * from paiement where id_devis ='".$id_devis."'"); 
        $dataliste['somme_payee'] = $this->model_generalise->findByRequest("select id_devis,sum(montant_payee) as somme_payee from paiement where id_devis='".$id_devis."' group by id_devis;");  
        $this->load->view('pages-template-admin', $dataliste);
	}
 
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

    public function versListeDevis(){
        $id_devis = $this->input->get('id_devis');
        $dataliste['title'] = "Liste devis BTP";
        $dataliste['pages'] = "liste_devis";
        $dataliste['nom_service'] = $this->session->userdata("nom");        
        if(isset($id_devis)){
            $dataliste['update'] = $this->model_generalise->findById("devis",$id_devis);
        }
        $config['base_url'] = base_url() . 'Controller_Admin_devis/versListeDevis';
        $NB = $this->model_generalise->findCount("devis");
        $config['total_rows'] = $NB;
        $config['per_page'] = 10;
        $config['uri_segment'] = 0;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $dataliste['devis'] = $this->model_devis->getDevis($config['per_page'], $page);
        $dataliste['pagination'] = $this->pagination->create_links();
        //$dataliste['devis'] = $this->getAllDevis();   
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function reset(){
        //$json_data = $this->input->raw_input_stream;
        // $data = json_decode($json_data, true); //liste an'ny table ho atao reiinitialisena 
        $tables = $this->tabName();
        //var_dump($data);
        var_dump($tables);
        foreach($tables as $t){
            if($t['table_name'] != "service" &&  $t['table_name'] != "role" &&  $t['table_name'] != "service_role"){
                $this->db->query($this->_truncate($t['table_name']));
                $this->db->query($this->resetSequence($t['table_name']));
            }
        }
        $this->session->sess_destroy();
        session_destroy();
        ob_clean();
        redirect('controller_user/admin');
    }
    function _truncate($table){
        return "TRUNCATE TABLE ".$table." RESTART IDENTITY CASCADE";
    }
    function resetSequence($table){
        return "ALTER SEQUENCE seq_".$table." restart 1";
    }

    public function tabName(){
        $tables = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE'")->result_array();
        return $tables;
    }


    // public function delete_devis($id_devis){
    //     try {
    //         $this->model_devis->delete_devis($id_devis);
    //         $this->versCrudDevis();
    //      } catch (\Throwable $th) {
    //          $data['error'] = $th->getMessage();
    //          $this->load->view('errors/index',$data);
    //      }
	// }

    
}
?>