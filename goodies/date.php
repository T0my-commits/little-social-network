<?php

// We fixed the day of the week;
$jour = 'Monday';
switch (date('N'))
{
	case 1:
		$jour = 'Lundi';
	break;

	case 2:
		$jour = 'Mardi';
	break;

	case 3:
		$jour = 'Mercredi';
	break;

	case 4:
		$jour = 'Jeudi';
	break;

	case 5:
		$jour = 'Vendredi';
	break;

	case 6:
		$jour = 'Samedi';
	break;

	case 7:
		$jour = 'Dimanche';
	break;
}

// We fixed the month of the year;
$mois = 'janvier';
switch (date('n'))
{
	case 1:
		$mois = 'janvier';
	break;

	case 2:
		$mois = 'février';
	break;
	
	case 3:
		$mois = 'mars';
	break;
	
	case 4:
		$mois = 'avril';
	break;
	
	case 5:
		$mois = 'mai';
	break;
	
	case 6:
		$mois = 'juin';
	break;
	
	case 7:
		$mois = 'juillet';
	break;
	
	case 8:
		$mois = 'aout';
	break;
	
	case 9:
		$mois = 'septembre';
	break;
	
	case 10:
		$mois = 'octobre';
	break;
	
	case 11:
		$mois = 'novembre';
	break;
	
	case 12:
		$mois = 'décembre';
	break;
}

echo $jour . ' ' . date('d') . ' ' . $mois . ' ' . date('Y'); // . ', ' . date('H') . 'h ' . date('i') ;

?>
