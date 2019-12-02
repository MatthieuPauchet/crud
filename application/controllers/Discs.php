<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discs extends CI_Controller
{

  public function accueil()
  {
    $requete = $this->db->query("select * from disc natural join artist");

    $data["liste"] = $requete->result();

    $this->load->view("discs/header");
    $this->load->view("discs/accueil", $data);
    $this->load->view("discs/footer");
  }

  public function detail($id)
  {
    $requete = $this->db->query("select * from disc natural join artist where disc_id=?", array($id));
    $data["disc"] = $requete->row();

    $requete = $this->db->query("select distinct artist_name, artist_id from artist");
    $data["artists"] = $requete->result();

    $this->load->view("discs/header");
    $this->load->view("discs/detail", $data);
    $this->load->view("discs/footer");
  }

  public function update_form($id)
  {
    $requete = $this->db->query("select * from disc natural join artist where disc_id=?", array($id));
    $data["disc"] = $requete->row();

    $requete = $this->db->query("select distinct artist_name, artist_id from artist");
    $data["artists"] = $requete->result();



    $this->form_validation->set_rules('disc_title', 'titre disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_year', 'année disque',  'regex_match[/^[0-9]{4}$/]');
    $this->form_validation->set_rules('disc_genre', 'genre disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_label', 'label disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_price', 'prix disque',  'regex_match[/^[0-9]{1,4}[,.]{0,2}[0-9]{0,2}$/]');

    if ($this->input->post() && $this->form_validation->run()) {

      $this->output->enable_profiler(TRUE);

      $tab = $this->input->post();

      //$this->db->query("insert into artist (artist_name) values (?)", array($name));

      $this->db->update("disc", $tab, "disc_id=$id");

      // redirect(site_url("discs/accueil"));
    } else {
      // $data["artist"] = $this->db->query("select * from artist where artist_id=?", array($id))->row();
      $this->load->view("discs/header");
      $this->load->view("discs/update_form", $data);
      $this->load->view("discs/footer");
    }
  }

  public function add_form()
  {

    $requete = $this->db->query("select distinct artist_name, artist_id from artist");
    $data["artists"] = $requete->result();

  

    $this->form_validation->set_rules('disc_title', 'titre disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_year', 'année disque',  'regex_match[/^[0-9]{4}$/]');
    $this->form_validation->set_rules('disc_genre', 'genre disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_label', 'label disque',  'regex_match[/^[a-zA-Z0-9_-]+$/]');
    $this->form_validation->set_rules('disc_price', 'prix disque',  'regex_match[/^[0-9]{1,4}[,.]{0,2}[0-9]{0,2}$/]');

    // On créé un tableau de configuration pour l'upload
    $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
    $config['file_name'] = 'disc_picture'; // nom du fichier final $data[disc_title]
    $config['allowed_types'] = 'gif|jpg|png'; // Types autorisés (ici pour des images)

    // On initialise la config 
    $this->upload->initialize($config);



    // autre méthode pouvant gerer la longueur min/max ainsi que le caractère unique (is_unique)
    // $this->form_validation->set_rules(
    // 	'artist_name', 
    // 	'Le nom de l\'artiste',
    // 	'required|min_length[5]|max_length[12]|is_unique[artist.artist_name]',

    // );

    if ($this->input->post() && $this->form_validation->run()) {

      $this->output->enable_profiler(TRUE);

      $tab = $this->input->post();

      // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
      if (!$this->upload->do_upload("disc_picture")) {
        
        // Echec,  on réaffiche le formulaire
        $this->load->view("discs/header");
        $this->load->view("discs/add_form", $data);
        $this->load->view("discs/footer");
      } else { // Succès, on redirige sur la liste
        // rename le 'maphoto.jpg' en disc_title 
        $this->db->insert("disc", $tab);
        // $this->output->enable_profiler(TRUE);
        // var_dump($this->upload->data());die ();

        redirect(site_url("discs/accueil"));
      }

      //$this->db->query("insert into artist (artist_name) values (?)", array($name));
      // $this->db->insert("disc", $tab);

    //   redirect(site_url("discs/accueil"));
    } else {
      $this->load->view("discs/header");
      $this->load->view("discs/add_form", $data);
      $this->load->view("discs/footer");     

    }
  }

  public function delete_form($id)
  {

    $requete = $this->db->query("select * from disc natural join artist where disc_id=?", array($id));
    $data["disc"] = $requete->row();

    $requete = $this->db->query("select distinct artist_name, artist_id from artist");
    $data["artists"] = $requete->result();

    // $requete = $this->db->query("select distinct artist_name, artist_id from artist");
    // $data["artists"] = $requete->result();
    if ($this->input->post()) {

      $this->output->enable_profiler(TRUE);

      $id = $this->input->post();

      $this->db->delete("disc", $id);

      redirect(site_url("discs/accueil"));
    } else {
      $this->load->view("discs/header");
      $this->load->view("discs/delete_form", $data);
      $this->load->view("discs/footer");
    }
  }
}
