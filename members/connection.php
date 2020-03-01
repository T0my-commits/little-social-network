<?php

$_error = false;
if (isset($_POST['pseudo']) AND isset($_POST['password']))
{
	// Brute force attack protection;
	sleep(1);
	// On vérifie les données de connection;
	// ------------------------------------------------------------------------------------------------------------;

	// On vérifie que tout les champs on été remplis;
	if (! isset($_POST['pseudo']) OR ! isset($_POST['password']))
	{
		$_error = true;
	}
	$pseudo = htmlspecialchars(strip_tags($_POST['pseudo']));

	// Connection avec la base de données;
	$bdd = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');

	// On vérifie que les mots de passe sont bien indentiques;
	//  Récupération de l'utilisateur et de son pass hashé;
	$req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
	$req->execute(array(
	    'pseudo' => $pseudo));
	$resultat = $req->fetch();

	// Comparaison du pass envoyé via le formulaire avec la base;
	$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']); // Exposure to a security breach I guess;

	if (!$resultat)
	{
	    $_error = true;
	    header('Location: connection_control.php?connection&_error');
	}
	else
	{
	    if ($isPasswordCorrect) {
	        session_start();
			$_SESSION = array(
				'id' => $resultat['id'],
				'firstname' => $resultat['firstname'],
				'lastname' => $resultat['lastname'],
				'birthday' => $resultat['birthday'],
			    'email' => $resultat['email'],
			    'pseudo' => $resultat['pseudo']);
	        header('Location: ../index.php');
	    }
	    else {
	        $_error = true;
	    	header('Location: connection_control.php?connection&_error');
	    }
	}

	$req->closeCursor();
}
