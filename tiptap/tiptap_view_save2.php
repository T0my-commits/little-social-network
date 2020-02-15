<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='../color/color_purple.css' rel='stylesheet' />
	<link href='style_tiptap.css' rel='stylesheet' />
	<!-- <?= $bg_change; ?> -->
</head>

<!-- IL FAUT CODER L'OPTION "PAS DE RÉPONSE" ET "DEMANDE DE MODIFICATION". CELA PASSE PAR DES ICONES "POINT D'INTERROGATION" ET "POINT D'EXCLAMATION" EN HAUT À DROITE DE LA BULLE -->

<div id="bg">
</div>

<body>
	<div id='body'>
		<div class='research'>
			<!-- Research form.. -->
		</div>

		<?php if (! isset($_SESSION['no_msg_tiptap'])) { ?>
			<div class='title'>
				<h1>Tips & Tap, les questions-réponses en un clic !</h1>
				<p>
					Tips & Tap est un concept assez singulier dans son fonctionnement. Sur cette page, vous jouez deux rôles: vous postez des tips (questions) et / ou vous y répondez avec des taps (réponses). Attention: une seule réponses à chaques questions ! Soyez donc brefs dans vos questions mais aussi dans vos réponses :)
				</p>
				<p>Bon Tips !</p>
				<a class='title_msg' href='#'>Désolé, Javascript est désactivé :/</a> <!-- Ce <a> est effacé par Javascript au chargement de la page -->
			</div>
		<?php } ?>

		<div class='infos'>
			<div class='infos_date'>
				<p class='hour'><?= date('H'); ?>h <?= date('i'); ?> min</p>
				<p class='date_info'><?php include('../goodies/date.php'); ?></p>
			</div>
			<div class='infos_form'>
				<form method='GET' action='tiptap_control.php'>
					<select name='choose_tags' onchange='this.blur()' class='choose_tags'>
						<option><em>Rechercher par..</em></option>
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
					</select>
					<input type='submit' class='submit' value='Rechercher' />
				</form>
			</div>
		</div>

		<div class='msg'>
			<!-- Contain all messages that was posted on tree (max.) columns -->
			<?php while ($data = $answers->fetch()) { ?>

				<div class="b1">

					<p class="<?= $data['type']; ?>"><?= $data['msg']; ?></p><img src='../pictures/<?= $data['type']; ?>_msg.png' class='<?= $data['type']; ?>_img' /><img src='../pictures/opt_icon.png' class='opt_icon' />
					<span class='msg_footer'>envoyé à 21h15 [id = <?= $data['id']; ?>]</span>

				</div>

				<?php }
				$answers->closeCursor(); ?>
		</div>		

		<div class='msg'>
			<!-- Contain all messages that was posted on tree (max.) columns -->
			<?php 
			$i = 1;
			$i_max = 10;
			$block = 'b1';

			echo $block;
			if ($i > $i_max) {
				$block = 'b' . $i;
				$i_max = 20;
			}
			$i++; ?>

				<div class="<?= $block; ?>">

					<?php
					while ($data = $answers->fetch()) {

					$send_date = $data['send_date']; // Ne marche pas..
					if ($data['send_date'] != $send_date OR $i == 1) { ?>
						<span class='date'><em>-- Tips postés le <?= $data['send_date']; ?> --</em></span>
					<?php } ?>

					<p class="<?= $data['type']; ?>"><?= $data['msg']; ?></p><img src='../pictures/<?= $data['type']; ?>_msg.png' class='<?= $data['type']; ?>_img' /><img src='../pictures/opt_icon.png' class='opt_icon' />
					<span class='msg_footer'>envoyé à 21h15 [id = <?= $data['id']; ?>]</span>

				</div>

				<?php }
				$answers->closeCursor(); ?>
			</div>

		<div id='reponse'>
			<!-- Showing a form that permitted to write a comment -->
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src='anim_tiptap.js' type='text/javascript'></script>

</html>