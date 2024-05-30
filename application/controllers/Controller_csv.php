<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'core/Admin_controller.php');
class Controller_csv extends Admin_controller{

    public function importCsvTrav(){
        $file_name = $this->doUpload("file_trav");
        $file_name_devis = $this->doUpload("file_devis");
        if($file_name != null && $file_name_devis != null){
            //Ovaina rehefa miova le repertoire anle data
            try {
                $file = $this->processCsvTrav("F:\__S6\Project\htdocs\btp\assets\stockage\\$file_name");
                $devis = $this->processCsvDevis("F:\__S6\Project\htdocs\btp\assets\stockage\\$file_name_devis");
                //var_dump($file);
                $status = $this->model_csv->insertCsvTravaux($file,$devis);
                if($status != null){
                    $data['csv_error'] = $status;
                    $this->load->view('errors/index',$data);
                }else{
                    $this->versAccueil();
                }
            } catch (\Throwable $th) {
                $this->db->query("delete from import_trav_maison");
                $this->db->query("delete from import_devis");
                $data['error'] = $th->getMessage();
                $this->load->view('errors/index',$data);
            }
           
        }
    }

    public function importCsvPaiement(){
        $file_name = $this->doUpload("file");
        //echo $file_name;
        if($file_name != null){
            //Ovaina rehefa miova le repertoire anle data
            $file = $this->processCsvPaiement("F:\__S6\Project\htdocs\btp\assets\stockage\\$file_name");
            //var_dump($file);
            try {
                $status = $this->model_csv->insertCsvPaiement($file);
            if($status != null){
                $data['csv_error'] = $status;
                $this->load->view('errors/index',$data);
            }else{
               $this->versAccueil();
            }
            } catch (\Throwable $th) {
                $this->db->query("delete from import_paiement");
                $data['error'] = $th->getMessage();
                $this->load->view('errors/index',$data);
            }
            
        }   
    }
    public function versImportCsv(){
        $dataliste['title'] = "Import CSV";
        $dataliste['pages'] = "import_csv";
        $dataliste['nom_service'] = $this->session->userdata("nom");
        $this->load->view('pages-template-admin', $dataliste);
    }
    // public function import_csv() {  
    //     $files = array('maison_travaux_csv', 'devis_csv', 'paiements_csv');
    //     $upload_path = './assets/fichier/import/';
    //     $config['upload_path']   = $upload_path;
    //     $config['allowed_types'] = 'csv';
    //     $config['max_size']      = 1024;
    //     $this->load->library('upload', $config);
    
    //     foreach ($files as $file) {
    //         if (!empty($_FILES[$file]['name'])) {
    //             $file_name = $_FILES[$file]['name'];
    //             if (file_exists($upload_path . $file_name)) {
    //                 echo "Le fichier " . $file_name . " est déjà importé.";
    //                 redirect('Admin/home');                   
    //             } else {
    //                 if ($this->upload->doUpload($file)) {
    //                     $file_data = $this->upload->data();
    //                     $file_path = $file_data['full_path'];
    //                     $this->Import_model->import_csv($file_path, $file);     
    //                 } else {
    //                     echo $this->upload->display_errors();
    //                 }
    //             }
    //         } else {
    //             echo "Aucun fichier sélectionné pour " . $file . ".";
    //         }
    //     }
    
    //     redirect('Admin/home');
    // }
}
?>