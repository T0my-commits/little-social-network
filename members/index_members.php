<?php
session_start();

require('members_control.php');

// Connection;
if (isset($_GET['connection'])) {
	require('view/connection_view.php');
	// if all goes well... ;
	if (isset($_POST['pseudo']) AND isset($_POST['password']))
	{
		// Brute force attack protection;
		sleep(1);
		getConnectionForm();
	}
}
// Registration;
elseif (isset($_GET['inscription'])) {
	require('view/registration_view.php');
	// if all goes well... ;
	if (isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['birthday']) AND isset($_POST['email_registration']) AND isset($_POST['pseudo_registration']) AND isset($_POST['password']) AND isset($_POST['password_verif'])) {
		getRegistrationForm();
	}
}
// Disconnection;
elseif (isset($_GET['disconnection'])) {
	disconnecting();
	header('Location: ../index.php');
}