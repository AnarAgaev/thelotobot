<?
	// Get the referrer data and verify user
	session_start();

	require_once'../config/connect.php';

	if ( isset($_POST['num']) and isset($_POST['mail']) and isset($_POST['pas']) ) {
		$ID__REFERRAL = htmlspecialchars(strip_tags(trim($_POST['num'])));
		$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));
		$PASSWORD = htmlspecialchars(strip_tags(trim($_POST['pas'])));

		$HASH__FROM__DB = mysqli_fetch_assoc(mysqli_query($link, "
			SELECT `hash`
			FROM `referrer`
			WHERE `id_referrer`='$ID__REFERRAL'
			AND `mail`='$MAIL'"));
		if( password_verify($PASSWORD, $HASH__FROM__DB['hash']) ) echo 'true';
		else echo 'error';
	} else echo 'false';
?>