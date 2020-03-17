<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>Unaware - Acceuil membres</title>
	<link href='color/color_purple.css' rel='stylesheet' />
	<link href='css/index_style.css' rel='stylesheet' />
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
	<?= $bg_change; ?>
</head>

<body>
	<div class='opt'>
		<a href='#'><img src='pictures/menu_icon.png' /><br />Menu</a>
		<?= $opt; ?>
	</div>

	<?php if (isset($_SESSION['id'])) { ?>
		<div class='title'>
			<h2>Bonjour <?= htmlspecialchars($_SESSION['firstname']); ?></h2>
		</div>
	<?php } ?>

	<div class='title'>
		<h1>Et un jour de plus sur Unaware :)</h1>
	</div>
	<div class='puces'>
		<a href='#'><div class='menu'><img src='pictures/wall_actu.png' /><br />Mur d'actualités</div></a>
		<a href='#'><div class='menu'><img src='pictures/forum_icon.png' /><br />Forum</div></a>
		<a href='control/tiptap_control.php'><div class='menu'><img src='pictures/tiptap_icon.png' /><br />Tip & Tap</div></a>
		<a href='#'><div class='menu'><img src='pictures/profile_icon.png' /><br />Options</div></a>
	</div>

	<div class='date'>
		<p><em><?php include('goodies/date.php'); ?></em></p>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src='js/background.js' type='text/javascript'></script>

</html>
