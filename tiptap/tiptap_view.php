<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='../color/color_purple.css' rel='stylesheet' />
	<link href='style_tiptap.css' rel='stylesheet' />
	<link href='../goodies/style_dock.css' rel='stylesheet' />
</head>

<!-- IL FAUT CODER L'OPTION "PAS DE RÉPONSE" ET "DEMANDE DE MODIFICATION". CELA PASSE PAR DES ICONES "POINT D'INTERROGATION" ET "POINT D'EXCLAMATION" EN HAUT À DROITE DE LA BULLE -->
<!-- PREVENIR L'UTILISATEUR DES NOUVEAUX MESSAGES POSTÉS LORS DE SON ABSENCE SUR TIPS & TAPS AVANT SA DECONNECTION (OU SEULEMENT AU RETOUR AU MENU) -->

<body>
	<div id='body'>

		<?php include('../goodies/dock.php'); ?>

		<?php if (! isset($_SESSION['no_msg_tiptap'])) { ?>
			<div class='title'>
				<h1>Tips & Tap, les questions-réponses en un clic !</h1>
				<p>
					Tips & Tap est un concept assez singulier dans son fonctionnement. Sur cette page, vous jouez deux rôles: vous postez des tips (questions) et / ou vous y répondez avec des taps (réponses). Si vous le souhaitez, vous pouvez changer les fonds d'écrans dans le menu sur la page d'acceuil. Enjoy :)
				</p>
				<p>Bon Tips !</p>
				<a class='msgNoJs' href='#'>Désolé, Javascript est désactivé :/</a> <!-- Ce <a> est effacé par Javascript au chargement de la page -->
			</div>
		<?php } ?>

		<div class='infos'>
			<div class='infos_date'>
				<p class='repere'><strong><a href='../index.php'>Acceuil</a> ></strong> Tips & Taps</p>
				<p class='hour'><?= date('H'); ?>h <?= date('i'); ?> min<br /></p>
				<p class='date_info'><?php include('../goodies/date.php'); ?></p>
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

		<div id='dock_infos'>
			<!-- Test -->
			<div id='dock_infos_block1'>
				<div>
					<img src='../pictures/countMsgIcon.png' />
					<p>Tip & Tap, c'est<br /><strong><?= $nbMsg; ?></strong><br />messages postés !</p>
				</div>
				<div>
					<img src='../pictures/colorTipTapIcon.png' />
					<p>C'est également<br /><strong>10</strong><br />thèmes & couleurs différents !</p>
				</div>
				<div>
					<img src='../pictures/countMembersIcon.png' />
					<p>Une communauté active de<br /><strong><?= $nbMembers[0]; ?></strong><br />membres !</p>
				</div>
				<div>
					<img src='../pictures/protectIcon.png' />
					<p>Et un service <br /><strong class='info_text'>sûr</strong><br />et de confiance</p>
				</div>
			</div>

			<div id='dock_infos_block2'>
				<a href='tiptap_control.php#reponse' id='linkOne'>Poster un Tip !</a>
				<a href='../index.php' id='linkTwo'>Retour à l'acceuil</a>
			</div>
		</div>

		<?php ob_start(); ?>
			<div class='paging_system'>
				<?php for ($i = 1; $i <= $nbOfPages; $i++) { ?>
					<?php if ($i == $page) { ?>
						<a href='tiptap_control.php?page=<?= $i; ?><?php if (isset($choose_tags)) { echo "&choose_tags=" . $choose_tags . ""; } ?>' class='actualPage'><?= $i ?></p>
					<?php } else { ?>
						<a href='tiptap_control.php?page=<?= $i; ?><?php if (isset($choose_tags)) { echo "&choose_tags=" . $choose_tags . ""; } ?>'><?= $i ?></p>
					<?php } ?>
				<?php } ?>
			</div>
		<?php $paging_system = ob_get_clean(); ?>
		<?= $paging_system; ?>

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
					<p class='tip_footer'>
						<?php if (isset($_SESSION['id']) AND $_SESSION['id'] == $data['autor']) { ?>
							<a class='modif_footer'>Modifier</a>
						<?php } ?>
						<a class='msg_footer'>Répondre</a>
					</p>

					<?php if (isset($_SESSION['id'])) { ?>
					<div class="showTextAreaForTap">
						<form action='tiptap_control.php' method='POST'>
							<p>Vous souhaitez ajouter quelque chose ?</p>
							<input type='number' name='ID_TIP' value='<?= $data['id']; ?>' class='input_hide' required />
							<textarea name='send_tap' placeholder='Je suis bref et respectueux dans mes propos (400 caractères max.)' maxlength='400' cols='1' title='' required></textarea>
							<input type='submit' value='Répondre' class='submit' />
						</form>
					</div>
					<?php } else { ?>
						<div class='showTextAreaForTap'>
							<p>Vous devez être connecté pour poster des Taps.</p>
							<a href='../members/connection_control.php?connection' class='submit'>J'ai compris !</a>
						</div>
					<?php } ?>

					<div class='showTextAreaForTap'>
						<form action='tiptap_control.php' method='POST'>
							<p>Qui ne modifie pas n'est pas français ! Hé ! ^^</p>
							<input type='text' name='gr' value='tips' class='input_hide' required />
							<input type='number' name='ID' value='<?= $data['id']; ?>' class='input_hide' required />
							<textarea name='modif_tiptap' placeholder='Une nouvelle idée ?' maxlength='400' title='' onkeyup='verif(this)' required><?= str_replace("<br />", "", $data['msg']); ?></textarea>
							<input type='submit' value='Soumettre' class='submit' />
						</form>
					</div>

					<?php $taps = getTaps($data['id']);
					while ($tap = $taps->fetch()) { ?>

						<p class="tap"><?php if ($data['autor'] == $tap['autor']) { echo "<span>Re</span>: "; } ?> <?= $tap['msg']; ?></p><img src='../pictures/tap_msg.png' class='tap_img' /><img src='../pictures/opt_icon.png' class='opt_icon' />
						<p class='tap_footer'>
							<?php if (isset($_SESSION['id']) AND $_SESSION['id'] == $tap['autor']) { ?>
								<a class='modif_tap_footer'>Modifier</a>
							<?php } ?>
						</p>

					<div class='showTextAreaForTap'>
						<form action='tiptap_control.php' method='POST'>
							<p>Alors comme ça on a un doute ? :P</p>
							<input type='text' name='gr' value='taps' class='input_hide' required />
							<input type='number' name='ID' value='<?= $tap['id']; ?>' class='input_hide' required />
							<textarea name='modif_tiptap' placeholder='Une nouvelle idée ?' maxlength='400' title='' onkeyup='verif(this)' required><?= str_replace("<br />", "", $tap["msg"]); ?></textarea>
							<input type='submit' value='Soumettre' class='submit' />
						</form>
					</div>

					<?php } $taps->closeCursor(); ?>

				<?php
				if ($i == 5 OR $i == 10 OR $i == 15) { ?>
					</div>
				<?php }
				$i++;
			}
			$answers->closeCursor(); ?>

			</div>
		</div>

		<?php if ($i >= 6 AND $i < 11) { ?>
		<?php } ?>

		<?= $paging_system; ?>

		<div id='reponse'>
			<div class='leavetip'>
				<p>Leave a Tip & keep calm</p>
			</div>

			<?php if (isset($_SESSION['id'])) { ?>
				<!-- Showing a form that permitted to write a comment -->
				<form action='tiptap_control.php' method='POST'>

					<textarea name='send_tip' placeholder='Une question, une idée, une inquiétude ? (700 caractères max.)' maxlength='700' rows='10' cols='50' required></textarea>
					<p><em>Rq: les messages sont anonymés à l'affichage mais vous restez l'auteur du Tip !</em></p>

					<select name='send_tag_with_my_tip' onchange='this.blur()' class='choose_tags'>
						<option disabled selected><em>--Choisir un tag--</em></option>
						<?= $tags; ?>
					</select>
					<p><em>Rq: associer un tag à votre message vous permet d'être plus facilement trouvé et augmente vos chances d'être répondu.</em></p>

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