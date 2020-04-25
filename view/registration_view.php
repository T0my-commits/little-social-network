<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Unaware - Inscription</title>
	<link href='../css/style_registration.css' rel='stylesheet' />
	<!-- <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
</head>


<body>

	<div id='title_img'>
		<div id='title_text'>
			<img src='../pictures/logoUnaware.png' class='logo' />
			<h1><a href='../index.php'>unaware</a></h1>
		</div>
		<img src='../pictures/title_img.png' alt='example_Unaware' />
		<div class='block_footer'>
			<ul>
				<li>Utilisation illimité</li>
				<li>Accès à toutes les fonctionnalités</li>
				<li>Gagnez du temps dans vos recherches</li>
			</ul>
			<ul>
				<li>Faîtes des rencontres utiles</li>
				<li>Affinez vos projets</li>
				<li>Construisez un réseau</li>
			</ul>
		</div>
	</div>

	<div id='content'>
		<h1><img src='../pictures/logoUnaware.png' class='logoUnaware' /></h1>
		
		<!-- Showing registration form -->
		<aside>
			<form action='members_control.php?inscription' method='POST'>
				<label>Mon prénom<input type='text' name='firstname' placeholder='Mon prénom' maxlength='25' autofocus required /></label>
				<label>Mon nom<input type='text' name='lastname' placeholder='Mon nom' maxlength='25' required /></label>
				<label>Mon année de naissance<input type='number' name='birthday' min='1950' max='2010' value='2002' required /></label>
				<label>Mon adresse mail<input type='email' name='email_registration' placeholder='Mon adresse électronique' maxlength='50' required /></label>
				<?php if (isset($_GET['err_email'])) {echo "<p class='alert'>L'adresse mail à déjà été utilisée !</p>";} ?>
				<div style='margin: 15px 0px; border: 1px inset rgba(89, 89, 89, 0.25);'></div>
				<label>Mon pseudo<input type='text' name='pseudo_registration' placeholder='Mon pseudo' maxlength='20' required /></label>
				<?php if (isset($_GET['err_pseudo'])) {echo "<p class='alert'>Ce pseudo est déjà pris !</p>";} ?>
				<label>Mon mot de passe<input type='password' name='password' placeholder='Mon mot de passe' class='password' maxlength='35' required /></label>
				<input type='password' name='password_verif' placeholder='... puis encore un fois' maxlength='35' required />
				<?php if (isset($_GET['err_password'])) {echo "<p class='alert'>Les mots de passe ne sont pas identiques !</p>";} ?>
				<input type='checkbox' name='conauto' class='normal_input' checked /><label for='conauto' class='checkbox'>Je souhaite me connecter automatiquement lors de ma prochaine visite.</label><br />
				<input type='checkbox' name='notifications' class='normal_input' checked /><label for='notifications' class='checkbox'>Je souhaite recevoir des notifications par mail lorsque de nouveaux messages sont postés sur la platforme.</label>
				<div class='submitting'>
					<input type='submit' value='Inscrivez-moi !' class='submit'/>
				</div>
				<?php if (isset($_GET['err_bien_essaye'])) {echo "<p class='alert'>: IL FAUT REMPLIR TOUS LES CHAMPS !</p>";} ?>	
			</form>
		</aside>
	</div>
</body>

</html>
