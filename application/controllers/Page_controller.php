<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->library('pdf');
        
    }

    public function test() {
		$this->load->model('model_user');
        echo "Test";
		$nom = "Test";
		$mail = "Test";
		$mdp = "Test";
		$dateNaissance = "2001-10-10"; 
		$id_genre = 1;
		$taille = 10;
		$poids = 10;
		try {
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
		
		$all_entrainement= $this->model_user->getEntrainement_jour(4, 1, 10);
		$entrainement_jour = $all_entrainement["all_proposition"];

		foreach($entrainement_jour as $ent) {
			echo $ent["jour"]."Jour";
			foreach($ent["entrainement"] as $ee) {
				echo $ee["nom_activite"]." nb reps ".$ee["nb_repetition"]." x ".$ee["nb_seances"]."</br></br>";
			}
			foreach($ent["regime"] as $ee) {
				echo $ee["nom_regime"]." regime ".$ee["nom_element"]."</br></br>";
			}
		}
		$prix_total = $all_entrainement["prix_total"];
		echo $prix_total; 

		


		
    }

	function PDF_entrainement() {
		$this->load->model('model_user');
       
        // Créer une nouvelle instance de la classe Pdf
        $pdf = new PDF();
        $pdf->title = "Entrainement";
        $all_entrainement= $this->model_user->getEntrainement_jour(4, 1, 10);
		$results = $all_entrainement["all_proposition"];
		$prix_total = $all_entrainement["prix_total"];
        $pdf->AddPage();
        $pdf->CreatePDFTableEntrainement([28, 33, 30, 30, 32, 32], ["Activite", "Repetitions", "Seances"], $all_entrainement, [4, 5], [$prix_total]);
        $pdf->Output();
    }
	

    
    

}
?>
