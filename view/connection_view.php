<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Unaware - Connection</title>
	<link href='../css/style_connection.css' rel='stylesheet' />
</head>


<body>
	<!-- Show connection form -->
	<div id='content'>
		<h1 class='title'><img src='../pictures/logoUnaware.png' alt='logo_Unaware' class='logoUnaware' /></h1>
		<aside>

			<!--if error -->
			<?php if (isset($_GET['_error'])) { ?>
				<p class='alert'>Mauvais identifiant ou mot de passe.</p>
			<?php } ?>

			<!-- else show form -->
			<form action='../control/members_control.php?connection' method='POST'>
				<label>Votre pseudo<input type='text' name='pseudo' placeholder='Votre pseudo' required autofocus /></label>
				<div style='margin: 15px 0px; border: 1px inset rgba(89, 89, 89, 0.25);'></div>
				<label>Votre mot de passe<input type='password' name='password' placeholder='Votre mot de passe' required /></label>
				<div class='submitting'>
					<input type='submit' value='Soumettre' class='submit' />
				</div>

				<div id='footer'>
					<p><a href='#'> Mot de passe oublié ?</a></p>
					<p><a href='../control/members_control.php?inscription'> Pas encore inscrit ?</a></p>
				</div>
			</form>
		</aside>
	</div>
</body>

</html>
