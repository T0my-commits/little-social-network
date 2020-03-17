<?php
session_start();

// Connection;
if (isset($_GET['connection'])) {
	require('../view/connection_view.php');
	// if all goes well... ;
	if (isset($_POST['pseudo']) AND isset($_POST['password']))
	{
		// Brute force attack protection;
		sleep(1);
		require("../model/connection_model.php");
		checkUser();
	}
}
// Registration;
elseif (isset($_GET['inscription'])) {
	require('../view/registration_view.php');
	// if all goes well... ;
	if (isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['birthday']) AND isset($_POST['email_registration']) AND isset($_POST['pseudo_registration']) AND isset($_POST['password']) AND isset($_POST['password_verif'])) {
		require("../model/registration_model.php");
		addUser();
	}
}
// Disconnection;
elseif (isset($_GET['disconnection'])) {
	require("../model/connection_model.php");
	disconnection();
	header('Location: ../index.php');
}