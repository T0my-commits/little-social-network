<?php

// Functions;
function countMsg()
{
	// Connection to db;
	$db = dbConnect();

	// Count all messages which are posted;
	try
	{
		$tips = $db->query('SELECT COUNT(*) FROM tips');
		$nbTips = $tips->fetch();

		$taps = $db->query('SELECT COUNT(*) FROM taps');
		$nbTaps = $taps->fetch();

		$nbMsg = $nbTips[0] + $nbTaps[0];
		return array($nbMsg, $nbTips[0], $nbTaps[0]);
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->fetMessage());
	}
}

function countMembers()
{
	// Connection to db;
	$db = dbConnect();

	// Count all Members;
	try
	{
		$members = $db->query('SELECT COUNT(*) FROM members');
		$nbMembers = $members->fetch();
		return $nbMembers;
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->fetMessage());
	}
}

function getTips($page)
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

    $firstEntry = ($page - 1) * 15;

	if (isset($research))
	{
		try {
			$answers = $db->prepare('SELECT *, DATE_FORMAT(send_date, "%d.%m.%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips WHERE tags = :research ORDER BY send_date DESC LIMIT ' . $firstEntry . ', 15'); // Exposure to a security breach I guess;
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
		$answers = $db->query('SELECT *, DATE_FORMAT(send_date, "%d.%m.%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips ORDER BY send_date DESC LIMIT ' . $firstEntry . ' , 15'); // Exposure to a security breach I guess;
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
    	'tip' => nl2br($tip), 
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

function postTaps($msg, $ID_TIP)
{
	// Connection to db;
	$db = dbConnect();

	// Add a new tip;
    $comments = $db->prepare('INSERT INTO taps(ID_TIP, msg, send_date, alert, autor) VALUES(:ID_TIP, :msg, CURDATE(), :alert, :autor)');
    $affectedLines = $comments->execute(array(
    	'ID_TIP' => $ID_TIP, 
    	'msg' => nl2br($msg),
    	'alert' => 0, 
    	'autor' => $_SESSION['id'])); // Potentiellement une faille de sécurité ici;

    return $affectedLines;
}

function addTaps($msg, $ID_TIP)
{
    $affectedLines = postTaps($msg, $ID_TIP);
	header('Location: tiptap_control.php');
}

function rePostMsg($type, $msg, $ID)
{
	// Connection to db;
	$db = dbConnect();

	// Update tip;
	if ($type == 'tips') {
	    $comments = $db->prepare('UPDATE tips SET msg = :msg WHERE id = :ID');
	    $affectedLines = $comments->execute(array(
	    	'msg' => nl2br($msg),
	    	'ID' => $ID
	    ));
	}
	elseif ($type == 'taps') {
	    $comments = $db->prepare('UPDATE taps SET msg = :msg WHERE id = :ID');
	    $affectedLines = $comments->execute(array(
	    	'msg' => nl2br($msg),
	    	'ID' => $ID
	    ));
	}
	else {
		header('Location: tiptap_control.php');
	}

    return $affectedLines;
}

function updateMsg($type, $msg, $ID)
{
    $affectedLines = rePostMsg($type, $msg, $ID);
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