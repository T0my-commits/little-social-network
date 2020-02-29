$('.msgNoJs').text('Cacher le message');
$('#alea').css('display', 'none');

function resize(textarea) {
    var txt = textarea.value;
    var line = txt.split("\n");
    var nbr_lines = 1;
    for(var i=0;i<line.length;i++) {
        nbr_lines += Math.ceil(line[i].length / (textarea.cols + 7));
    }
    textarea.rows = nbr_lines;
}

/*
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
*/

$('.msgNoJs').on('click', function() {
	$('.title').slideToggle();
});

$('.menu').on('click', function() {
	$('#options_menu').slideToggle(150).css('display', 'block');
	$(this).toggle(150).toggle(150);
});

$("header a").on('click', function() {
	$(this).slideToggle(150).slideToggle(150);
});

$('.msg_footer').on('click', function() {
	$(this).slideToggle(150).slideToggle(150);
	$(this).parent().next('.showTextAreaForTap').slideToggle().css('display', 'block');
});

$('.modif_footer').on('click', function() {
	$(this).slideToggle(150).slideToggle(150);
	$(this).parent().next('.showTextAreaForTap').next('.showTextAreaForTap').slideToggle().css('display', 'block');
});

$('.modif_tap_footer').on('click', function() {
	$(this).slideToggle(150).slideToggle(150);
	$(this).parent().next('.showTextAreaForTap').slideToggle().css('display', 'block');
});