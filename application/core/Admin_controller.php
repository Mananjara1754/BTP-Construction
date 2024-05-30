<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Vérifier l'authentification
        if (!$this->session->userdata('id_service')) {
            // Rediriger vers la page de connexion si non authentifié
            redirect('controller_user/admin');
            //echo $this->session->userdata('id_service');
        }
        if ($this->session->userdata('id_role') == 'ROLE2') {
            // Rediriger vers la page de connexion si non authentifié
            redirect('controller_user/admin');
            //echo $this->session->userdata('id_service');
        }
        $this->load->model('model_generalise');
        $this->load->model('model_devis');
        $this->load->model('model_dashboard');
        $this->load->model('model_paiement');
        $this->load->model('model_travaux');
        $this->load->model('model_csv');
        $this->load->model('model_finition');
    }
    public function processCsvPaiement($file_path) {
        $file = fopen($file_path, 'r');
        if ($file === false) {
            log_message('error', 'Impossible d\'ouvrir le fichier CSV : ' . $file_path);
            return;
        }
        $line_number = 1;
        // Lire et ignorer la première ligne (en-têtes)
        fgetcsv($file);
        while (($line = fgetcsv($file, 0, ',', '"')) !== FALSE) {
            // Utiliser array_map pour éliminer les espaces autour de chaque élément
            $trimmed_line = array_map('trim', $line);
            // Convertir les virgules en points pour les valeurs numériques
            foreach ($trimmed_line as $key => $value) {
                // Vérifier si la valeur est un pourcentage
                if (strpos($value, '%') !== false) {
                    // Supprimer le signe de pourcentage et convertir en valeur décimale
                    $trimmed_line[$key] = str_replace(',', '.', str_replace('%', '', $value)) / 100;
                } else if (is_numeric(str_replace(',', '.', $value))) {
                    // Remplacer les virgules par des points pour les séparateurs décimaux
                    $trimmed_line[$key] = str_replace(',', '.', $value);
                }
            }
            // Ajuster en fonction du type de fichier CSV
            if (count($trimmed_line) >= 4) {
                $data[] = array(
                    'ref_devis' => $trimmed_line[0], 
                    'ref_paiement' => $trimmed_line[1], 
                    'date_paiement' => $trimmed_line[2], 
                    'montant' => $trimmed_line[3]
                );
            }
            else {
                $error_message = 'La ligne ' . $line_number . ' du CSV ne contient pas suffisamment de valeurs : ' . implode(';', $trimmed_line);
                log_message('error', $error_message);
            }
            $line_number++;
        }
        fclose($file);
        return $data;
    }
    public function processCsvDevis($file_path) {
        $file = fopen($file_path, 'r');
        if ($file === false) {
            log_message('error', 'Impossible d\'ouvrir le fichier CSV : ' . $file_path);
            return;
        }
        $line_number = 1;
        // Lire et ignorer la première ligne (en-têtes)
        fgetcsv($file);
        while (($line = fgetcsv($file, 0, ',', '"')) !== FALSE) {
            // Utiliser array_map pour éliminer les espaces autour de chaque élément
            $trimmed_line = array_map('trim', $line);
            // Convertir les virgules en points pour les valeurs numériques
            foreach ($trimmed_line as $key => $value) {
                // Vérifier si la valeur est un pourcentage
                if (strpos($value, '%') !== false) {
                    // Supprimer le signe de pourcentage et convertir en valeur décimale
                    $trimmed_line[$key] = str_replace(',', '.', str_replace('%', '', $value)) / 100;
                } else if (is_numeric(str_replace(',', '.', $value))) {
                    // Remplacer les virgules par des points pour les séparateurs décimaux
                    $trimmed_line[$key] = str_replace(',', '.', $value);
                }
            }
            // Ajuster en fonction du type de fichier CSV
            if (count($trimmed_line) >= 4) {
                $data[] = array(
                    'client' => $trimmed_line[0], 
                    'ref_devis' => $trimmed_line[1], 
                    'type_maison' => $trimmed_line[2], 
                    'finition' => $trimmed_line[3],  
                    'taux_finition' => $trimmed_line[4],
                    'date_devis' => $trimmed_line[5],
                    'date_debut' => $trimmed_line[6],
                    'lieu' => $trimmed_line[7]
                );
            }
            else {
                $error_message = 'La ligne ' . $line_number . ' du CSV ne contient pas suffisamment de valeurs : ' . implode(';', $trimmed_line);
                log_message('error', $error_message);
            }
            $line_number++;
        }
        fclose($file);
        return $data;
    }
    public function processCsvTrav($file_path) {
        $file = fopen($file_path, 'r');
        if ($file === false) {
            log_message('error', 'Impossible d\'ouvrir le fichier CSV : ' . $file_path);
            return;
        }
        $line_number = 1;
        // Lire et ignorer la première ligne (en-têtes)
        fgetcsv($file);
        while (($line = fgetcsv($file, 0, ',', '"')) !== FALSE) {
            // Utiliser array_map pour éliminer les espaces autour de chaque élément
            $trimmed_line = array_map('trim', $line);
            // Convertir les virgules en points pour les valeurs numériques
            foreach ($trimmed_line as $key => $value) {
                // Vérifier si la valeur est un pourcentage
                if (strpos($value, '%') !== false) {
                    // Supprimer le signe de pourcentage et convertir en valeur décimale
                    $trimmed_line[$key] = str_replace(',', '.', str_replace('%', '', $value)) / 100;
                } else if (is_numeric(str_replace(',', '.', $value))) {
                    // Remplacer les virgules par des points pour les séparateurs décimaux
                    $trimmed_line[$key] = str_replace(',', '.', $value);
                }
            }
            // Ajuster en fonction du type de fichier CSV
            if (count($trimmed_line) >= 4) {
                $data[] = array(
                    'type_maison' => $trimmed_line[0], 
                    'description' => $trimmed_line[1], 
                    'surface' => $trimmed_line[2],  
                    'code_travaux' => $trimmed_line[3],
                    'type_travaux' => $trimmed_line[4],
                    'unite' => $trimmed_line[5],
                    'prix_unitaire' => $trimmed_line[6],
                    'quantite' => $trimmed_line[7],
                    'duree_travaux' => $trimmed_line[8]
                );   
            }
            else {
                $error_message = 'La ligne ' . $line_number . ' du CSV ne contient pas suffisamment de valeurs : ' . implode(';', $trimmed_line);
                log_message('error', $error_message);
            }
            $line_number++;
        }
        fclose($file);
        return $data;
    }
     // elseif ($file_type == 'devis_csv' && count($trimmed_line) >= 4) {
            //     // Traiter les données du fichier "devis"
            //     var_dump($trimmed_line);
            //     $data = array(
            //         'client' => $trimmed_line[0], 
            //         'ref_devis' => $trimmed_line[1], 
            //         'type_maison' => $trimmed_line[2],  
            //         'finition' => $trimmed_line[3],
            //         'taux_finition' => $trimmed_line[4],
            //         'date_devis' => $trimmed_line[5],
            //         'date_debut' => $trimmed_line[6],
            //         'lieu' => $trimmed_line[7]
            //     );
            //     $this->db->insert('devis_finition', $data);
            // } 
            // elseif ($file_type == 'paiements_csv' && count($trimmed_line) >= 4) {
            //     // Traiter les données du fichier "paiements"
            //     var_dump($trimmed_line);
            //     $data = array(
            //         'ref_devis' => $trimmed_line[0],
            //         'ref_paiement' => $trimmed_line[1],
            //         'date_paiement' => $trimmed_line[2],
            //         'montant' => $trimmed_line[3]
            //     );
            //     $this->db->insert('paiement_devis', $data);
            // } 
    public function processCsvTrav0($file_path) {
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
                    
                    //var_dump($columns);
                    // Ajouter les données à notre tableau
                    $data[] = [
                        'type_maison' => strval($columns[0]),
                        'description' => strval($columns[1]),
                        'surface' => strval($columns[2]),
                        'code_travaux' => strval($columns[3]),
                        'type_travaux' => strval($columns[4]),
                        'unite' => strval($columns[5]),
                        'prix_unitaire' => strval($columns[6]),
                        'quantite' => strval($columns[7]),
                        'duree_travaux' => strval($columns[8])
                    ];
                }
                // Fermer le fichier
                fclose($file_handle);
                // Retourner les données récupérées
                //var_dump($data);
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
    }
    public function getAllDevis(){
        return $this->model_generalise->findAll('v_devis');
    }
    public function get_all_maison(){
        return $this->model_generalise->findAll('maison');
    }
    public function getAllUnite(){
        return $this->model_generalise->findAll('unite');
    }
    public function get_all_finition(){
        return $this->model_generalise->findAll('finition');
    }

    public function get_all_paiement(){
        return $this->model_generalise->findAll('paiement');
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
