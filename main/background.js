/*
// Change background;
// -----------------------------------------------------------------------

// Definition des variables;
var tableau = new Array('hzd/hzd01.jpg',
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

// Definition de la fonction getRandomInt();
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min; //The maximum is inclusive and the minimum is inclusive too;
}

// Definition de la fonction changeBackground();
function changeBackground() {
	var i = getRandomInt(0, tableau.length);
	$('html').css('background', 'url("../pictures/backgrounds/' + tableau[i] + '") no-repeat center fixed');
}

changeBackground();
//setTimeout(function() {
//	changeBackground();
//}, (10000));
*/

// Others;
// -----------------------------------------------------------------------

$('a').on('click', function() {
	$(this).fadeOut(100).fadeIn(100);
});

$('.registration').on('click', function() {
	$('.registration_form').css('display', 'block').fadeIn();
});