<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {


    public function vers_calendrier() {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Conge');
        $dataliste['title'] = "Calendrier";
        $dataliste['pages'] = "calendrier";
        $dataliste['all_conge'] = $this->Model_Conge->get_conge();
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_full_calendrier() {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Conge');
        $dataliste['title'] = "Calendrier";
        $dataliste['pages'] = "full_calendrier";
        $dataliste['all_conge'] = $this->Model_Conge->get_conge();
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function vers_reste_conge(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['type_majoration'] = $this->model_generalise->findAll('type_majoration');
        $dataliste['reste'] = $this->model_generalise->findAll('v_reste_conge_employe');
        $dataliste['title'] = "Reste Conge";
        $dataliste['pages'] = "reste_conge";

        $this->load->view('pages-template-admin', $dataliste);
    }
    public function insert_avance()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $this->Model_Services->insert_avance($this->input->post('n_matricule'),$this->input->post('n_jours'),$this->input->post('mois'),$this->input->post('anne'));
        $this->accueil();
    }
    public function insert_droit_privilege()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $this->Model_Services->insert_droit_privilege($this->input->post('n_matricule'),$this->input->post('n_jours'),$this->input->post('mois'),$this->input->post('anne'));
        $this->accueil();
    }

    public function insert_droit_conge()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        try {
            $this->Model_Services->insert_droit_conge($this->input->post('n_matricule'),$this->input->post('n_jours'),$this->input->post('mois'),$this->input->post('anne'));
            $this->accueil();
        } catch (Exception $e) {
            $dataliste['erreur'] = $e->getMessage();
            $dataliste['id_service'] = $this->session->userdata("id_service");
            $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
            $dataliste['motif'] = $this->model_generalise->findAll('motif_conge;');

            $dataliste['title'] = "Demande de droit de conge";
            $dataliste['pages'] = "droit_conge";
            $this->load->view('pages-template-admin', $dataliste);
        }
        
    }

    public function insert_majoration()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $this->Model_Services->insert_majoration($this->input->post('n_matricule'),$this->input->post('date_majoration'),$this->input->post('nb_heures'),$this->input->post('type_majoration'));
        $this->accueil();
    }

    public function insert_absence()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $this->Model_Services->insert_absence($this->input->post('n_matricule'),$this->input->post('jour_absence'),$this->input->post('mois'),$this->input->post('anne'));
        $this->accueil();
    }

    public function vers_majoration(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['type_majoration'] = $this->model_generalise->findAll('type_majoration');
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['title'] = "Majoration";
        $dataliste['pages'] = "majoration";

        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_demande_avance(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['salaire_base'] = $this->model_generalise->findAll('salaire_base');
        $dataliste['title'] = "Demande d'avance";
        $dataliste['pages'] = "demande_avance";

        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function vers_etat_de_paie(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Employe');
        error_reporting(E_ERROR | E_PARSE);
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Fiche de paie";
        $dataliste['pages'] = "etat_de_paie";
        $dataliste['etat_paie'] = $this->Model_Employe->etat_paie();

        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_fiche_de_paie(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Employe');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Fiche de paie";
        $dataliste['pages'] = "fiche_de_paie";

        $n_matricule = $this->Model_Employe->first_emp();
        //$n = $this->input->get("n_matricule");
        if( isset($_GET["n_matricule"]) ) {
            $n_matricule = $_GET["n_matricule"];
        }
        error_reporting(E_ERROR | E_PARSE);
        $dataliste['detail_emp'] = $this->Model_Employe->fiche_de_poste($n_matricule);
        $dataliste['classification'] = $this->Model_Employe->classification($n_matricule);
        $dataliste['taux'] = $this->Model_Employe->taux_pourcentage($n_matricule);
        $dataliste['salaires'] = $this->Model_Employe->salaires($n_matricule);
        $dataliste['details_paie'] = $this->Model_Employe->fiche_paie($n_matricule);
        
        
        $this->load->view('pages-template-admin', $dataliste);
    }
    
    public function vers_liste_conge_attente(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "liste_conge_attente";
        $dataliste['conge_detail'] = $this->model_generalise->findAll('v_conge_attente');
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_liste_conge_suspendu(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "liste_conge_suspendu";
        $dataliste['conge_detail'] = $this->model_generalise->findAll('v_conge_responsable_accepter');
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_liste_conge_service(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "liste_conge_service";
        $dataliste['conge_detail'] = $this->model_generalise->findAll('v_conge_accepter');
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_demande_conge(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['motif'] = $this->model_generalise->findAll('motif_conge;');
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "demande_conge";
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_conge(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Employe');
        $this->load->model('Model_conge');
        
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "conge";
        $dataliste['cp'] = $this->Model_Employe->get_classification_personnelle();
        $dataliste['employe'] = $this->model_generalise->findAll('employe');
        $dataliste['motif_conge'] = $this->Model_Employe->get_motif_conge();
        
        $nom = $this->input->get('nom');
        $n_matricule = $this->input->get('n_matricule');
        $duree_debut = $this->input->get('duree_debut');
        $duree_fin = $this->input->get('duree_fin');
        $sexe = $this->input->get('sexe');
        $motif = $this->input->get('motif');
        $type_conge = $this->input->get('type_conge');
        $niveau = $this->input->get('niveau');
        if($nom==""){
            $nom=null;
        }
        if($n_matricule==""){
            $n_matricule=null;
        }
        if($duree_debut==""){
            $duree_debut=null;
        }
        if($duree_fin==""){
            $duree_fin=null;
        }
        if($sexe==""){
            $sexe=null;
        }
        if($motif==""){
            $motif=null;
        }
        if($type_conge==""){
            $type_conge=null;
        }
        if($niveau==""){
            $niveau=null;
        }
        
        if (isset($nom) || isset($n_matricule) || isset($duree_debut) || isset($duree_fin) || isset($sexe) || isset($motif) ||isset($type_conge) ||isset($niveau)) {
            $dataliste['conge'] = $this->Model_conge->find_conge($nom, $n_matricule, $duree_debut, $duree_fin, $sexe, $motif, $type_conge, $niveau);
        }else{
            $dataliste['conge'] = $this->Model_conge->get_conge();
        }
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_fiche_employe($n_matricule){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Employe');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['fiche_poste'] = $this->Model_Employe->fiche_de_poste($n_matricule);
        $dataliste['title'] = "Fiche d' employé";
        $dataliste['pages'] = "fiche_employe";
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_contrat_essaie(){
        $candidature = json_decode($this->input->post('candidature'),true);
        // var_dump($candidature);
        $dataliste['candidature'] = $candidature;
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['type_contrat'] = $this->model_generalise->findAll('type_contrat');
        var_dump($dataliste['type_contrat']);

        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Contrat d'essaie";
        $dataliste['pages'] = "contrat_essaie";
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function deconnexion(){
        $this->session->sess_destroy();
        session_destroy();
        ob_clean();
        redirect('controller_user/admin');
    }
    public function verifLogin(){
        $this->load->model('Model_Services');
        $utilisateur = $this->input->post('utilisateur');
        $mdp = $this->input->post('mdp');
        $id_service = $this->Model_Services->verifLogin($utilisateur,$mdp);
        if($id_service == "not_found"){
            redirect('controller_user/admin');
        }else{
            $this->session->set_userdata("id_service",$id_service);
            $this->accueil();
        }
    }

    public function traitement_ajout_annonce(){
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('Model_Recrutement');
        $id_sous_service = $this->input->post('id_sous_service');
        $id_annonce = $this->input->post('id_annonce');
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $sexe = $this->input->post('sexe');
        $date_de_naissance = $this->input->post('date_de_naissance');
        $adresse = $this->input->post('adresse');
        $situation = $this->input->post('situation');
        $diplome = $this->input->post('diplome');
        $duree_en_mois = $this->input->post('duree_en_mois');
        
        $this->Model_Recrutement->ajouter_candidature($id_annonce, $id_sous_service,
        $nom, $prenom, $sexe, $date_de_naissance,
        $adresse, $situation, $diplome, $duree_en_mois );
        
        $this->accueil();
    }
    public function traitement_ajout_parameter(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $id_sous_service = $this->input->post('id_sous_service');
        $volume_horaire = $this->input->post('volume_horaire');
        $volume_heure_par_jour = $this->input->post('volume_heure_par_jour');
        $coefficient_diplome = $this->input->post('coefficient_diplome');
        $aucun = $this->input->post('aucun');
        $cepe = $this->input->post('cepe');
        $bepc = $this->input->post('bepc');
        $bacc = $this->input->post('bacc');
        $licence = $this->input->post('licence');
        $master = $this->input->post('master');
        $doctorat = $this->input->post('doctorat');
        $coefficient_sexe = $this->input->post('coefficient_sexe');
        $homme = $this->input->post('homme');
        $femme = $this->input->post('femme');
        $coefficient_situation = $this->input->post('coefficient_situation');
        $marie = $this->input->post('marie');
        $celibataire = $this->input->post('celibataire');
        $engage = $this->input->post('engage');
        $divorce = $this->input->post('divorce');
        $veuf_ou_veuve = $this->input->post('veuf_ou_veuve');
        $coefficient_experience = $this->input->post('coefficient_experience');
        $duree_en_mois = $this->input->post('duree_en_mois');

        // $this->session->set_userdata("id_annonce",1);      // 1 shoud be substituted to id_annonce

        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $this->Model_Services->update_parameter_diplome($id_sous_service, $coefficient_diplome, 
        $aucun, $cepe, $bepc, $bacc, $licence, $master, $doctorat );
        $this->Model_Services->update_parameter_sex($id_sous_service, $coefficient_sexe, $homme, $femme);
        $this->Model_Services->update_parameter_situation($id_sous_service, $coefficient_situation,
        $marie, $celibataire, $engage, $divorce, $veuf_ou_veuve);
        $this->Model_Services->update_parameter_experience($id_sous_service, $coefficient_experience, $duree_en_mois);
        $this->Model_Services->update_besion_horaire($id_sous_service,$volume_horaire, $volume_heure_par_jour);
        $this->Model_Services->insert_annonce($id_sous_service);
        // $this->accueil();
        $id_annonce = $this->model_generalise->findByRequest("select * from annonce order by id_annonce DESC limit 1")[0]['id_annonce'];
        $this->vers_create_qcm($id_annonce);

    }
    public function insert_sous_service()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";

        $this->Model_Services->insert_sous_service($this->input->post('id_service'),$this->input->post('nom_sous_service'),$this->input->post('nom_cs'));
        $this->vers_insertion();
    }
    public function insert_service()
    {
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->Model_Services->insert_service($this->input->post('nom_service'),$this->input->post('utilisateur'),$this->input->post('mdp'));
        $this->accueil();
    }
    public function vers_insertion()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Employe');

        $dataliste['title'] = "Insertion";
        $dataliste['pages'] = "insertion";
        $dataliste['service'] = $this->Model_Services->get_services();
        $dataliste['cp'] = $this->Model_Employe->get_classification_personnelle();
        $this->load->view('pages-template-admin', $dataliste);
    }
    public function accueil()
    {
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['title'] = "Liste des elements";
        $dataliste['pages'] = "accueil";
        
        $dataliste['sous_service'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
        // print_r($dataliste['sous_service']);

        $dataliste['service_choisi'] = $this->Model_Services->get_service_by_id($this->session->userdata("id_service"));
        $dataliste['service'] = $this->Model_Services->get_services();
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_get_nb_besoin()
    {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
            $dataliste['pages'] = "volume_horaire";
            $dataliste['title'] = "Ajout type entrainement";

            $id_service = $this->session->userdata("id_service");
            $dataliste['sous_service'] = $this->Model_Services->get_sous_services($id_service);
            $this->load->view('pages-template-admin', $dataliste);
    }
    public function annonce(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Recrutement');
        $this->load->model('Model_Annonce');
            $dataliste['id_service'] = $this->session->userdata("id_service");
            $dataliste['pages'] = "annonce";
            $dataliste['title'] = "Ajout activité";
            $dataliste['annonce'] = $this->Model_Annonce->find_annonce_by_id($this->session->userdata("id_service"));
            $dataliste['sous_service'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
            $this->load->view('pages-template-admin', $dataliste);
    }
    public function vers_FormModel(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['sous_service'] = $this->Model_Services->get_sous_services();
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['id_sous_service'] = $this->input->post('id_sous_service');
        $dataliste['volume_horaire'] = $this->input->post('volume_horaire');
        $dataliste['volume_heure_par_jour'] = $this->input->post('volume_heure_par_jour');

        $dataliste['pages'] = "form_besoin";
        $dataliste['title'] = "Formulaire Model";
        $this->load->view('pages-template-admin', $dataliste);
        
    } 
    public function vers_form_besoin()
    {
        $this->load->model('model_generalise');
        $dataliste['id_service'] = $this->session->userdata("id_service");
            $dataliste['pages'] = "form_besoin";
            $dataliste['title'] = "Formulaire Besoin";
            $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_recrutement()
    {

        $this->load->model('model_generalise');
        $this->load->model('Model_Recrutement');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['pages'] = "recrutement";
        $dataliste['title'] = "Recrutement";

        $dataliste['id_annonce'] = $this->input->get('id_annonce');
        $dataliste['id_sous_service'] = $this->input->get('id_sous_service');

        // $dataliste['id_annonce'] = $id_annonce;
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_list_to_test()
    {
        $this->load->model('model_generalise');
        
            $dataliste['pages'] = "list_to_test";
            $dataliste['title'] = "Liste des applications accéptées";
            $this->load->view('pages-template-admin', $dataliste);
        
    } 
    //Mnjr
    public function vers_listes_admis_test()
    {
        $this->load->model('model_generalise');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['pages'] = "listes_admis_test";
        $dataliste['title'] = "Liste des admis en test";
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('model_Recrutement');

        $mois = $this->input->get("mois");
        $id_sous_service = $this->input->get("id_sous_service");
        //echo $mois;
        //$dataliste['sous_services'] = $this->model_generalise->findAll("sous_service");
        $dataliste['sous_services'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
        if(isset($mois) && isset($id_sous_service) ) {
            $dataliste['liste_admis'] = $this->model_Recrutement->rechercher_admis_test($mois, $id_sous_service);
        }
            
        //print_r($dataliste['sous_sercives']);
        $this->load->view('pages-template-admin', $dataliste);
    } 

    public function vers_liste(){
        $this->load->model('model_generalise');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['pages'] = "liste";
        $dataliste['title'] = "Liste des admis";
        $this->load->view('pages-template-admin', $dataliste);
    } 

    //Hasinjara
     public function vers_listes_admis_cv()
     {
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('model_Recrutement');
        $mois = $this->input->get("mois");
        $id_sous_service = $this->input->get("id_sous_service");
        $dataliste['pages'] = "listes_admis_cv";
        $dataliste['title'] = "Liste des admis en cv";
        $dataliste['sous_services'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
        if(isset($mois) && isset($id_sous_service) ) {
            $dataliste['liste_admis'] = $this->model_Recrutement->rechercher_admis_cv($mois, $id_sous_service);
        }
        
        
        $this->load->view('pages-template-admin', $dataliste);
     } 

    public function vers_create_qcm($id_annonce)
    {
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['id_annonce'] = $id_annonce;
        $dataliste['pages'] = "create_qcm";
        $dataliste['title'] = "Création de qcm";
        
        $this->load->view('pages-template-admin', $dataliste);
    } 
    public function vers_listes_selec()
    {
        $this->load->model('model_generalise');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['pages'] = "listes_admis_selection";
        $dataliste['title'] = "Liste des admis en sélection";
        $this->load->view('pages-template-admin', $dataliste);
        
    }
    public function creerQCM(){
        $this->load->model('Model_Recrutement');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['question'] = $this->input->post('question');
        $dataliste['coeff'] = $this->input->post('coeff');
        $id_annonce = $this->input->post('id_annonce');
        $dataliste['reponse'] = $this->input->post('reponse');
        $dataliste['valeur'] = $this->input->post('valeur');
        // var_dump($dataliste);
        // echo $id_annonce;
        for ($i=0; $i < count($dataliste['question']); $i++) { 

            $this->Model_Recrutement->creer_formulaire($id_annonce, $dataliste['question'][$i], $dataliste['reponse'][$i][0], 
            $dataliste['reponse'][$i][1], $dataliste['reponse'][$i][2],$dataliste['valeur'][$i][0], $dataliste['valeur'][$i][1], 
            $dataliste['valeur'][$i][2], $dataliste['coeff'][$i]);

        }
        // $this->session->unset_userdata("id_annonce");
        $this->accueil();
    }

    public function qcm_fait(){
        $this->load->model('Model_Recrutement');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['qcm'] = $this->input->post('checkb_value');
        // print_r($dataliste['qcm']);
        // if($dataliste['qcm'][0][0] == true) {
        //     echo $dataliste['qcm'][0][0]." djdjk";
        // }
        
        $dataliste['id_formulaire'] = $this->input->post('id_formulaire');
        $dataliste['id_annonce'] = $this->input->post('id_annonce');
        $dataliste['id_candidature'] = $this->input->post('id_candidature');

        $this->Model_Recrutement->organize_do_qcm($dataliste);
        $this->accueil();
    }
    
    public function vers_qcm($id_annonce,$id_candidature)
    {
        $this->load->model('model_generalise');
        $this->load->model('model_Recrutement');
        $dataliste['id_service'] = $this->session->userdata("id_service");
            // $dataliste['qcm'] = $this->model_Recrutement->get_qcm(3);       // 3 is id_annonce
            // $id_annonce = $this->session->userdata('id_annonce');
            // echo $this->session->userdata('id_annonce');
            $dataliste['qcm'] = $this->model_Recrutement->get_qcm($id_annonce);
            $dataliste['id_candidature'] =  $id_candidature;
            // var_dump($dataliste['qcm']);
            // echo count($dataliste['qcm']);
            $dataliste['pages'] = "qcm";
            $dataliste['title'] = "Test QCM";
            $this->load->view('pages-template-admin', $dataliste);
        
    } 
    
    public function vers_liste_emp(){
        $dataliste['id_service'] = $this->session->userdata('id_service');

        $dataliste['pages'] = "liste_emp";
        $dataliste['title'] = "Les listes des Employés";

        $this->load->model('model_generalise');
        $this->load->model('Model_Employe');
        $id_sous_service = $this->input->get('id_sous_service');
        $dataliste['sous_services'] = $this->model_generalise->findAll('sous_service');
        if (isset($id_sous_service)) {
            $dataliste['employe'] = $this->Model_Employe->get_fiche_poste_by_id_sous_service($id_sous_service);
        }else{
            $dataliste['employe'] = $this->Model_Employe->get_fiche_poste();
        }
        $this->load->view('pages-template-admin', $dataliste);

    }

    public function vers_fiche_poste(){
        $dataliste['id_service'] = $this->session->userdata("id_service");

        $dataliste['pages'] = "fiche_poste";
        $dataliste['title'] = "Fiche de poste";
        $this->load->view('pages-template-admin', $dataliste);

    }

    public function vers_fiche_perso(){
        $dataliste['id_service'] = $this->session->userdata("id_service");

        $dataliste['pages'] = "fiche_perso";
        $dataliste['title'] = "Fiche Personnel";
        $this->load->view('pages-template-admin', $dataliste);

    }

    public function traitement_contrat(){
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $salaire = $this->input->post('salaire');

        $id_candidature = $this->input->post('id_candidature');
        $id_sous_service = $this->input->post('id_sous_service');
        $type_contrat = $this->input->post('type_contrat');
        $duree_en_mois = $this->input->post('duree_en_mois');
        $CNAPS = $this->input->post('CNAPS');

        // var_dump($_POST);
        $this->load->model('Model_Contrat');
        $this->load->model('Model_Employe');

        $id_personne = $this->Model_Employe->getidPersonne($id_candidature);
        if($type_contrat!="Determine"){
            $duree_en_mois = null;
        } 
        $this->Model_Contrat->nouveau_contrat($id_personne, $id_sous_service, $type_contrat, $duree_en_mois, $CNAPS,$salaire);

        $this->accueil();
    }

    public function trait_demande_conge(){
        $this->load->model('Model_Conge');

        // var_dump($_POST);
        $emp = explode("/",$this->input->post('emp'));
        $n_matricule = $emp[0];
        $nom = $emp[1];
        $date_debut = $this->input->post('date_debut');
        $date_fin = $this->input->post('date_fin');
        $motif = $this->input->post('motif');

        $moisAnnee = $this->Model_Conge->getMoisAnnee($date_debut);
        $message = $this->Model_Conge->nouveau_conge($nom, $n_matricule, $date_debut, $date_fin, $motif);
        $tab = array(
            'n_matricule' => $n_matricule,
            'message' => $message,
        );
        // print_r($moisAnnee);
        if(isset($moisAnnee)){
            $tab['mois'] =$moisAnnee['mois'];
            $tab['annee'] =$moisAnnee['annee'];
        }
        if(isset($tab['message'])){
            // print_r($tab);
            $this->vers_popup($tab);
        }
        else{
            $this->accueil();
        }
        
    }

    public function vers_popup($tab){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $this->load->model('Model_Conge');

        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['motif'] = $this->model_generalise->findAll('motif_conge;');
        // $dataliste['sous_service'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
        // // print_r($dataliste['sous_service']);

        // $dataliste['service_choisi'] = $this->Model_Services->get_service_by_id($this->session->userdata("id_service"));
        // $dataliste['service'] = $this->Model_Services->get_services();
        $dataliste['reste_conge'] = $this->Model_Conge->reste_conge($tab['n_matricule']);
        $dataliste['n_matricule']=$tab['n_matricule'];
        $dataliste['mois']=$tab['mois'];
        $dataliste['annee']=$tab['annee'];
        $dataliste['message'][0]=$tab['message'];
        $word = explode(' ',$tab['message']);
        // print_r($word);
        if ($word[0]=="Votre") {
            $dataliste['droit_conge'][0] = intval($word[4]);
            $dataliste['droit_conge'][1] = intval($word[12]);
        }
        
        $dataliste['title'] = "Gestion congé";
        $dataliste['pages'] = "demande_conge";
        
        // $dataliste['sous_service'] = $this->Model_Services->get_sous_services($this->session->userdata("id_service"));
        // print_r($dataliste['sous_service']);

        // $dataliste['service_choisi'] = $this->Model_Services->get_service_by_id($this->session->userdata("id_service"));
        // $dataliste['service'] = $this->Model_Services->get_services();
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function responsable_accepter_conge($id_conge){
        $this->load->model('Model_conge');

        $this->Model_conge->admin_service_accepter_conge($id_conge);
        $this->vers_liste_conge_attente();
    }

    public function refuse_conge($id_conge){
        $this->load->model('Model_conge');

        $this->Model_conge->refuser_conge($id_conge);
        $this->vers_liste_conge_attente();
    }

    public function rh_accepter_conge($id_conge){
        $this->load->model('Model_conge');

        $this->Model_conge->rh_accepter_conge($id_conge);
        $this->vers_liste_conge_service();
    }
    
    public function vers_droit_conge(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['motif'] = $this->model_generalise->findAll('motif_conge;');

        $dataliste['title'] = "Demande de droit de conge";
        $dataliste['pages'] = "droit_conge";
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_droit_privilege(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['emp'] = $this->model_generalise->findAll('v_employe_poste_hierarchie');
        $dataliste['motif'] = $this->model_generalise->findAll('motif_conge;');

        $dataliste['title'] = "Demande de droit de conge";
        $dataliste['pages'] = "droit_privilege";
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function vers_insertion_absence(){
        $this->load->model('model_generalise');
        $this->load->model('Model_Services');
        $dataliste['title'] = "Demande de droit de conge";
        $dataliste['pages'] = "insertion_absence";
        $dataliste['id_service'] = $this->session->userdata("id_service");
        $dataliste['employe'] = $this->model_generalise->findAll('employe');
        $this->load->view('pages-template-admin', $dataliste);
    }

    public function trait_conge_absence(){
        $this->load->model('Model_Conge');

        $conge_deduit = $this->input->get('reste_conge');
        $absence_ajoute = $this->input->get('absence_ajoute');
        $n_matricule = $this->input->get('n_matricule');
        $mois = $this->input->get('mois');
        $annee = $this->input->get('annee');

        $this->Model_Conge->modifier_reste_conge($n_matricule, 0);
        $this->Model_Conge->ajouter_absence($n_matricule,$absence_ajoute,$mois,$annee);
        $this->accueil();
    }
}

?>