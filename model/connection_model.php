<?php

function checkUser() {
	$_error = false;
	// Checking connection data;
	// ------------------------------------------------------------------------------------------------------------;

	// Checking that all the fields have been filled;
	if (! isset($_POST['pseudo']) OR ! isset($_POST['password']))
	{
		$_error = true;
	}
	$pseudo = htmlspecialchars(strip_tags($_POST['pseudo']));

	// Connection to database;
	$bdd = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');

	// Password match check;
	$req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
	$req->execute(array(
	    'pseudo' => $pseudo));
	$resultat = $req->fetch();
	
	$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']); // Exposure to a security breach I guess;

	if (!$resultat)
	{
	    $_error = true;
	    header('Location: ../control/members_control.php?connection&_error');
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
		header('Location: ../../index.php');
	    }
	    else {
		$_error = true;
	    	header('Location: ../control/members_control.php?connection&_error');
	    }
	}

	$req->closeCursor();
}

function disconnection() {
	session_start();
	// Deteting sessions variables;
	$_SESSION = array();
	session_destroy();

	// Deleting automatic connetion cookies;
	//setcookie('login', '');
	//setcookie('pass_hache', '');
}
