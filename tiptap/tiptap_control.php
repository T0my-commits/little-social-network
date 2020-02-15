<?php
// Starting sessions;
session_start();

require('../goodies/bg_change.php');
require('tiptap_model.php');

// if $_COOKIES['bg_change'] == yes { $bg_change = 'yes'; }

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
elseif (isset($_POST['id_tip'])) { // Add tap;
	$ID_TIP = htmlspecialchars($_GET['id_tip']);
	require('answers_control.php');
}
elseif (! isset($_POST['id_tip']) AND ! isset($_POST['send_tip'])) {
	$answers = getTips();
	require('tiptap_view.php');
}
else {
	header('Location: tiptap_control.php');
}

$_SESSION['no_msg_tiptap'] = true;