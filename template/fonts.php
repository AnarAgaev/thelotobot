<?
	// connection fonts for selected language
	switch ($_SESSION['LANG']) {
		case 'uk':
		case 'ru':
			echo "<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Roboto:100,300,400,500,700,900&display=swap&subset=cyrillic');</style>";
			break;
		case 'grk':
			echo "<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Roboto:100,300,400,500,700,900&display=swap&subset=greek');</style>";
			break;
		case 'vi':
			echo "<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Roboto:100,300,400,500,700,900&display=swap&subset=vietnamese');</style>";
			break;
		default:
			echo "<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Roboto:100,300,400,500,700,900&display=swap');</style>";
			break;
	}
?>