<?php
// Starting sessions;
session_start();

// Requires;
require('../goodies/bg_change.php');
require('tiptap_model.php');
require('../color/color.php');

// Add Tip;
if (isset($_POST['send_tip'])) {
	$tip = htmlspecialchars(strip_tags($_POST['send_tip']));
	if (isset($_POST['send_tag_with_my_tip'])) {
		$tags = htmlspecialchars(strip_tags($_POST['send_tag_with_my_tip']));
	}
	else {
		$tags = '';
	}
	addTips($tip, $tags);
}
// Add Tap;
elseif (isset($_POST['send_tap']) AND isset($_POST['ID_TIP'])) {
	$tap = htmlspecialchars(strip_tags($_POST['send_tap']));
	$ID_TIP = htmlspecialchars(strip_tags($_POST['ID_TIP']));
	addTaps($tap, $ID_TIP);
}
// Update Tip or Tap;
elseif (isset($_POST['modif_tiptap']) AND isset($_POST['ID']) AND isset($_POST['gr'])) {
	if ($_POST['gr'] == 'tips' OR $_POST['gr'] == 'taps') {
		$type = htmlspecialchars(strip_tags($_POST['gr']));
	}
	else {
		header('Location: tiptap_control.php?error');
	}
	$msg = htmlspecialchars(strip_tags($_POST['modif_tiptap']));
	$ID = htmlspecialchars(strip_tags($_POST['ID']));
	updateMsg($type, $msg, $ID);
}
// Change theme & colors;
elseif (isset($_GET['choose_color']) AND is_numeric($_GET['choose_color'])) {
	if (strlen($_GET['choose_color']) <= 2) {
		$numColor = htmlspecialchars(strip_tags(intval($_GET['choose_color'])));
		makeColor($numColor);
	}
	else {
		header('Location: tiptap_control.php');
	}
}
// Just see the fuck*ng website !!!
// :p
elseif (!isset($_POST['send_tip']) AND !isset($_POST['send_tap']) AND !isset($_POST['ID_TIP']) AND !isset($_POST['modif_tiptap']) AND !isset($_POST['ID']) AND !isset($_POST['gr'])) {
	// stats;
	$nbMsg = countMsg()[0];
	$nbMembers = countMembers();
	// automatic paging system;
	$nbTips = countMsg()[1];
	$nbOfPages = ceil($nbTips/15);
	try
	{
		if (isset($_GET['page'])) {
			$page = htmlspecialchars(strip_tags($_GET['page']));
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
		$choose_tags = htmlspecialchars(strip_tags($_GET['choose_tags']));
	}
	// after;
	require('tiptap_view.php');
}
else {
	header('Location: tiptap_control.php?rien');
}

$_SESSION['no_msg_tiptap'] = true;
