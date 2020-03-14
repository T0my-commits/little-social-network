<?php ob_start(); ?>
	<div id='content'>
		<h1 id='contact'>Incription - Bienvenue sur Unaware</h1>
		<?php
		if (isset($_GET['good_job!']))
		{
			 echo "<p class='good_job'>Votre inscription s'est bien passée."; echo "<br /><em><a href='../index.php'>Retourner à l'acceuil.</a></em></p>";
		}
		?>
		<aside>
			<form action='registration.php' method='POST'>
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

				<!-- <label><input type='checkbox' name='conauto' class='cases_a_cocher' checked />Je souhaite me connecter automatiquement lors de ma prochaine visite.</label>
				<label><input type='checkbox' name='notifications' class='cases_a_cocher' checked />Je souhaite recevoir des notifications par mail lorsque de nouveaux messages sont postés sur la platforme.</label> -->
				
				<div style='display: flex; justify-content: center;'>
					<input type='submit' value='Inscrivez-moi !' class='submit'/>
				</div>
				<?php if (isset($_GET['err_bien_essaye'])) {echo "<p class='alert'>: IL FAUT REMPLIR TOUS LES CHAMPS !</p>";} ?>	
			</form>
		</aside>
	</div>

<?php $registration = ob_get_clean(); ?>

<?php ob_start(); ?>
		<!-- On affiche un formulaire de connection -->
		<div id='content'>
			<h1 id='contact'>Nous sommes heureux de vous voir ici</h1>
			<aside style='flex-direction: column;'>

				<?php
				if (isset($_GET['_error']))
				{
					 echo "<p class='alert'>Mauvais identifiant ou mot de passe.</p>";
				}
				?>

				<form action='connection_control.php?connection' method='POST'>

					<label>Votre pseudo<input type='text' name='pseudo' placeholder='Votre pseudo' required autofocus /></label>

					<div style='margin: 15px 0px; border: 1px inset rgba(89, 89, 89, 0.25);'></div>

					<label>Votre mot de passe<input type='password' name='password' placeholder='Votre mot de passe' required /></label>

					<div style='display: flex; justify-content: center;'>
						<input type='submit' value='Soumettre' class='submit' />
					</div>

					<p><a href='#'> Mot de passe oublié ?</a></p>
					<p><a href='connection_control.php?inscription'> Pas encore inscrit ?</a></p>

				</form>
			</aside>
		</div>
<?php $connection = ob_get_clean(); ?>
