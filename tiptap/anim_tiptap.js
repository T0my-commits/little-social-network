$('.msgNoJs').text('Cacher le message');
$('#alea').css('display', 'none');

$(function souris(event) {
	var x = event.clientX;
	var y = event.clientY;
	document.getElementByClassName('msg p').value = x + ', ' + y;
	//Nouveau code :
	var element = document.getElementByClassName('reponse');
	element.style.position = 'absolute';
	element.style.left = x + 'px';
	element.style.top = y + 'px';
});

$('.title_msg').on('click', function() {
	$('.title').slideToggle();
});

$('.menu').on('click', function() {
	$('#options_menu').slideToggle(150).css('display', 'block');
	$(this).toggle(150).toggle(150);
});