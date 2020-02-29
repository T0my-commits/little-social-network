<?php

if (! isset($_COOKIE['color_theme']) AND ! isset($_GET['choose_color'])) {
	$color = "color_purple.css";
}
elseif (! isset($_GET['choose_color'])) {
	if (is_numeric($_COOKIE['color_theme']) AND strlen($_COOKIE['color_theme']) <= 2) {
		$numColor = strip_tags($_COOKIE['color_theme']);
		$color = getColor($numColor);
	}
	else {
		$color = "color_red.css";
	}
}

function getColor($numColor)
{
	$numColor = intval($numColor);
	switch ($numColor)
	{
		case 1:
			$color = 'color_blue.css';
			break;
		case 2:
			$color = 'color_brown.css';
			break;
		case 3:
			$color = 'color_dark_green.css';
			break;
		case 4:
			$color = 'color_green.css';
			break;
		case 5:
			$color = 'color_green_blue.css';
			break;
		case 6:
			$color = 'color_oreo.css';
			break;
		case 7:
			$color = 'color_pale_green.css';
			break;
		case 8:
			$color = 'color_pink.css';
			break;
		case 9:
			$color = 'color_purple.css';
			break;
		case 10:
			$color = 'color_red.css';
			break;
	}

	return $color;
}

function makeColor($numColor)
{
	setcookie('color_theme', $numColor, time() + 365*24*3600, null, null, false, true);
	header('Location: ../index.php');
}