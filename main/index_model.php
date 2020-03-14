<?php

function choose_bg() {
	$tableau = array('hzd/hzd01.jpg', 
						'hzd/hzd02.jpg', 
						'hzd/hzd03.jpg', 
						'hzd/hzd04.jpg', 
						'hzd/hzd05.jpg', 
						'hzd/hzd06.jpg', 
						'hzd/hzd07.jpg', 
						'hzd/hzd08.jpg', 
						'hzd/hzd09.jpg', 
						'hzd/hzd10.jpg', 
						'hzd/hzd11.jpg', 
						'hzd/hzd12.jpg', 
						'hzd/hzd13.jpg', 
						'hzd/hzd14.jpg', 
						'hzd/hzd15.jpg', 
						'hzd/hzd16.jpg', 
						'hzd/hzd17.jpg', 
						'hzd/hzd18.jpg', 
						'hzd/hzd19.jpg', 
						'hzd/hzd20.jpg', 
						'hzd/hzd21.jpg', 
						'hzd/hzd22.jpg', 
						'hzd/hzd23.jpg', 
						'hzd/hzd24.jpg', 
						'hzd/hzd25.jpg', 
						'hzd/hzd26.jpg', 
						'hzd/hzd27.jpg', 
						'hzd/hzd28.jpg', 
						'hzd/hzd29.jpg', 
						'hzd/hzd30.jpg', 
						'hzd/hzd31.jpg', 
						'hzd/hzd32.jpg', 
						'hzd/hzd33.jpg', 
						'hzd/hzd34.jpg', 
						'hzd/hzd35.jpg', 
						'hzd/hzd36.jpg', 
						'hzd/hzd37.jpg', 
						'hzd/hzd38.jpg', 
						'hzd/hzd39.jpg', 
						'hzd/hzd40.jpg', 
						'hzd/hzd41.jpg', 
						'hzd/hzd42.jpg', 
						'hzd/hzd43.jpg', 
						'hzd/hzd44.jpg',
						'aco/aco01.jpeg',
						'aco/aco02.jpg',
						'aco/aco03.jpeg',
						'aco/aco04.jpeg',
						'aco/aco05.jpeg',
						'aco/aco06.jpeg',
						'aco/aco07.jpeg',
						'aco/aco08.jpeg',
						'aco/aco09.jpeg',
						'aco/aco10.jpeg',
						'aco/aco11.jpeg',
						'aco/aco12.jpeg',
						'aco/aco13.jpeg',
						'aco/aco14.jpeg',
						'aco/aco15.jpeg',
						'aco/aco16.jpeg',
						'aco/aco17.jpeg',
						'aco/aco18.jpeg',
						'aco/aco19.jpeg',
						'aco/aco20.jpeg',
						'aco/aco21.jpeg',
						'aco/aco22.jpeg',
						'aco/aco23.jpeg',
						'aco/aco24.jpeg',
						'aco/aco25.jpeg',
						'aco/aco26.jpeg',
						'aco/aco27.jpeg',
						'aco/aco28.jpeg',
						'aco/aco29.jpeg',
						'aco/aco30.jpeg',
						'aco/aco31.jpeg',
						'aco/aco32.jpeg',
						'tlou/tlou01.jpg',
						'tlou/tlou02.jpg',
						'tlou/tlou03.jpg',
						'u4/u01.jpg',
						'u4/u02.jpg',
						'u4/u03.jpg',
						'u4/u04.jpg',
						'u4/u05.jpg');

	$i = mt_rand(0, count($tableau)-1);
	if ($_SERVER['PHP_SELF'] != '/index.php') {
		$prefix = '../';
	}
	else {
		$prefix = '';
	}
	$background = $prefix . 'pictures/backgrounds/' . $tableau[$i];
	return $background;
} 
?>

<?php ob_start(); ?>
<style>
		body
		{
			background: url(<?= choose_bg(); ?>) no-repeat center fixed;
			-webkit-background-size: cover; /* pour anciens Chrome et Safari */
			background-size: cover; /* version standardisée */
		}
	</style>
<?php $bg_change = ob_get_clean(); ?>