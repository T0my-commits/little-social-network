<?php

if (! isset($_SESSION['pseudo'])) { ?>
<header>
	<ul>
		<li><img src='../pictures/logoUnaware.png' alt='logo membre' /></li>
		<li><a href='../index.php' class='unaware'>Unaware</a></li>
		<li><?php include('date.php'); ?> </li>
		<li id='alea'><a href='../index.php'>Javascript est désactivé ? Cliquez ici.</a></li>

		<div class='button'>
			<li id='inscript'><a href='../members/index_members.php?inscription' class='inscript'>S'inscrire</a></li>
			<li id='connect'><a class='connect' href='../members/index_members.php?connection'>Se connecter</a></li>
			<li class='dropdown'>
				<a href='#menu' class='menu'><img src='../pictures/main_icon_purple.png' alt='Logo du menu' /></a>
				<div id='options_menu'>
					<img src='../pictures/dropdown_top.png' />
					<a href='#'>Mon profil</a>
					<a href='#'>Mes conversations</a>
					<a href='#' id='separator' class='dev_post'>Types d'études</a>
					<a href='../members/index_members.php?inscription' class='inscript'>S'inscrire</a>
					<a href='../members/index_members.php?connection'>Se connecter</a>
				</div>
			</li>
		</div>
	</ul>
</header>

<?php } else { ?>
<header>
	<ul>
		<div class='block1'>
			<li class='unaware'><a href='../index.php' class='unaware'>Unaware</a></li>
			<li><a href='#'>Mon profil</a></li>
			<li><a href='#'>Mes conversations</a></li>
			<li><a href='../forum/post_control.php'>Les conversations</a></li>
		</div>
		<!-- <li id='alea'><a href='no_javascript.php'>Javascript est désactivé ? Cliquez ici.</a></li> -->

		<div class='button'>
			<?php if ($_SERVER['PHP_SELF'] == "/forum/post_control.php") { ?>
				<li><img src='../pictures/research.png' class='research' /></li>
			<?php } else { ?>
				<li><?php include('date.php'); ?></li>
			<?php } ?>
			<li class='dropdown'>
				<img class='menu' src='../pictures/session_icons/green_gamepad.png' alt='Logo membre' style="cursor: pointer; border-radius: 500px;" />

				<div id='options_menu'>
					<img src='../pictures/dropdown_top.png' />
					<a href='#'>Mon profil</a>
					<a href='#'>Mes conversations</a>
					<a href='#' id='separator' class='dev_areas'>Types d'études</a>
					<a href='#' class='inscript'>Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']); ?> !</a>
					<a href='../members/index_members.php?disconnection'>Se déconnecter</a>
				</div>

			</li>
		</div>
	</ul>
</header>

<?php } ?>
