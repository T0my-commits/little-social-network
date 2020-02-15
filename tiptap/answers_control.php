<?php

// Au retour de l'utilsateur;
if (isset($_POST['msg']) AND isset($_POST['ID_TIP'])) {
	$msg = htmlspecialchars($_POST['msg']);
	$ID_TIP = htmlspecialchars($_POST['ID_TIP']);
	addComment($ID_TIP, $msg);
}
else{
	header('Location: tiptap_control.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='../color/color_purple.css' rel='stylesheet' />
	<link href='style_answers.css' rel='stylesheet' />
</head>

<body>
	<form action='answers_view.php' method='POST'>
		<p>Vous souhaitez ajouter quelque chose ?</p>
		<input type='number' value='<?= $ID_TIP; ?>' name='ID_TIP'>
		<input type='text' placeholder='Je suis bref et respectueux dans mes propos (400 caractères max.' maxlength='400' name='msg' />
		<input type='submit' value='Répondre' />
	</form>
</body>

</html>