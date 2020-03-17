<?php
session_start();

require('model/index_model.php');
choose_bg();

try
{
	if (isset($_SESSION['id'])) {
		$opt = "<a href='control/members_control.php?disconnection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Déconnection</a>";
	}
	else {
		$opt = "<a href='control/members_control.php?connection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Connection</a>";
	}
}
catch(Exception $e)
{
	$e->getMessage();
}

require('view/index_view.php');
