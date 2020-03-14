<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='../color/<?= $color; ?>' rel='stylesheet' />
	<link href='style_tiptap.css' rel='stylesheet' />
	<link href='../goodies/style_dock.css' rel='stylesheet' />
	<link href="https://fonts.googleapis.com/css?family=Sen&ampdisplay=swap" rel="stylesheet"> 
	<!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' rel='stylesheet' />
	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' /> -->
	<?php if (isset($_SESSION['dark_mode']) AND $_SESSION['dark_mode'] == true) { ?>
	<style>
		body, header ul {background-color: black;}
		header ul, header li a {border-bottom: 1px solid white; color: white;}
		.date, .leavetip, .msg_leavetip, #reponse, .modif_footer, .msg_footer, .showTextAreaForTap, .infos_date {color: white;}
		.showTextAreaForTap form { background-color: transparent; border: white; }
	</style>
<?php } ?>
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

		<div class='hide_div'>
			<div class='infos'>
				<div class='infos_date'>
					<p class='repere'><strong><a href='../index.php'>Acceuil</a> ></strong> Tips & Taps</p>
					<p class='hour'><?= date('H'); ?>h <?= date('i'); ?> min<br /></p>
					<p class='date_info'><?php include('../goodies/date.php'); ?></p>
				</div>

				<div class='infos_form'>
					<form method='GET' action='tiptap_control.php'>
						<select name='choose_color' onchange='this.blur()' class='choose_tags' required>
							<option><em>Choisir un thème..</em></option>
							<option value="1">Bleu</option>
							<option value="2">Marron</option>
							<option value="3">Vert foncé</option>
							<option value="4">Vert</option>
							<option value="5">Vert - bleu</option>
							<option value="6">Oréo</option>
							<option value="7">Vert pâle</option>
							<option value="8">Rose</option>
							<option value="9">Violet</option>
							<option value="10">Rouge</option>
							<option value="11">Mode sombre: Bleu</option>
							<option value="12">Mode sombre: Marron</option>
							<option value="13">Mode sombre: Vert foncé</option>
							<option value="14">Mode sombre: Vert</option>
							<option value="15">Mode sombre: Vert - bleu</option>
							<option value="16">Mode sombre: Oréo</option>
							<option value="17">Mode sombre: Vert pâle</option>
							<option value="18">Mode sombre: Rose</option>
							<option value="19">Mode sombre: Violet</option>
							<option value="20">Mode sombre: Rouge</option>
						</select>
						<input type='submit' class='submit' value='Définir' />
					</form>
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
					<p>Et c'est <br /><strong class='info_text'>gratuit</strong><br />et ça le resteras</p>
				</div>
			</div>

			<div id='dock_infos_block2'>
				<a href='tiptap_control.php#reponse' id='linkOne'>Poster un Tip !</a>
				<a id='linkTwo'>Paramètres<img src='../pictures/fleche_left.png' /></a>
			</div>
		</div>

		<?php ob_start(); ?>
			<div class='paging_system'>
				<?php for ($i = 1; $i <= $nbOfPages; $i++) { ?>
					<?php if ($i == $page) { ?>
						<a href='tiptap_control.php?page=<?= $i; ?><?php if (isset($choose_tags)) { echo "&choose_tags=" . $choose_tags . ""; } ?>' class='actualPage'><?= $i ?></a>
					<?php } else { ?>
						<a href='tiptap_control.php?page=<?= $i; ?><?php if (isset($choose_tags)) { echo "&choose_tags=" . $choose_tags . ""; } ?>'><?= $i ?></a>
					<?php } ?>
				<?php } ?>
			</div>
		<?php $paging_system = ob_get_clean();
		echo $paging_system; ?>

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

					<p class="tip"><?= $data['msg']; ?></p>
					<?php if (isset($_SESSION['dark_mode']) AND $_SESSION['dark_mode'] == true) { ?>
						<img src='../pictures/tip_msg_dark.png' class='tip_img' />
					<?php } else { ?>
						<img src='../pictures/tip_msg.png' class='tip_img' />
					<?php } ?>
					<img src='../pictures/opt_icon.png' class='opt_icon' /><?php if ($data['no_answers'] == 1) { ?><div class='no_answers'></div><?php } ?>
					<p class='tip_footer'>
						<?php if (isset($_SESSION['id']) AND $_SESSION['id'] == $data['autor']) { ?>
							<a class='modif_footer'>Modifier</a>
						<?php } ?>
						<a class='msg_footer' tooltip-placement='top' tooltip-append-to-body='true' tooltip-popup-delay='0' uib-tooltip="Voulez-vous répondre ?"">Répondre</a>
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

					<?php } if (isset($_SESSION['id']) AND $data['autor'] == $_SESSION['id']) { ?>
						<div class='showTextAreaForTap'>
							<form action='tiptap_control.php' method='POST'>
								<p>Qui ne modifie pas n'est pas français ! Hé ! ^^</p>
								<input type='text' name='gr' value='tips' class='input_hide' required />
								<input type='number' name='ID' value='<?= $data['id']; ?>' class='input_hide' required />
								<textarea name='modif_tiptap' placeholder='Une nouvelle idée ?' maxlength='400' title='' onkeyup='resize(this)' required><?= str_replace("<br />", "", $data['msg']); ?></textarea>
								<input type='submit' value='Soumettre' class='submit' />
							</form>
						</div>
					<?php } ?>

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

					<!-- From schools: all <img /> where class is 'smiley' was generated with bash on Linux ;) -->
					<div class='smileys'>
						<img src='../pictures/smileys/png/001-happy-18.png' srcset='../pictures/smileys/svg/001-happy-18.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/002-cool-5.png' srcset='../pictures/smileys/svg/002-cool-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/003-happy-17.png' srcset='../pictures/smileys/svg/003-happy-17.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/004-surprised-9.png' srcset='../pictures/smileys/svg/004-surprised-9.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/005-shocked-4.png' srcset='../pictures/smileys/svg/005-shocked-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/006-shocked-3.png' srcset='../pictures/smileys/svg/006-shocked-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/007-nervous-2.png' srcset='../pictures/smileys/svg/007-nervous-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/008-nervous-1.png' srcset='../pictures/smileys/svg/008-nervous-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/009-angry-6.png' srcset='../pictures/smileys/svg/009-angry-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/010-drool.png' srcset='../pictures/smileys/svg/010-drool.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/011-tired-2.png' srcset='../pictures/smileys/svg/011-tired-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/012-tongue-7.png' srcset='../pictures/smileys/svg/012-tongue-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/013-tongue-6.png' srcset='../pictures/smileys/svg/013-tongue-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/014-tongue-5.png' srcset='../pictures/smileys/svg/014-tongue-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/015-smile-1.png' srcset='../pictures/smileys/svg/015-smile-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/016-sleeping-1.png' srcset='../pictures/smileys/svg/016-sleeping-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/017-nervous.png' srcset='../pictures/smileys/svg/017-nervous.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/018-surprised-8.png' srcset='../pictures/smileys/svg/018-surprised-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/019-tongue-4.png' srcset='../pictures/smileys/svg/019-tongue-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/020-happy-16.png' srcset='../pictures/smileys/svg/020-happy-16.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/021-wink-1.png' srcset='../pictures/smileys/svg/021-wink-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/022-laughing-2.png' srcset='../pictures/smileys/svg/022-laughing-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/023-laughing-1.png' srcset='../pictures/smileys/svg/023-laughing-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/024-sweat-1.png' srcset='../pictures/smileys/svg/024-sweat-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/025-happy-15.png' srcset='../pictures/smileys/svg/025-happy-15.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/026-happy-14.png' srcset='../pictures/smileys/svg/026-happy-14.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/027-laughing.png' srcset='../pictures/smileys/svg/027-laughing.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/028-happy-13.png' srcset='../pictures/smileys/svg/028-happy-13.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/029-happy-12.png' srcset='../pictures/smileys/svg/029-happy-12.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/030-crying-8.png' srcset='../pictures/smileys/svg/030-crying-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/031-crying-7.png' srcset='../pictures/smileys/svg/031-crying-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/032-bored.png' srcset='../pictures/smileys/svg/032-bored.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/033-cool-4.png' srcset='../pictures/smileys/svg/033-cool-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/034-angry-5.png' srcset='../pictures/smileys/svg/034-angry-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/035-sad-14.png' srcset='../pictures/smileys/svg/035-sad-14.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/036-angry-4.png' srcset='../pictures/smileys/svg/036-angry-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/037-happy-11.png' srcset='../pictures/smileys/svg/037-happy-11.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/038-angry-3.png' srcset='../pictures/smileys/svg/038-angry-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/039-cyclops-1.png' srcset='../pictures/smileys/svg/039-cyclops-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/040-surprised-7.png' srcset='../pictures/smileys/svg/040-surprised-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/041-thinking-2.png' srcset='../pictures/smileys/svg/041-thinking-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/042-book.png' srcset='../pictures/smileys/svg/042-book.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/043-baby-boy.png' srcset='../pictures/smileys/svg/043-baby-boy.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/044-dead-1.png' srcset='../pictures/smileys/svg/044-dead-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/045-star.png' srcset='../pictures/smileys/svg/045-star.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/046-dubious.png' srcset='../pictures/smileys/svg/046-dubious.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/047-phone-call.png' srcset='../pictures/smileys/svg/047-phone-call.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/048-moon.png' srcset='../pictures/smileys/svg/048-moon.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/049-robot.png' srcset='../pictures/smileys/svg/049-robot.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/050-flower.png' srcset='../pictures/smileys/svg/050-flower.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/051-happy-10.png' srcset='../pictures/smileys/svg/051-happy-10.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/052-happy-9.png' srcset='../pictures/smileys/svg/052-happy-9.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/053-tired-1.png' srcset='../pictures/smileys/svg/053-tired-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/054-ugly-3.png' srcset='../pictures/smileys/svg/054-ugly-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/055-tongue-3.png' srcset='../pictures/smileys/svg/055-tongue-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/056-vampire.png' srcset='../pictures/smileys/svg/056-vampire.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/057-music-1.png' srcset='../pictures/smileys/svg/057-music-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/058-popcorn.png' srcset='../pictures/smileys/svg/058-popcorn.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/059-nurse.png' srcset='../pictures/smileys/svg/059-nurse.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/060-sad-13.png' srcset='../pictures/smileys/svg/060-sad-13.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/061-graduated-1.png' srcset='../pictures/smileys/svg/061-graduated-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/062-happy-8.png' srcset='../pictures/smileys/svg/062-happy-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/063-hungry.png' srcset='../pictures/smileys/svg/063-hungry.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/064-police.png' srcset='../pictures/smileys/svg/064-police.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/065-crying-6.png' srcset='../pictures/smileys/svg/065-crying-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/066-happy-7.png' srcset='../pictures/smileys/svg/066-happy-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/067-sun.png' srcset='../pictures/smileys/svg/067-sun.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/068-father-2.png' srcset='../pictures/smileys/svg/068-father-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/069-happy-6.png' srcset='../pictures/smileys/svg/069-happy-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/070-late.png' srcset='../pictures/smileys/svg/070-late.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/071-heart.png' srcset='../pictures/smileys/svg/071-heart.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/072-sick-3.png' srcset='../pictures/smileys/svg/072-sick-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/073-sad-12.png' srcset='../pictures/smileys/svg/073-sad-12.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/074-in-love-10.png' srcset='../pictures/smileys/svg/074-in-love-10.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/075-shocked-2.png' srcset='../pictures/smileys/svg/075-shocked-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/076-happy-5.png' srcset='../pictures/smileys/svg/076-happy-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/077-shocked-1.png' srcset='../pictures/smileys/svg/077-shocked-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/078-cool-3.png' srcset='../pictures/smileys/svg/078-cool-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/079-crying-5.png' srcset='../pictures/smileys/svg/079-crying-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/080-zombie.png' srcset='../pictures/smileys/svg/080-zombie.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/081-pain.png' srcset='../pictures/smileys/svg/081-pain.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/082-cyclops.png' srcset='../pictures/smileys/svg/082-cyclops.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/083-sweat.png' srcset='../pictures/smileys/svg/083-sweat.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/084-thief.png' srcset='../pictures/smileys/svg/084-thief.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/085-sad-11.png' srcset='../pictures/smileys/svg/085-sad-11.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/086-kiss-4.png' srcset='../pictures/smileys/svg/086-kiss-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/087-father-1.png' srcset='../pictures/smileys/svg/087-father-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/088-father.png' srcset='../pictures/smileys/svg/088-father.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/089-angel-1.png' srcset='../pictures/smileys/svg/089-angel-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/090-happy-4.png' srcset='../pictures/smileys/svg/090-happy-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/091-sad-10.png' srcset='../pictures/smileys/svg/091-sad-10.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/092-outrage-1.png' srcset='../pictures/smileys/svg/092-outrage-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/093-ugly-2.png' srcset='../pictures/smileys/svg/093-ugly-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/094-ugly-1.png' srcset='../pictures/smileys/svg/094-ugly-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/095-scared.png' srcset='../pictures/smileys/svg/095-scared.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/096-tongue-2.png' srcset='../pictures/smileys/svg/096-tongue-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/097-sad-9.png' srcset='../pictures/smileys/svg/097-sad-9.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/098-nerd-9.png' srcset='../pictures/smileys/svg/098-nerd-9.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/099-greed-2.png' srcset='../pictures/smileys/svg/099-greed-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/100-whistle.png' srcset='../pictures/smileys/svg/100-whistle.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/101-nerd-8.png' srcset='../pictures/smileys/svg/101-nerd-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/102-muted-4.png' srcset='../pictures/smileys/svg/102-muted-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/103-in-love-9.png' srcset='../pictures/smileys/svg/103-in-love-9.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/104-in-love-8.png' srcset='../pictures/smileys/svg/104-in-love-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/105-kiss-3.png' srcset='../pictures/smileys/svg/105-kiss-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/106-in-love-7.png' srcset='../pictures/smileys/svg/106-in-love-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/107-ugly.png' srcset='../pictures/smileys/svg/107-ugly.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/108-nerd-7.png' srcset='../pictures/smileys/svg/108-nerd-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/109-nerd-6.png' srcset='../pictures/smileys/svg/109-nerd-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/110-crying-4.png' srcset='../pictures/smileys/svg/110-crying-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/111-muted-3.png' srcset='../pictures/smileys/svg/111-muted-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/112-nerd-5.png' srcset='../pictures/smileys/svg/112-nerd-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/113-kiss-2.png' srcset='../pictures/smileys/svg/113-kiss-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/114-greed-1.png' srcset='../pictures/smileys/svg/114-greed-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/115-pirate-1.png' srcset='../pictures/smileys/svg/115-pirate-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/116-music.png' srcset='../pictures/smileys/svg/116-music.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/117-confused-2.png' srcset='../pictures/smileys/svg/117-confused-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/118-nerd-4.png' srcset='../pictures/smileys/svg/118-nerd-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/119-greed.png' srcset='../pictures/smileys/svg/119-greed.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/120-nerd-3.png' srcset='../pictures/smileys/svg/120-nerd-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/121-crying-3.png' srcset='../pictures/smileys/svg/121-crying-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/122-cheering.png' srcset='../pictures/smileys/svg/122-cheering.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/123-surprised-6.png' srcset='../pictures/smileys/svg/123-surprised-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/124-muted-2.png' srcset='../pictures/smileys/svg/124-muted-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/125-sick-2.png' srcset='../pictures/smileys/svg/125-sick-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/126-graduated.png' srcset='../pictures/smileys/svg/126-graduated.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/127-angry-2.png' srcset='../pictures/smileys/svg/127-angry-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/128-in-love-6.png' srcset='../pictures/smileys/svg/128-in-love-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/129-cool-2.png' srcset='../pictures/smileys/svg/129-cool-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/130-confused-1.png' srcset='../pictures/smileys/svg/130-confused-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/131-sad-8.png' srcset='../pictures/smileys/svg/131-sad-8.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/132-nerd-2.png' srcset='../pictures/smileys/svg/132-nerd-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/133-birthday-boy.png' srcset='../pictures/smileys/svg/133-birthday-boy.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/134-surprised-5.png' srcset='../pictures/smileys/svg/134-surprised-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/135-selfie.png' srcset='../pictures/smileys/svg/135-selfie.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/136-tongue-1.png' srcset='../pictures/smileys/svg/136-tongue-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/137-smart-1.png' srcset='../pictures/smileys/svg/137-smart-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/138-smart.png' srcset='../pictures/smileys/svg/138-smart.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/139-surprised-4.png' srcset='../pictures/smileys/svg/139-surprised-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/140-3d-glasses.png' srcset='../pictures/smileys/svg/140-3d-glasses.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/141-in-love-5.png' srcset='../pictures/smileys/svg/141-in-love-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/142-sleeping.png' srcset='../pictures/smileys/svg/142-sleeping.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/143-pirate.png' srcset='../pictures/smileys/svg/143-pirate.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/144-santa-claus.png' srcset='../pictures/smileys/svg/144-santa-claus.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/145-wink.png' srcset='../pictures/smileys/svg/145-wink.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/146-in-love-4.png' srcset='../pictures/smileys/svg/146-in-love-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/147-tired.png' srcset='../pictures/smileys/svg/147-tired.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/148-bang.png' srcset='../pictures/smileys/svg/148-bang.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/149-baby.png' srcset='../pictures/smileys/svg/149-baby.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/150-tongue.png' srcset='../pictures/smileys/svg/150-tongue.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/151-sick-1.png' srcset='../pictures/smileys/svg/151-sick-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/152-outrage.png' srcset='../pictures/smileys/svg/152-outrage.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/153-injury.png' srcset='../pictures/smileys/svg/153-injury.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/154-dead.png' srcset='../pictures/smileys/svg/154-dead.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/155-rich-1.png' srcset='../pictures/smileys/svg/155-rich-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/156-sick.png' srcset='../pictures/smileys/svg/156-sick.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/157-angel.png' srcset='../pictures/smileys/svg/157-angel.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/158-nerd-1.png' srcset='../pictures/smileys/svg/158-nerd-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/159-crying-2.png' srcset='../pictures/smileys/svg/159-crying-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/160-crying-1.png' srcset='../pictures/smileys/svg/160-crying-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/161-muted-1.png' srcset='../pictures/smileys/svg/161-muted-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/162-surprised-3.png' srcset='../pictures/smileys/svg/162-surprised-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/163-crying.png' srcset='../pictures/smileys/svg/163-crying.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/164-sad-7.png' srcset='../pictures/smileys/svg/164-sad-7.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/165-cool-1.png' srcset='../pictures/smileys/svg/165-cool-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/166-happy-3.png' srcset='../pictures/smileys/svg/166-happy-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/167-thinking-1.png' srcset='../pictures/smileys/svg/167-thinking-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/168-muted.png' srcset='../pictures/smileys/svg/168-muted.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/169-confused.png' srcset='../pictures/smileys/svg/169-confused.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/170-happy-2.png' srcset='../pictures/smileys/svg/170-happy-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/171-thinking.png' srcset='../pictures/smileys/svg/171-thinking.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/172-nerd.png' srcset='../pictures/smileys/svg/172-nerd.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/173-in-love-3.png' srcset='../pictures/smileys/svg/173-in-love-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/174-hypnotized.png' srcset='../pictures/smileys/svg/174-hypnotized.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/175-cool.png' srcset='../pictures/smileys/svg/175-cool.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/176-shocked.png' srcset='../pictures/smileys/svg/176-shocked.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/177-easter.png' srcset='../pictures/smileys/svg/177-easter.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/178-surprised-2.png' srcset='../pictures/smileys/svg/178-surprised-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/179-surprised-1.png' srcset='../pictures/smileys/svg/179-surprised-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/180-surprised.png' srcset='../pictures/smileys/svg/180-surprised.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/181-furious.png' srcset='../pictures/smileys/svg/181-furious.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/182-sad-6.png' srcset='../pictures/smileys/svg/182-sad-6.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/183-sad-5.png' srcset='../pictures/smileys/svg/183-sad-5.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/184-sad-4.png' srcset='../pictures/smileys/svg/184-sad-4.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/185-sad-3.png' srcset='../pictures/smileys/svg/185-sad-3.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/186-angry-1.png' srcset='../pictures/smileys/svg/186-angry-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/187-rich.png' srcset='../pictures/smileys/svg/187-rich.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/188-sad-2.png' srcset='../pictures/smileys/svg/188-sad-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/189-happy-1.png' srcset='../pictures/smileys/svg/189-happy-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/190-sad-1.png' srcset='../pictures/smileys/svg/190-sad-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/191-sad.png' srcset='../pictures/smileys/svg/191-sad.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/192-smile.png' srcset='../pictures/smileys/svg/192-smile.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/193-in-love-2.png' srcset='../pictures/smileys/svg/193-in-love-2.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/194-happy.png' srcset='../pictures/smileys/svg/194-happy.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/195-kiss-1.png' srcset='../pictures/smileys/svg/195-kiss-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/196-in-love-1.png' srcset='../pictures/smileys/svg/196-in-love-1.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/197-in-love.png' srcset='../pictures/smileys/svg/197-in-love.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/198-kiss.png' srcset='../pictures/smileys/svg/198-kiss.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/199-angry.png' srcset='../pictures/smileys/svg/199-angry.svg' class='smiley' /> 
						<img src='../pictures/smileys/png/200-sleepy.png' srcset='../pictures/smileys/svg/200-sleepy.svg' class='smiley' /> 
					</div>

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
				<p class='msg_leavetip'>Vous devez être connecté pour poster des messages.</p>
			<?php } ?>
		</div>
	<!-- <div style='color: grey; text-align: center;'>Smiley Icons made by <a href="https://www.flaticon.com/authors/vectors-market" title="Vectors Market">Vectors Market</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src='anim_tiptap.js' type='text/javascript'></script>

</html>