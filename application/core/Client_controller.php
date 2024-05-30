<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Vérifier l'authentification
        if (!$this->session->userdata('id_client')) {
            // Rediriger vers la page de connexion si non authentifié
            redirect('client');
            //echo $this->session->userdata('id_service');
        }
        $this->load->model('model_generalise');
        $this->load->model('model_devis');
        $this->load->model('model_dashboard');
        $this->load->model('model_paiement');
        $this->load->model('model_ecran');
    }
    
    public function process_csv($file_path) {

            // Ouvrir le fichier CSV en lecture
            $file_handle = fopen($file_path, "r");
            if ($file_handle) {
                // Initialiser un tableau pour stocker les données
                $data = [];
                // Lire le fichier ligne par ligne
                //Raha , le manasaraka de mila ; le separator de le xplode , de mifamadika raha ;
                while (($row = fgetcsv($file_handle, 1000, ";")) !== false) {
                    // Supprimer les guillemets de la première colonne
                    //Io indice 0 io izy rehetra de avy eo splitevana
                    $row[0] = str_replace('"', '', $row[0]);
                    // var_dump($row);
                    // Diviser la ligne en colonnes
                    $columns = explode(",", $row[0]);
                    
                    var_dump($columns);
                    // Ajouter les données à notre tableau
                    $data[] = [
                        'NumSeance' => strval($columns[0]),
                        'Film' => strval($columns[1]),
                        'Categorie' => strval($columns[2]),
                        'Salle' => strval($columns[3]),
                        'Date' => strval($columns[4]),
                        'Heure' => strval($columns[5])
                    ];
                }
                // Fermer le fichier
                fclose($file_handle);
                // Retourner les données récupérées
                var_dump($data);
                return $data;
            } else {
                // Gérer l'erreur d'ouverture de fichier
                return false;
            }
        return false;
    }
    public function doUpload($name){
        $config['upload_path']   = './assets/stockage';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 100000;
        $config['max_width']     = 102400000;
        $config['max_height']    = 7680000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->doUpload($name)){
            $error_string = $this->upload->display_errors();
            $data['error'] = $error_string;
            $this->load->view('errors/index', $data);
        }else{
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return $file_name;
        }
    }
    public function getAllDevis(){
        return $this->model_generalise->findAll('devis');
    }
    public function get_all_maison(){
        return $this->model_generalise->findAll('maison');
    }
    public function get_all_finition(){
        return $this->model_generalise->findAll('finition');
    }

    public function get_all_paiement(){
        return $this->model_generalise->findAll('paiement');
    }
    public function get_all_lieu(){
        return $this->model_generalise->findAll('lieu');
    }
    public function get_all_ram(){
        return $this->model_generalise->findAll('ram');
    }
    public function get_all_produit(){
        return $this->model_generalise->findAll('produit');
    }
    public function get_all_disque(){
        return $this->model_generalise->findAll('disque');
    }
    
    public function versAccueilClient(){
        if (!$this->session->userdata('id_client')  ) {
            // Rediriger vers la page de connexion si non authentifié
            redirect('client');
            //echo $this->session->userdata('id_service');
        }
        $dataliste['title'] = "Insertion service";
        $dataliste['pages'] = "accueil_client";
        $dataliste['numero_client'] = $this->session->userdata("numero_client");
        $dataliste['id_client'] = $this->session->userdata("id_client");
        $this->load->view('pages-template', $dataliste);
	}
}
