<?php

// Vérification de la validité des informations;
if (isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['birthday']) AND isset($_POST['email_registration']) AND isset($_POST['pseudo_registration']) AND isset($_POST['password']) AND isset($_POST['password_verif']))
{
	$firstname = strip_tags($_POST['firstname']);
	$lastname = strip_tags($_POST['lastname']);
	$birthday = strip_tags($_POST['birthday']);
}
else
{
	$_SESSION = array();
	session_destroy();
	header('Location: ../index.php?err_bien_essaye');
}

// Connection à la base de données;
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


// Vérification de la disponibilité de l'email et du pseudo;
// --------------------------------------------------------------------------------------------------------------------

$val_email = true;
$val_pseudo = true;
while ($donnee = $reponse->fetch())
{
	// Vérification de la disponibilité de l'email;
	if ($_POST['email_registration'] == $donnee['email'])
	{
		$val_email = false; // error_registration == 3;
	}

	// Vérification de la disponibilité du pseudo;
	if ($_POST['pseudo_registration'] == $donnee['pseudo'])
	{
		$val_pseudo = false; // error_registration == 4;
	}
}

$email = strip_tags($_POST['email_registration']);
$pseudo = strip_tags($_POST['pseudo_registration']);


// Hachage du mot de passe;
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

// Si toutes les conditions sont validées, on issert le visiteur dans la
// base de données;
// --------------------------------------------------------------------------------------------------------------------

if ($val_pseudo AND $val_password AND $val_email) // Si tout ce passe bien...
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
			'icone_session' => '"logo_anonyme"'));

		$_SESSION = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'birthday' => $birthday,
		    'email' => $email,
		    'pseudo' => $pseudo);
		    
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

		$resultats = '';
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
}
else // Sinon on redirige vers l'index.
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
if ($resultats == '') { $resultats = '&good_job!'; }
header('Location: connection_control.php?inscription' . $resultats);

?>
