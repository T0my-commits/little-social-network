<?php
session_start();

require('members_view.php');

if (isset($_GET['connection'])) {
	require('connection.php');
	$style = "<link href='style_connection.css' rel='stylesheet' />";
	$content = $connection;
}
elseif (isset($_GET['inscription'])) {
	$content = $registration;
}
elseif (isset($_GET['deconnection'])) {
	header('Location: disconnection.php');
}

require('connection_view.php');