<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function accueil()
	{
        $requete = $this->db->query("select * from artist");

        $data["liste"] = $requete->result();

		$this->load->view("header");
		$this->load->view("crud/accueil", $data);
		$this->load->view("footer");
    }
    
    public function detail($id)
	{
        $requete = $this->db->query("select * from artist where artist_id=?", array($id));

        $data["artist"] = $requete->row();


		$this->load->view("header");
		$this->load->view("crud/detail", $data);
		$this->load->view("footer");
    }
    
    public function page3()
	{
		$this->load->view("header");
		$this->load->view("produit/page3");
		$this->load->view("footer");
	}
}
