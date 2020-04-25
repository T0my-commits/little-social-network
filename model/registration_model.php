<?php

function addUser() {
	// Checking the validity of the informations;
	$firstname = htmlspecialchars(strip_tags($_POST['firstname']));
	$lastname = htmlspecialchars(strip_tags($_POST['lastname']));
	$birthday = htmlspecialchars(strip_tags($_POST['birthday']));

	// Connection to database;
	// --------------------------------------------------------------------------------------------------------------------
	try
	{
		echo "[ good ] Connection à la base de données...";
		$base_de_donnees = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$reponse = $base_de_donnees->query('SELECT * FROM members');


	// Checking availability of email and nickname;
	// --------------------------------------------------------------------------------------------------------------------

	$val_email = true;
	$val_pseudo = true;
	while ($donnee = $reponse->fetch())
	{
		// Email availability check;
		if ($_POST['email_registration'] == $donnee['email'])
		{
			$val_email = false; // error_registration == 3;
		}

		// Nickname availability check;
		if ($_POST['pseudo_registration'] == $donnee['pseudo'])
		{
			$val_pseudo = false; // error_registration == 4;
		}
	}

	$email = htmlspecialchars(strip_tags($_POST['email_registration']));
	$pseudo = htmlspecialchars(strip_tags($_POST['pseudo_registration']));


	// Password hash;
	// --------------------------------------------------------------------------------------------------------------------

	$val_password = true;
	if ($_POST['password'] == $_POST['password_verif'])
	{
		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
	}
	else
	{
		$val_password = false; // error_registration == 2;
	}

	// If all the conditions are validated, the visitor is added to the
	// database;
	// --------------------------------------------------------------------------------------------------------------------

	if ($val_pseudo AND $val_password AND $val_email) // If all goes well...
	{
		try
		{
			$req = $base_de_donnees->prepare('INSERT INTO members(firstname, lastname, birthday, email, pseudo, password, icone_session, registration_day) VALUES(:firstname, :lastname, :birthday, :email, :pseudo, :password, :icone_session, CURDATE())');
			$req->execute(array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'birthday' => $birthday,
			    'email' => $email,
			    'pseudo' => $pseudo,
			    'password' => $pass_hache,
				'icone_session' => $_POST['password']));

			$_SESSION = array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'birthday' => $birthday,
			    'email' => $email,
			    'pseudo' => $pseudo);
			    
			// We are looking for the member's id to create a session variable (because $ _SESSION ['id'] was not created at registration).
			// We connect to the database and we look for the member;
			$bdd = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');
			$req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
				$req->execute(array(
				    'pseudo' => $_SESSION['pseudo']));
				$resultat = $req->fetch();

				if (! $resultat) {
					throw new Exception("Error Processing Request");
				}

			// Defining the session variable 'id' for the member;
			$_SESSION['id'] = $resultat['id'];

			$resultats = '';
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
	else // Else redirection to the index.
	{
		$tableau = array($val_pseudo, $val_email, $val_password);

		foreach($tableau as $keys => $values)
		{
			echo 'keys == ' . $keys;
			echo 'values == ' . $values;
		    if ($values == false)
		    {
		    	if ($keys == 0)
		    	{
		    		$resultats = $resultats . '&err_pseudo';
		    	}
		    	elseif ($keys == 1)
		    	{
		    		$resultats = $resultats . '&err_email';
		    	}
		    	elseif ($keys == 2)
		    	{
		    		$resultats = $resultats . '&err_password';
		    	}
		    }
		}
	}

	$reponse->closeCursor();
	
	if ($resultats == '') {
	header('Location: ../index.php');
	}
	else {
	header('Location: ../control/members_control.php?inscription' . $resultats);
	}
}

?>
