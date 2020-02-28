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
// Just see the fuck*ng website !!!
// :p
elseif (! isset($_POST['send_tip'])) {
	$answers = getTips();
	require('tiptap_view.php');
}
else {
	header('Location: tiptap_control.php');
}

$_SESSION['no_msg_tiptap'] = true;