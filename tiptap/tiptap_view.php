<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='../color/color_purple.css' rel='stylesheet' />
	<link href='style_tiptap.css' rel='stylesheet' />
	<link href='../goodies/style_dock.css' rel='stylesheet' />
	<style>
		<?php if ('activer_bg' == 'activer_bg') { ?>
			body
			{
				background-color: black;
			}

			#bg
			{
				position: fixed;
				bottom: -100px;
				top: -100px;
				right: -100px;
				left: -100px;
				background: url("../pictures/backgrounds/hzd/hzd28.jpg") repeat center fixed;
				filter: blur(10px);
			}

			.title
			{
				background-color: rgba(255, 255, 255, 0.7);
			}
		<?php } else { ?>
			#body, body
			{
				background-color: white;
			}

			.infos
			{
				background-color: var(--tip-color);
				width: 95%;
			}
		<?php } ?>
	</style>
	<!-- <?= $bg_change; ?> -->
</head>

<!-- IL FAUT CODER L'OPTION "PAS DE RÉPONSE" ET "DEMANDE DE MODIFICATION". CELA PASSE PAR DES ICONES "POINT D'INTERROGATION" ET "POINT D'EXCLAMATION" EN HAUT À DROITE DE LA BULLE -->
<!-- PREVENIR L'UTILISATEUR DES NOUVEAUX MESSAGES POSTÉS LORS DE SON ABSENCE SUR TIPS & TAPS AVANT SA DECONNECTION (OU SEULEMENT AU RETOUR AU MENU) -->

<div id="bg">
</div>

<body>
	<div id='body'>

		<?php // include('../goodies/dock.php'); ?>

		<?php if (! isset($_SESSION['no_msg_tiptap'])) { ?>
			<div class='title'>
				<h1>Tips & Tap, les questions-réponses en un clic !</h1>
				<p>
					Tips & Tap est un concept assez singulier dans son fonctionnement. Sur cette page, vous jouez deux rôles: vous postez des tips (questions) et / ou vous y répondez avec des taps (réponses). Si vous le souhaitez, vous pouvez changer les fonds d'écrans dans le menu sur la page d'acceuil. Enjoy :)
				</p>
				<p>Bon Tips !</p>
				<a class='title_msg' href='#'>Désolé, Javascript est désactivé :/</a> <!-- Ce <a> est effacé par Javascript au chargement de la page -->
			</div>
		<?php } ?>

		<div class='infos'>
			<div class='infos_date'>
				<p class='hour'><?= date('H'); ?>h <?= date('i'); ?> min</p>
				<p class='date_info'><?php include('../goodies/date.php'); ?></p>
				<p class='repere'><strong><a href='../index.php'>Acceuil</a> ></strong> Tips & Taps</p>
			</div>
			<div class='infos_form'>
				<form method='GET' action='tiptap_control.php'>
					<select name='choose_tags' onchange='this.blur()' class='choose_tags'>
						<option><em>Rechercher par..</em></option>
						<?php ob_start(); ?>
							<option value="Licences et Licences pro">Licences et Licences pro</option>
							<option value="Dentaire">Dentaire</option>
							<option value="Médecine">Médecine</option>
							<option value="Pharmacie">Pharmacie</option>
							<option value="Maïeutique">Maïeutique</option>
							<option value="Kinésithérapie">Kinésithérapie</option>
							<option value="Paramédical">Paramédical</option>
							<option value="DEUST">DEUST</option>
							<option value="DUT">DUT</option>
							<option value="Design (lycée)">Design (lycée)</option>
							<option value="BTS">BTS</option>
							<option value="Prépa sciences">Prépa sciences</option>
							<option value="Prépa éco">Prépa éco</option>
							<option value="Prépa lettres">Prépa lettres</option>
							<option value="Grandes écoles post bac (Ingénieurs, commerce, arts...)">Grandes écoles post bac (Ingénieurs, commerce, arts...)</option>
							<option value="Institut d'études politiques">Institut d'études politiques</option>
							<option value="Comptabilité">Comptabilité</option>
							<option value="Social">Social</option>
							<option value="Paramédical">Paramédical</option>
							<option value="Design (école)">Design (école)</option>
							<option value="Beaux-Arts">Beaux-Arts</option>
							<option value="Architecture">Architecture</option>
							<option value="Autres écoles (vente, industrie, tourisme, transports, communication...)">Autres écoles (vente, industrie, tourisme, transports, communication...)</option>
						<?php $tags = ob_get_clean();
						echo $tags; ?>
					</select>
					<input type='submit' class='submit' value='Rechercher' />
				</form>
			</div>
		</div>

		<div class='msg'>
			<!-- Contain all messages that was posted on tree (max.) columns -->

			<?php
			$i = 1;
			while ($data = $answers->fetch()) {
				if ($i == 1) { ?>
					<div class="b1">
				<?php } elseif ($i == 6) { ?>
					<div class='b2'>
				<?php } elseif ($i == 11) { ?>
					<div class='b3'>
				<?php }

					if ($i == 1 OR $data['day_send_date'] != $day_send_date) { ?>
						<p class='date'><em>-- Tips postés le <?= $data['day_send_date']; ?> --</em></p>
					<?php } $day_send_date = $data['day_send_date']; ?>

					<p class="tip"><?= $data['msg']; ?></p><img src='../pictures/tip_msg.png' class='tip_img' /><img src='../pictures/opt_icon.png' class='opt_icon' /><?php if ($data['no_answers'] == 1) { ?><div class='no_answers'></div><?php } ?>
					<form action='tiptap_control.php' method='GET'>
						<input type='number' value='<?= $data['id']; ?>' name='id_tip' class='input_hide' />
						<input type='submit' class='msg_footer' value='Répondre' />
					</form>

					<?php $taps = getTaps($data['id']);
					while ($tap = $taps->fetch()) { ?>

						<p class="tap"><?= $tap['msg']; ?></p><img src='../pictures/tap_msg.png' class='tap_img' /><img src='../pictures/opt_icon.png' class='opt_icon' />

					<?php } $taps->closeCursor();
				if ($i == 5 OR $i == 10 OR $i == 15) { ?>
					</div>
				<?php }
				$i++;
			}
			$answers->closeCursor(); ?>
			</div>
		</div>

		<?php if ($i >= 6 AND $i < 11) { ?>
			<style>
				.msg { justify-content: flex-start; }
			</style>
		<?php } ?>

		<div class='reponse'>
		<div class='leavetip'><p>Leave a Tip & keep calm</p></div>
		<?php if (isset($_SESSION['id'])) { ?>
			<!-- Showing a form that permitted to write a comment -->
			<form action='tiptap_control.php' method='POST'>
				<select name='send_tag_with_my_tip' onchange='this.blur()' class='choose_tags'>
					<option disabled selected><em>--Choisir un tag--</em></option>
					<?= $tags; ?>
				</select>
				<p><em>Rq: associer un tag à votre message vous permet d'être plus facilement trouvé et augmente vos chances d'être répondu.</em></p>

				<textarea name='send_tip' placeholder='Une question, une idée, une inquiétude ? (700 caractères max.)' maxlength='700' rows='10' cols='50' required></textarea>
				<p><em>Rq: les messages sont anonymés à l'affichage mais vous restez l'auteur du Tip !</em></p>

				<input type='submit' value='Soumettre' class='submit' />
			</form>
		<?php } else { ?>
			<p>Vous devez être connecté pour poster des messages.</p>
		<?php } ?>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src='anim_tiptap.js' type='text/javascript'></script>

</html>