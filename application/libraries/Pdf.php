<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-Type: text/html; charset=utf-8');
require_once "fpdf/fpdf.php";

class Pdf extends FPDF {
    public $title;
    // Colored table
    // Colored table
    function CreatePDFTable($nb_rows, $header, $data, $indice_total, $data_total)
    {
        $this->SetKeywords('PDF, exemple, encodage, UTF-8');
        $this->AliasNbPages();
        $this->SetAutoPageBreak(true, 10);

        // Colors, line width and bold font
        $this->SetFillColor(58, 59, 69);
        $this->SetTextColor(255);
        $this->SetFont('Arial','B');

        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($nb_rows[$i],12, utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial');

        $keys = array_keys($data[0]);

        // Data
        foreach ($data as $row) {
            $i = 0;
            foreach ($keys as $key) {
                if (is_numeric(trim($row[$key])))
                    $this->Cell($nb_rows[$i],12, number_format($row[$key], 0, '.', " "), 1, 0, 'R');
                else
                    $this->Cell($nb_rows[$i],12, utf8_decode($row[$key]), 1, 0, 'L');
                $i++;
            }
            $this->Ln();
        }

        // Closing line
        $this->Cell($nb_rows[0], 12, 'Total', 1, 0, 'L');
        $k = 0;
        for ($j = 1; $j < count($nb_rows); $j++) {
            if (in_array($j, $indice_total)) {
                $this->Cell($nb_rows[$j], 12, number_format($data_total[$k], 0, '.', ' '), 1, 0, 'R');
                $k++;
            }else {
                $this->Cell($nb_rows[$j], 12, ' ', 1, 0, 'R');
            }
        }
    }


    // Colored table
    // function CreatePDFTableEntrainement($nb_rows, $header, $data, $indice_total, $data_total)
    // {
    //     $this->SetKeywords('PDF, exemple, encodage, UTF-8');
    //     $this->AliasNbPages();
    //     $this->SetAutoPageBreak(true, 10);

    //     // Colors, line width and bold font
    //     $this->SetFillColor(58, 59, 69);
    //     $this->SetTextColor(255);
    //     $this->SetFont('Arial','B');

    //     // Header
    //     for($i=0;$i<count($header);$i++)
    //         $this->Cell($nb_rows[$i],12, utf8_decode($header[$i]),1,0,'C',true);
    //     $this->Ln();

    //     // Color and font restoration
    //     $this->SetFillColor(255,255,255);
    //     $this->SetTextColor(0);
    //     $this->SetFont('Arial');

    //     foreach ($data["all_proposition"] as $ent) {
    //         $this->Write(0, $ent["jour"] . " Jour", '', 0, 'L', true, 0, false, false, 0);
    //         $this->Ln(10); // Ajouter un espace vertical de 10 points
    
    //         foreach ($ent["entrainement"] as $ee) {
    //             $this->Write(0, $ee["nom_activite"] . " nb reps " . $ee["nb_repetition"] . " x " . $ee["nb_seances"], '', 0, 'L', true, 0, false, false, 0);
    //             $this->Ln(10); // Ajouter un espace vertical de 10 points
    //         }
    
    //         foreach ($ent["regime"] as $ee) {
    //             $this->Write(0, $ee["nom_regime"] . " regime " . $ee["nom_element"], '', 0, 'L', true, 0, false, false, 0);
    //             $this->Ln(10); // Ajouter un espace vertical de 10 points
    //         }
    //         $this->Ln(10); // Ajouter un espace vertical de 10 points
    //     }

        
    //     $this->Ln(10); // Ajouter un espace vertical de 10 points

    //     // Afficher le prix total
    //     $this->Write(0, "Prix total : " . $data["prix_total"], '', 0, 'L', true, 0, false, false, 0);
    
    // }

    function CreatePDFTableEntrainement($nb_rows, $header, $data, $indice_total, $data_total)
    {
        $this->SetKeywords('PDF, exemple, encodage, UTF-8');
        $this->AliasNbPages();
        $this->SetAutoPageBreak(true, 10);

        // Colors, line width and bold font
        $this->SetFillColor(58, 59, 69);
        $this->SetTextColor(255);
        $this->SetFont('Arial','B');

        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell(45,10, utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial');

        $cellWidth = 45;
        $cellHeight = 10;

        foreach ($data["all_proposition"] as $ent) {
            // Afficher le jour
            $this->Ln(10); // Ajouter un espace vertical de 10 points entre les jours
            $str_regime = $ent["regime"][0]["nom_regime"] ." : ";

            foreach ($ent["regime"] as $ee) {
                // Afficher les données du régime
                // $this->Cell($cellWidth, $cellHeight, $ee["nom_regime"], 1, 0, 'C', false);
                // $this->Cell($cellWidth, $cellHeight, '', 1, 0, 'C', false);
                // $this->Cell($cellWidth, $cellHeight, '', 1, 0, 'C', false);
                // $this->Cell($cellWidth, $cellHeight, '', 1, 0, 'C', false);
                $str_regime .=  $ee["nom_element"]. ', ';

                // $this->Ln(); // Aller à la ligne
            }

            $str_regime = substr($str_regime, 0, -2); // Suppression des deux derniers caractères (', ')

            $this->Write(0, "Jour ".$ent["jour"], '', 0, 'L', true, 0, false, false, 0);
            $this->Ln(10);
            $this->Write(0, $str_regime, '', 0, 'L', true, 0, false, false, 0);
    
            $this->Ln(10); // Aller à la ligne
    
            foreach ($ent["entrainement"] as $ee) {
                // Afficher les données de l'entraînement
                // $this->Cell($cellWidth, $cellHeight, $ee["nom_regime"], 1, 0, 'C', false);
                $this->Cell($cellWidth, $cellHeight, $ee["nom_activite"], 1, 0, 'C', false);
                $this->Cell($cellWidth, $cellHeight, $ee["nb_repetition"], 1, 0, 'C', false);
                $this->Cell($cellWidth, $cellHeight, $ee["nb_seances"], 1, 0, 'C', false);
    
                $this->Ln(); // Aller à la ligne
            }
    
           
    
            $this->Ln(10); // Ajouter un espace vertical de 10 points entre les jours
        }
    
        // Afficher le prix total
        $this->Ln();
        // $this->Cell($cellWidth, $cellHeight, "Prix total : " . $data["prix_total"], 0, 0, 'L', false);

        // Afficher le prix total
        $this->Write(0, "Prix total : " . $data["prix_total"], '', 0, 'L', true, 0, false, false, 0);
    
    }

    // Page header
    function Header()
    {
        // Logo
        $this->Image(base_url()."assets/img/logo.png",10,6,20);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(70,10, utf8_decode($this->title),1,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}