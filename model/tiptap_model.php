<?php

// Functions;
function countMsg()
{
	// Connection to db;
	$db = dbConnect();

	// Count all messages which are posted;
	try
	{
		if (isset($_GET['choose_tags'])) {
			$choose_tags = htmlspecialchars(strip_tags($_GET['choose_tags']));
			$tips = $db->prepare('SELECT COUNT(*) FROM tips WHERE tags = :tags');
			$tips->execute(array('tags' => $choose_tags));
			$nbTips = $tips->fetch();
		}
		else {
			$tips = $db->query('SELECT COUNT(*) FROM tips');
			$nbTips = $tips->fetch();
		}

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
		$research = htmlspecialchars(strip_tags($_GET['choose_tags']));
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
			header('Location: ../control/tiptap_control.php');
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
			$answers = $db->prepare('SELECT *, DATE_FORMAT(send_date, "%d.%m.%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips WHERE tags = :research ORDER BY send_date DESC LIMIT ' . $firstEntry . ', 15'); // Exposure to a SQL security breach I guess;
			$answers->execute(array(
				'research' => $research));
		}
	    catch(Exception $e)
	    {
			throw new Exception('Impossible de récupérer les derniers Tips :/');
	        die('Erreur : '.$e->getMessage());
			header('Location: ../control/tiptap_control.php');
	    }
	}
	else
	{
		$answers = $db->query('SELECT *, DATE_FORMAT(send_date, "%d.%m.%Y") AS day_send_date, DATE_FORMAT(send_date, "%Hh%imin%ss") AS hour_send_date FROM tips ORDER BY send_date DESC LIMIT ' . $firstEntry . ' , 15'); // Exposure to a SQL security breach I guess;
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
	header('Location: ../control/tiptap_control.php');
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
	header('Location: ../control/tiptap_control.php');
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
		header('Location: ../control/tiptap_control.php');
	}

    return $affectedLines;
}

function updateMsg($type, $msg, $ID)
{
    $affectedLines = rePostMsg($type, $msg, $ID);
	header('Location: ../control/tiptap_control.php');
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




function replaceSmiley($string)
{
	$smileys = array(':happy-18:', ':cool-5:', ':happy-17:', ':surprised-9:', ':shocked-4:', ':shocked-3:', ':nervous-2:', ':nervous-1:', ':angry-6:', ':drool:', ':tired-2:', ':tongue-7:', ':tongue-6:', ':tongue-5:', ':smile-1:', ':sleeping-1:', ':nervous:', ':surprised-8:', ':tongue-4:', ':happy-16:', ':wink-1:', ':laughing-2:', ':laughing-1:', ':sweat-1:', ':happy-15:', ':happy-14:', ':laughing:', ':happy-13:', ':happy-12:', ':crying-8:', ':crying-7:', ':bored:', ':cool-4:', ':angry-5:', ':sad-14:', ':angry-4:', ':happy-11:', ':angry-3:', ':cyclops-1:', ':surprised-7:', ':thinking-2:', ':book:', ':baby-boy:', ':dead-1:', ':star:', ':dubious:', ':phone-call:', ':moon:', ':robot:', ':flower:', ':happy-10:', ':happy-9:', ':tired-1:', ':ugly-3:', ':tongue-3:', ':vampire:', ':music-1:', ':popcorn:', ':nurse:', ':sad-13:', ':graduated-1:', ':happy-8:', ':hungry:', ':police:', ':crying-6:', ':happy-7:', ':sun:', ':father-2:', ':happy-6:', ':late:', ':heart:', ':sick-3:', ':sad-12:', ':in-love-10:', ':shocked-2:', ':happy-5:', ':shocked-1:', ':cool-3:', ':crying-5:', ':zombie:', ':pain:', ':cyclops:', ':sweat:', ':thief:', ':sad-11:', ':kiss-4:', ':father-1:', ':father:', ':angel-1:', ':happy-4:', ':sad-10:', ':outrage-1:', ':ugly-2:', ':ugly-1:', ':scared:', ':tongue-2:', ':sad-9:', ':nerd-9:', ':greed-2:', ':whistle:', ':nerd-8:', ':muted-4:', ':in-love-9:', ':in-love-8:', ':kiss-3:', ':in-love-7:', ':ugly:', ':nerd-7:', ':nerd-6:', ':crying-4:', ':muted-3:', ':nerd-5:', ':kiss-2:', ':greed-1:', ':pirate-1:', ':music:', ':confused-2:', ':nerd-4:', ':greed:', ':nerd-3:', ':crying-3:', ':cheering:', ':surprised-6:', ':muted-2:', ':sick-2:', ':graduated:', ':angry-2:', ':in-love-6:', ':cool-2:', ':confused-1:', ':sad-8:', ':nerd-2:', ':birthday-boy:', ':surprised-5:', ':selfie:', ':tongue-1:', ':smart-1:', ':smart:', ':surprised-4:', ':3d-glasses:', ':in-love-5:', ':sleeping:', ':pirate:', ':santa-claus:', ':wink:', ':in-love-4:', ':tired:', ':bang:', ':baby:', ':tongue:', ':sick-1:', ':outrage:', ':injury:', ':dead:', ':rich-1:', ':sick:', ':angel:', ':nerd-1:', ':crying-2:', ':crying-1:', ':muted-1:', ':surprised-3:', ':crying:', ':sad-7:', ':cool-1:', ':happy-3:', ':thinking-1:', ':muted:', ':confused:', ':happy-2:', ':thinking:', ':nerd:', ':in-love-3:', ':hypnotized:', ':cool:', ':shocked:', ':easter:', ':surprised-2:', ':surprised-1:', ':surprised:', ':furious:', ':sad-6:', ':sad-5:', ':sad-4:', ':sad-3:', ':angry-1:', ':rich:', ':sad-2:', ':happy-1:', ':sad-1:', ':sad:', ':smile:', ':in-love-2:', ':happy:', ':kiss-1:', ':in-love-1:', ':in-love:', ':kiss:', ':angry:', ':sleepy:');


	$imgSmiley = array(
"<img src='../pictures/smileys/png/001-happy-18.png' srcset='../pictures/smileys/svg/001-happy-18.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/002-cool-5.png' srcset='../pictures/smileys/svg/002-cool-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/003-happy-17.png' srcset='../pictures/smileys/svg/003-happy-17.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/004-surprised-9.png' srcset='../pictures/smileys/svg/004-surprised-9.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/005-shocked-4.png' srcset='../pictures/smileys/svg/005-shocked-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/006-shocked-3.png' srcset='../pictures/smileys/svg/006-shocked-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/007-nervous-2.png' srcset='../pictures/smileys/svg/007-nervous-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/008-nervous-1.png' srcset='../pictures/smileys/svg/008-nervous-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/009-angry-6.png' srcset='../pictures/smileys/svg/009-angry-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/010-drool.png' srcset='../pictures/smileys/svg/010-drool.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/011-tired-2.png' srcset='../pictures/smileys/svg/011-tired-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/012-tongue-7.png' srcset='../pictures/smileys/svg/012-tongue-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/013-tongue-6.png' srcset='../pictures/smileys/svg/013-tongue-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/014-tongue-5.png' srcset='../pictures/smileys/svg/014-tongue-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/015-smile-1.png' srcset='../pictures/smileys/svg/015-smile-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/016-sleeping-1.png' srcset='../pictures/smileys/svg/016-sleeping-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/017-nervous.png' srcset='../pictures/smileys/svg/017-nervous.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/018-surprised-8.png' srcset='../pictures/smileys/svg/018-surprised-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/019-tongue-4.png' srcset='../pictures/smileys/svg/019-tongue-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/020-happy-16.png' srcset='../pictures/smileys/svg/020-happy-16.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/021-wink-1.png' srcset='../pictures/smileys/svg/021-wink-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/022-laughing-2.png' srcset='../pictures/smileys/svg/022-laughing-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/023-laughing-1.png' srcset='../pictures/smileys/svg/023-laughing-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/024-sweat-1.png' srcset='../pictures/smileys/svg/024-sweat-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/025-happy-15.png' srcset='../pictures/smileys/svg/025-happy-15.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/026-happy-14.png' srcset='../pictures/smileys/svg/026-happy-14.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/027-laughing.png' srcset='../pictures/smileys/svg/027-laughing.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/028-happy-13.png' srcset='../pictures/smileys/svg/028-happy-13.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/029-happy-12.png' srcset='../pictures/smileys/svg/029-happy-12.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/030-crying-8.png' srcset='../pictures/smileys/svg/030-crying-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/031-crying-7.png' srcset='../pictures/smileys/svg/031-crying-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/032-bored.png' srcset='../pictures/smileys/svg/032-bored.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/033-cool-4.png' srcset='../pictures/smileys/svg/033-cool-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/034-angry-5.png' srcset='../pictures/smileys/svg/034-angry-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/035-sad-14.png' srcset='../pictures/smileys/svg/035-sad-14.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/036-angry-4.png' srcset='../pictures/smileys/svg/036-angry-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/037-happy-11.png' srcset='../pictures/smileys/svg/037-happy-11.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/038-angry-3.png' srcset='../pictures/smileys/svg/038-angry-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/039-cyclops-1.png' srcset='../pictures/smileys/svg/039-cyclops-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/040-surprised-7.png' srcset='../pictures/smileys/svg/040-surprised-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/041-thinking-2.png' srcset='../pictures/smileys/svg/041-thinking-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/042-book.png' srcset='../pictures/smileys/svg/042-book.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/043-baby-boy.png' srcset='../pictures/smileys/svg/043-baby-boy.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/044-dead-1.png' srcset='../pictures/smileys/svg/044-dead-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/045-star.png' srcset='../pictures/smileys/svg/045-star.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/046-dubious.png' srcset='../pictures/smileys/svg/046-dubious.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/047-phone-call.png' srcset='../pictures/smileys/svg/047-phone-call.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/048-moon.png' srcset='../pictures/smileys/svg/048-moon.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/049-robot.png' srcset='../pictures/smileys/svg/049-robot.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/050-flower.png' srcset='../pictures/smileys/svg/050-flower.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/051-happy-10.png' srcset='../pictures/smileys/svg/051-happy-10.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/052-happy-9.png' srcset='../pictures/smileys/svg/052-happy-9.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/053-tired-1.png' srcset='../pictures/smileys/svg/053-tired-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/054-ugly-3.png' srcset='../pictures/smileys/svg/054-ugly-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/055-tongue-3.png' srcset='../pictures/smileys/svg/055-tongue-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/056-vampire.png' srcset='../pictures/smileys/svg/056-vampire.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/057-music-1.png' srcset='../pictures/smileys/svg/057-music-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/058-popcorn.png' srcset='../pictures/smileys/svg/058-popcorn.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/059-nurse.png' srcset='../pictures/smileys/svg/059-nurse.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/060-sad-13.png' srcset='../pictures/smileys/svg/060-sad-13.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/061-graduated-1.png' srcset='../pictures/smileys/svg/061-graduated-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/062-happy-8.png' srcset='../pictures/smileys/svg/062-happy-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/063-hungry.png' srcset='../pictures/smileys/svg/063-hungry.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/064-police.png' srcset='../pictures/smileys/svg/064-police.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/065-crying-6.png' srcset='../pictures/smileys/svg/065-crying-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/066-happy-7.png' srcset='../pictures/smileys/svg/066-happy-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/067-sun.png' srcset='../pictures/smileys/svg/067-sun.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/068-father-2.png' srcset='../pictures/smileys/svg/068-father-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/069-happy-6.png' srcset='../pictures/smileys/svg/069-happy-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/070-late.png' srcset='../pictures/smileys/svg/070-late.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/071-heart.png' srcset='../pictures/smileys/svg/071-heart.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/072-sick-3.png' srcset='../pictures/smileys/svg/072-sick-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/073-sad-12.png' srcset='../pictures/smileys/svg/073-sad-12.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/074-in-love-10.png' srcset='../pictures/smileys/svg/074-in-love-10.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/075-shocked-2.png' srcset='../pictures/smileys/svg/075-shocked-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/076-happy-5.png' srcset='../pictures/smileys/svg/076-happy-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/077-shocked-1.png' srcset='../pictures/smileys/svg/077-shocked-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/078-cool-3.png' srcset='../pictures/smileys/svg/078-cool-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/079-crying-5.png' srcset='../pictures/smileys/svg/079-crying-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/080-zombie.png' srcset='../pictures/smileys/svg/080-zombie.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/081-pain.png' srcset='../pictures/smileys/svg/081-pain.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/082-cyclops.png' srcset='../pictures/smileys/svg/082-cyclops.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/083-sweat.png' srcset='../pictures/smileys/svg/083-sweat.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/084-thief.png' srcset='../pictures/smileys/svg/084-thief.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/085-sad-11.png' srcset='../pictures/smileys/svg/085-sad-11.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/086-kiss-4.png' srcset='../pictures/smileys/svg/086-kiss-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/087-father-1.png' srcset='../pictures/smileys/svg/087-father-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/088-father.png' srcset='../pictures/smileys/svg/088-father.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/089-angel-1.png' srcset='../pictures/smileys/svg/089-angel-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/090-happy-4.png' srcset='../pictures/smileys/svg/090-happy-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/091-sad-10.png' srcset='../pictures/smileys/svg/091-sad-10.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/092-outrage-1.png' srcset='../pictures/smileys/svg/092-outrage-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/093-ugly-2.png' srcset='../pictures/smileys/svg/093-ugly-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/094-ugly-1.png' srcset='../pictures/smileys/svg/094-ugly-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/095-scared.png' srcset='../pictures/smileys/svg/095-scared.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/096-tongue-2.png' srcset='../pictures/smileys/svg/096-tongue-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/097-sad-9.png' srcset='../pictures/smileys/svg/097-sad-9.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/098-nerd-9.png' srcset='../pictures/smileys/svg/098-nerd-9.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/099-greed-2.png' srcset='../pictures/smileys/svg/099-greed-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/100-whistle.png' srcset='../pictures/smileys/svg/100-whistle.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/101-nerd-8.png' srcset='../pictures/smileys/svg/101-nerd-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/102-muted-4.png' srcset='../pictures/smileys/svg/102-muted-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/103-in-love-9.png' srcset='../pictures/smileys/svg/103-in-love-9.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/104-in-love-8.png' srcset='../pictures/smileys/svg/104-in-love-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/105-kiss-3.png' srcset='../pictures/smileys/svg/105-kiss-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/106-in-love-7.png' srcset='../pictures/smileys/svg/106-in-love-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/107-ugly.png' srcset='../pictures/smileys/svg/107-ugly.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/108-nerd-7.png' srcset='../pictures/smileys/svg/108-nerd-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/109-nerd-6.png' srcset='../pictures/smileys/svg/109-nerd-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/110-crying-4.png' srcset='../pictures/smileys/svg/110-crying-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/111-muted-3.png' srcset='../pictures/smileys/svg/111-muted-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/112-nerd-5.png' srcset='../pictures/smileys/svg/112-nerd-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/113-kiss-2.png' srcset='../pictures/smileys/svg/113-kiss-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/114-greed-1.png' srcset='../pictures/smileys/svg/114-greed-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/115-pirate-1.png' srcset='../pictures/smileys/svg/115-pirate-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/116-music.png' srcset='../pictures/smileys/svg/116-music.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/117-confused-2.png' srcset='../pictures/smileys/svg/117-confused-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/118-nerd-4.png' srcset='../pictures/smileys/svg/118-nerd-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/119-greed.png' srcset='../pictures/smileys/svg/119-greed.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/120-nerd-3.png' srcset='../pictures/smileys/svg/120-nerd-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/121-crying-3.png' srcset='../pictures/smileys/svg/121-crying-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/122-cheering.png' srcset='../pictures/smileys/svg/122-cheering.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/123-surprised-6.png' srcset='../pictures/smileys/svg/123-surprised-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/124-muted-2.png' srcset='../pictures/smileys/svg/124-muted-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/125-sick-2.png' srcset='../pictures/smileys/svg/125-sick-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/126-graduated.png' srcset='../pictures/smileys/svg/126-graduated.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/127-angry-2.png' srcset='../pictures/smileys/svg/127-angry-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/128-in-love-6.png' srcset='../pictures/smileys/svg/128-in-love-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/129-cool-2.png' srcset='../pictures/smileys/svg/129-cool-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/130-confused-1.png' srcset='../pictures/smileys/svg/130-confused-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/131-sad-8.png' srcset='../pictures/smileys/svg/131-sad-8.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/132-nerd-2.png' srcset='../pictures/smileys/svg/132-nerd-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/133-birthday-boy.png' srcset='../pictures/smileys/svg/133-birthday-boy.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/134-surprised-5.png' srcset='../pictures/smileys/svg/134-surprised-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/135-selfie.png' srcset='../pictures/smileys/svg/135-selfie.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/136-tongue-1.png' srcset='../pictures/smileys/svg/136-tongue-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/137-smart-1.png' srcset='../pictures/smileys/svg/137-smart-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/138-smart.png' srcset='../pictures/smileys/svg/138-smart.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/139-surprised-4.png' srcset='../pictures/smileys/svg/139-surprised-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/140-3d-glasses.png' srcset='../pictures/smileys/svg/140-3d-glasses.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/141-in-love-5.png' srcset='../pictures/smileys/svg/141-in-love-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/142-sleeping.png' srcset='../pictures/smileys/svg/142-sleeping.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/143-pirate.png' srcset='../pictures/smileys/svg/143-pirate.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/144-santa-claus.png' srcset='../pictures/smileys/svg/144-santa-claus.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/145-wink.png' srcset='../pictures/smileys/svg/145-wink.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/146-in-love-4.png' srcset='../pictures/smileys/svg/146-in-love-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/147-tired.png' srcset='../pictures/smileys/svg/147-tired.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/148-bang.png' srcset='../pictures/smileys/svg/148-bang.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/149-baby.png' srcset='../pictures/smileys/svg/149-baby.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/150-tongue.png' srcset='../pictures/smileys/svg/150-tongue.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/151-sick-1.png' srcset='../pictures/smileys/svg/151-sick-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/152-outrage.png' srcset='../pictures/smileys/svg/152-outrage.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/153-injury.png' srcset='../pictures/smileys/svg/153-injury.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/154-dead.png' srcset='../pictures/smileys/svg/154-dead.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/155-rich-1.png' srcset='../pictures/smileys/svg/155-rich-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/156-sick.png' srcset='../pictures/smileys/svg/156-sick.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/157-angel.png' srcset='../pictures/smileys/svg/157-angel.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/158-nerd-1.png' srcset='../pictures/smileys/svg/158-nerd-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/159-crying-2.png' srcset='../pictures/smileys/svg/159-crying-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/160-crying-1.png' srcset='../pictures/smileys/svg/160-crying-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/161-muted-1.png' srcset='../pictures/smileys/svg/161-muted-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/162-surprised-3.png' srcset='../pictures/smileys/svg/162-surprised-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/163-crying.png' srcset='../pictures/smileys/svg/163-crying.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/164-sad-7.png' srcset='../pictures/smileys/svg/164-sad-7.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/165-cool-1.png' srcset='../pictures/smileys/svg/165-cool-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/166-happy-3.png' srcset='../pictures/smileys/svg/166-happy-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/167-thinking-1.png' srcset='../pictures/smileys/svg/167-thinking-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/168-muted.png' srcset='../pictures/smileys/svg/168-muted.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/169-confused.png' srcset='../pictures/smileys/svg/169-confused.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/170-happy-2.png' srcset='../pictures/smileys/svg/170-happy-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/171-thinking.png' srcset='../pictures/smileys/svg/171-thinking.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/172-nerd.png' srcset='../pictures/smileys/svg/172-nerd.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/173-in-love-3.png' srcset='../pictures/smileys/svg/173-in-love-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/174-hypnotized.png' srcset='../pictures/smileys/svg/174-hypnotized.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/175-cool.png' srcset='../pictures/smileys/svg/175-cool.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/176-shocked.png' srcset='../pictures/smileys/svg/176-shocked.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/177-easter.png' srcset='../pictures/smileys/svg/177-easter.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/178-surprised-2.png' srcset='../pictures/smileys/svg/178-surprised-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/179-surprised-1.png' srcset='../pictures/smileys/svg/179-surprised-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/180-surprised.png' srcset='../pictures/smileys/svg/180-surprised.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/181-furious.png' srcset='../pictures/smileys/svg/181-furious.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/182-sad-6.png' srcset='../pictures/smileys/svg/182-sad-6.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/183-sad-5.png' srcset='../pictures/smileys/svg/183-sad-5.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/184-sad-4.png' srcset='../pictures/smileys/svg/184-sad-4.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/185-sad-3.png' srcset='../pictures/smileys/svg/185-sad-3.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/186-angry-1.png' srcset='../pictures/smileys/svg/186-angry-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/187-rich.png' srcset='../pictures/smileys/svg/187-rich.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/188-sad-2.png' srcset='../pictures/smileys/svg/188-sad-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/189-happy-1.png' srcset='../pictures/smileys/svg/189-happy-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/190-sad-1.png' srcset='../pictures/smileys/svg/190-sad-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/191-sad.png' srcset='../pictures/smileys/svg/191-sad.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/192-smile.png' srcset='../pictures/smileys/svg/192-smile.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/193-in-love-2.png' srcset='../pictures/smileys/svg/193-in-love-2.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/194-happy.png' srcset='../pictures/smileys/svg/194-happy.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/195-kiss-1.png' srcset='../pictures/smileys/svg/195-kiss-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/196-in-love-1.png' srcset='../pictures/smileys/svg/196-in-love-1.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/197-in-love.png' srcset='../pictures/smileys/svg/197-in-love.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/198-kiss.png' srcset='../pictures/smileys/svg/198-kiss.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/199-angry.png' srcset='../pictures/smileys/svg/199-angry.svg' class='smiley' />", 
"<img src='../pictures/smileys/png/200-sleepy.png' srcset='../pictures/smileys/svg/200-sleepy.svg' class='smiley' />"); 

	$i = 0;
	while ($i < count($smileys)) {
		$texte = preg_replace("#". $smileys{$i} . "#", $imgSmiley{$i}, $string);
		$i++;
	}
}