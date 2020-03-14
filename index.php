<?php
session_start();

require('main/index_model.php');
choose_bg();

try
{
	if (isset($_SESSION['id'])) {
		$opt = "<a href='members/index_members.php?disconnection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Déconnection</a>";
	}
	else {
		$opt = "<a href='members/index_members.php?connection' class='registration' style='display: block;'><img src='pictures/power.png' /><br />Connection</a>";
	}
}
catch(Exception $e)
{
	$e->getMessage();
}

require('main/index_view.php');
