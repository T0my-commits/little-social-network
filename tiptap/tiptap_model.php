<?php

// Functions;
function getTips()
{
	$tags = array("Licences et Licences pro",
					"Dentaire",
					"Médecine",
					"Pharmacie",
					"Maïeutique",
					"Kinésithérapie",
					"Paramédical",
					"DEUST",
					"DUT",
					"Design (lycée)",
					"BTS",
					"Prépa sciences",
					"Prépa éco",
					"Prépa lettres",
					"Grandes écoles post bac (Ingénieurs, commerce, arts...)",
					"Institut d'études politiques",
					"Comptabilité",
					"Social",
					"Paramédical",
					"Design (école)",
					"Beaux-Arts",
					"Architecture",
					"Autres écoles (vente, industrie, tourisme, transports, communication...)");

	// Vérification des paramètres;
	if (isset($_GET['choose_tags'])) {
		$research = strip_tags($_GET['choose_tags']);
		$error = true;
		$i = 1;
		while ($i < count($tags)) {
			if ($research == $tags[$i]) {
				$error = false;
				$i++;
			}
			$i++;
		}
		if ($error == true) {
			header('Location: tiptap_control.php');
		}
	}

	// Connection to db;
	$db = dbConnect();

	// We're trying to get tips & taps that user was selected.
	// If nothing selected, show all;

	if (isset($_GET['page'])) {
		$page = strip_tags($_GET['page']);
		$page = $page*30;
	}
	else {
		$page = 0;
	}

	if (isset($research))
	{
		try {
			$answers = $db->prepare('SELECT *, DATE_FORMAT(send_date, "%d/%m/%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips WHERE tags = :research ORDER BY send_date DESC LIMIT 0, 30');
			$answers->execute(array(
				'research' => $research));
		}
	    catch(Exception $e)
	    {
			throw new Exception('Impossible de récupérer les derniers Tips :/');
	        die('Erreur : '.$e->getMessage());
			header('Location: tiptap_control.php');
	    }
	}
	else
	{
		$answers = $db->prepare('SELECT *, DATE_FORMAT(send_date, "%d/%m/%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips ORDER BY send_date DESC LIMIT 0, 30');
		$answers->execute(array(
			'page' => $page));
	}

	// Return answers;
	return $answers;
}

function getTaps($id_tips)
{
	// Connection to db;
	$db = dbConnect();

	// Get Taps where ID_TIPS is $id_tips;
	try
	{
		$taps = $db->prepare('SELECT * FROM taps WHERE ID_TIP = :id_tips ORDER BY send_date ASC');
		$taps->execute(array(
			'id_tips' => $id_tips));
		return $taps;
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->fetMessage());
	}
}

function postTips($tip, $tags)
{
	// Connection to db;
	$db = dbConnect();

	// Add a new tip;
    $comments = $db->prepare('INSERT INTO tips(msg, tags, send_date, no_answers, alert, autor) VALUES(:tip, :tags, NOW(), :no_answers, :alert, :autor)');
    $affectedLines = $comments->execute(array(
    	'tip' => $tip, 
    	'tags' => $tags, 
    	'no_answers' => 1, 
    	'alert' => 0, 
    	'autor' => $_SESSION['id'])); // Potentiellement une faille de sécurité ici;

    return $affectedLines;
}

function addTips($tips, $tags)
{
    $affectedLines = postTips($tips, $tags);
	header('Location: tiptap_control.php');
}

function postComment($ID_TIP, $msg)
{
	// Connection to db;
	$db = dbConnect();

	// Add a new tip;
    $comments = $db->prepare('INSERT INTO taps(ID_TIP, msg, send_date, alert, autor) VALUES(:ID_TIP, :msg, NOW(), :alert, :autor)');
    $affectedLines = $comments->execute(array(
    	'ID_TIP' => $ID_TIP, 
    	'msg' => $msg,
    	'alert' => 0, 
    	'autor' => $_SESSION['id'])); // Potentiellement une faille de sécurité ici;

    return $affectedLines;
}

function addComment($ID_TIP, $msg)
{
    $affectedLines = postTips($ID_TIP, $msg);
	header('Location: tiptap_control.php');
}

function dbConnect()
{
	// Connection to db;
	try
    {
		$db = new PDO('mysql:host=localhost;dbname=unaware;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

}