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

            $this->db->update("disc", $tab, "disc_id=$id");

            // On créé un tableau de configuration pour l'upload
            $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
            $config['allowed_types'] = 'gif|jpg|png'; // Types autorisés (ici pour des images)
            $config['max_size']             = 100; // gestion taille max du fichier
            $config['max_width']            = 1024; // gestion des dimensions max de la photo
            $config['max_height']           = 768;

            // On initialise la config 
            $this->upload->initialize($config);

            // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
            if ($this->upload->do_upload("disc_picture")) {

                // stocke sous forme de tableau toutes les données du fichier téléchargé
                $res = $this->upload->data();

                // commande pour renommer le chemin et le fichier avec extension : rename ('chemin existant','chemin futur')
                rename($res["full_path"], $res["file_path"] . $id . $res["file_ext"]);

                //equivalent requête mysql avec codeigniter : UPDATE `disc` SET `disc_picture` = '$id.$res["file_ext"]' WHERE `disc_id` = $id
                $this->db->set('disc_picture', $id . $res["file_ext"]);
                $this->db->where('disc_id', $id);
                $this->db->update('disc');
            }

            redirect(site_url("discs/accueil"));
        } else {
            // $data["artist"] = $this->db->query("select * from artist where artist_id=?", array($id))->row();
            $this->load->view("discs/header");
            $this->load->view("discs/update_form", $data);
            $this->load->view("discs/footer");
        }
    }


    
    public function add_artist()
    {

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


        // autre méthode pouvant gerer la longueur min/max ainsi que le caractère unique (is_unique)
        // $this->form_validation->set_rules(
        // 	'artist_name', 
        // 	'Le nom de l\'artiste',
        // 	'required|min_length[5]|max_length[12]|is_unique[artist.artist_name]',

        // );

        if ($this->input->post() && $this->form_validation->run()) {

            // permet l'affichage de toutes les tâches effectuées
            $this->output->enable_profiler(TRUE);

            // récupère sous forme de tableau le post du formulaire
            $tab = $this->input->post();

            // afin d'insérer une ligne dans la table disque et de récupérer l'id de l'insert on ouvre une transaction
            $this->db->trans_start();
            $this->db->insert("disc", $tab);
            $id = $this->db->insert_id();
            $this->db->trans_complete();

            // On créé un tableau de configuration pour l'upload
            $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
            $config['allowed_types'] = 'gif|jpg|png'; // Types autorisés (ici pour des images)
            $config['max_size']             = 100; // gestion taille max du fichier
            $config['max_width']            = 1024; // gestion des dimensions max de la photo
            $config['max_height']           = 768;

            // On initialise la config 
            $this->upload->initialize($config);

            // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
            if ($this->upload->do_upload("disc_picture")) {

                // stocke sous forme de tableau toutes les données du fichier téléchargé
                $res = $this->upload->data();

                // commande pour renommer le chemin et le fichier avec extension : rename ('chemin existant','chemin futur')
                rename($res["full_path"], $res["file_path"] . $id . $res["file_ext"]);

                //equivalent requête mysql avec codeigniter : UPDATE `disc` SET `disc_picture` = '$id.$res["file_ext"]' WHERE `disc_id` = $id
                $this->db->set('disc_picture', $id . $res["file_ext"]);
                $this->db->where('disc_id', $id);
                $this->db->update('disc');
            }
            redirect(site_url("discs/accueil"));
        } else {
            // premier affichage de la page (sans aucun téléchargement)
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
