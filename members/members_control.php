<?php

function getConnectionForm() {
	require("model/connection_model.php");
	checkUser();
}

function getRegistrationForm() {
	require("model/registration_model.php");
	addUser();
}

function disconnecting() {
	require("model/connection_model.php");
	disconnection();
	header('Location: ../index.php');
}
