<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='color/color_purple.css' rel='stylesheet' />
	<link href='main/style.css' rel='stylesheet' />
	<?= $bg_change; ?>
</head>

<body>

<!--
	<div class='personnalisation'>
		<div class='custom'>
			<h4>\\ Accéder à..</h4>
			<div class='accedera'>
				<a href='#'><div class='menu'><img src='pictures/wall_actu.png' /><br />Mur d'actualités</div></a>
				<a href='forum/post_control.php'><div class='menu'><img src='pictures/forum_icon.png' /><br />Forum</div></a>
				<?= $opt; ?>
			</div>
			<h4>\\ Choisir un thème</h4>
			<em>En sélectionnant un thème, vous acceptez l'utilisation des cookies.</em>
			<p>Blabla...</p>
		</div>
	</div>
-->

	<div class='opt'>
		<a href='#'><img src='pictures/menu_icon.png' /><br />Menu</a>
		<?= $opt; ?>
	</div>
	<div class='title'>
		<h1>Et un jour de plus sur Unaware :)</h1>
	</div>
	<div class='puces'>
		<a href='#'><div class='menu'><img src='pictures/wall_actu.png' /><br />Mur d'actualités</div></a>
		<a href='#'><div class='menu'><img src='pictures/forum_icon.png' /><br />Forum</div></a>
		<a href='tiptap/tiptap_control.php'><div class='menu'><img src='pictures/tiptap_icon.png' /><br />Tip & Tap</div></a>
		<a href='#'><div class='menu'><img src='pictures/profile_icon.png' /><br />Options</div></a>
	</div>

	<div class='date'>
		<p><em><?php include('goodies/date.php'); ?></em></p>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src='main/background.js' type='text/javascript'></script>

</html>
