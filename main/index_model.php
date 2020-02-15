<?php

function searchID()
{
	// On cherche l'id du membre pour créer un variable de session (car $_SESSION['id'] n'a pas été crée à l'incription);
	// On se connecte à la base de données et on cherche le membre;
	$bdd = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');
	$req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
		$req->execute(array(
		    'pseudo' => $_SESSION['pseudo']));
		$resultat = $req->fetch();

		if (! $resultat) {
			throw new Exception("Error Processing Request");
		}

	// On défini la variable de session 'id' pour le membre;
	$_SESSION['id'] = $resultat['id'];
}