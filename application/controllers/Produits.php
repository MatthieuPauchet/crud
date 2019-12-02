<?php
defined('BASEPATH') OR exit('No direct script access allowed');      
 
// application/controllers/Produits.php


class Produits extends CI_Controller 
{
 
    public function liste()
    {
    // Dans le tableau, on crée une donnée 'prénom' qui a pour valeur 'Dave'    
    // $data["prenom"] = "Dave";
    // $data["nom"] = "Grohl";
    // $data = array("Donna Lee", "So What", "Maiden Voyage", "Kind of Blue", "A Night in Tunisia");
 
    // On passe le tableau en second argument de la méthode 
    $this->load->view('liste');
    }
}
