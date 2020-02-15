<?php
session_start();

require('main/index_model.php');
require('goodies/bg_change.php');

try
{
	if (isset($_SESSION['id'])) {
		$opt = "<a href='members/connection_control.php?deconnection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Déconnection</a>";
	}
	else {
		$opt = "<a href='members/connection_control.php?connection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Connection</a>";
	}
}
catch(Exception $e)
{
	$e->getMessage();
}

require('main/index_view.php');