<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Vérifier l'authentification
        if (!$this->session->userdata('id_service')) {
            // Rediriger vers la page de connexion si non authentifié
            redirect('controller_user/admin');
            //echo $this->session->userdata('id_service');
        }
        $this->load->model('model_generalise');
        $this->load->model('model_client');
        $this->load->model('model_vente');
        $this->load->model('model_dashboard');
        $this->load->model('model_billet');
        $this->load->model('model_produit');
        $this->load->model('model_diffusion');
        
    }
    public function process_csv($file_path) {
        // Charger le modèle

      // Vérifier si le formulaire a été soumis
    
          // Ouvrir le fichier CSV en lecture
          $file_handle = fopen($file_path, "r");
          if ($file_handle) {
              // Initialiser un tableau pour stocker les données
              $data = [];
              $debut = 0;

              // Lire le fichier ligne par ligne
              while (($row = fgetcsv($file_handle, 1000, ";")) !== false) {
                  // Supprimer les guillemets de la première colonne
                  //Io indice 0 io izy rehetra de avy eo splitevana
                  $row[0] = str_replace('"', '', $row[0]);
                  
                  // Diviser la ligne en colonnes
                  $columns = explode(",", $row[0]);
                  if($debut != 0){
                  // Ajouter les données à notre tableau
                      $data[] = [
                          'Date' => trim($columns[0]),
                          'Code_pack' => trim($columns[1]),
                          'Quantite' => trim($columns[2]),
                          'Code_vendeur' => trim($columns[3]),
                          'Axe_livraison' => trim($columns[4])
                      ];
                  }
                  $debut++;
              }
              // Fermer le fichier
              fclose($file_handle);
              // Retourner les données récupérées
             // var_dump($data);
              return $data;
          } else {
              // Gérer l'erreur d'ouverture de fichier
              return false;
          }
      return false;
    }
    public function doUpload($name){
        $config['upload_path']   = './assets/stockage';
        $config['allowed_types'] = 'gif|jpg|png|csv';
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
        return null;
    }
    public function get_all_billet(){
        return $this->model_generalise->findAll('v_billet');
    }
    public function get_all_diffusion(){
        return $this->model_generalise->findAll('v_diffusion');
    }
    public function get_all_marque(){
        return $this->model_generalise->findAll('marque');
    }
    public function get_all_disque(){
        return $this->model_generalise->findAll('disque');
    }
    public function get_all_range(){
        return $this->model_generalise->findAll('range');
    }
    public function get_all_place(){
        return $this->model_generalise->findAll('place');
    }
    public function get_all_categorie(){
        return $this->model_generalise->findAll('categorie');
    }
    public function get_all_produit(){
        return $this->model_generalise->findAll('produit');
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
