<?php
// Starting sessions;
session_start();

require('../goodies/bg_change.php');
require('tiptap_model.php');

// if $_COOKIES['bg_change'] == yes { $bg_change = 'yes'; }

// Add Tip;
if (isset($_POST['send_tip'])) {
	$tip = strip_tags($_POST['send_tip']);
	if (isset($_POST['send_tag_with_my_tip'])) {
		$tags = strip_tags($_POST['send_tag_with_my_tip']);
	}
	else {
		$tags = '';
	}
	addTips($tip, $tags);
}
// Add Tap;
elseif (isset($_POST['send_tap']) AND isset($_POST['ID_TIP'])) {
	$tap = strip_tags($_POST['send_tap']);
	$ID_TIP = strip_tags($_POST['ID_TIP']);
	addTaps($tap, $ID_TIP);
}
// Update Tip or Tap;
elseif (isset($_POST['modif_tiptap']) AND isset($_POST['ID']) AND isset($_POST['gr'])) {
	if ($_POST['gr'] == 'tips' OR $_POST['gr'] == 'taps') {
		$type = strip_tags($_POST['gr']);
	}
	else {
		header('Location: tiptap_control.php?error');
	}
	$msg = strip_tags($_POST['modif_tiptap']);
	$ID = strip_tags($_POST['ID']);
	updateMsg($type, $msg, $ID);
}
// Just see the fuck*ng website !!!
// :p
elseif (!isset($_POST['send_tip']) AND !isset($_POST['send_tap']) AND !isset($_POST['ID_TIP']) AND !isset($_POST['modif_tiptap']) AND !isset($_POST['ID']) AND !isset($_POST['gr'])) {
	// stats;
	$nbMsg = countMsg()[0];
	$nbMembers = countMembers();
	// automatic paging system;
	$nbTips = countMsg()[1];
	$nbOfPages = ceil($nbTips/30);
	try
	{
		if (isset($_GET['page'])) {
			$page = strip_tags($_GET['page']);
			$page = intval($page);
			if ($page > $nbOfPages) {
				$page = $nbOfPages;
			}
		}
		else {
			$page = 1;
		}
	}
	catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
		header('Location: tiptap_control.php');
    }
	// get tips;
	$answers = getTips($page);
	if (isset($_GET['choose_tags'])) {
		$choose_tags = strip_tags($_GET['choose_tags']);
	}
	// after;
	require('tiptap_view.php');
}
else {
	header('Location: tiptap_control.php?rien');
}

$_SESSION['no_msg_tiptap'] = true;