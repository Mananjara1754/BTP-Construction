<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_generalise');
    }
    public function getTotalDevis(){
        $sql = "select sum(montant_devis) as total,sum(montant_payee)as payee,sum(montant_devis_sans) as total_sans from devis;";
        return $this->model_generalise->findByRequest($sql);
    }
    public function getMaisonPlusVendu(){
        return $this->model_generalise->findByRequest("select nom_maison,count(nom_maison) as nb from devis
        where EXTRACT(Year from date_devis) = null
        GROUP by nom_maison;");
    }
    public function getMontantMois(){
        $sql = "select 
        EXTRACT(MONTH from date_devis) AS mois,
        sum(devis.montant_devis) as montant
        from devis 
        group by mois
        ";
        return $this->model_generalise->findByRequest($sql);
    }
    public function getMontantByAnnee($annee){
        $sql = "select
        EXTRACT(MONTH from date_devis) AS mois,
        sum(devis.montant_devis) as montant
        from devis where EXTRACT(YEAR from date_devis) = ".$annee."
        group by mois";
        return $this->model_generalise->findByRequest($sql);
    }
    public function getMontantAnnee(){
        $sql = "select 
        EXTRACT(Year from date_devis) AS annee,
        sum(devis.montant_devis) as montant
        from devis 
        group by annee;";
        return $this->model_generalise->findByRequest($sql);
    }

   
}
?>