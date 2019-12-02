<?php

class Forum extends CI_Controller
{
	private $titre_defaut;

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();

		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->titre_defaut = 'Mon super site';
		echo 'Bonjour !';
	}
	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		echo 'Hello World!';
	}

	//	Cette page accepte une variable $_GET facultative
	public function bonjour($pseudo = '')
	{
		echo 'Salut à toi : ' . $pseudo;
	}

	//	Cette page accepte deux variables $_GET facultatives
	public function manger($plat = '', $boisson = '')
	{
		echo 'Voici votre menu : <br />';
		echo $plat . '<br />';
		echo $boisson . '<br />';
		echo 'Bon appétit !';
	}
}
