<?
	session_start();

	require_once'../config/connect.php';

	if( isset($_POST['mail']) and $_POST['mail'] != '' ){
		$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));

		// Let's see if there is an email in the database
		$RES__PARTNER__DATA =  mysqli_fetch_assoc(mysqli_query($link, "SELECT `id_referrer` FROM `referrer` WHERE `mail`='$MAIL'"));

		if( $RES__PARTNER__DATA == '') {

			require_once 'generate-password.php'; // connection password generator
			$PASSWORD =  passwordGenerator(10);  // generate password
			$HASH__OF__PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT); // hash of password

			//Add a new partner to the db
			mysqli_query($link, "INSERT INTO `referrer`(`id_referrer`, `hash`, `mail`) VALUES (null,'$HASH__OF__PASSWORD','$MAIL')");
			$ID__ADDED__PARTNER = mysqli_insert_id($link);

			$PARTNER['id'] = $ID__ADDED__PARTNER;
			$PARTNER['pas'] = $PASSWORD;
			$PARTNER['mail'] = $MAIL;
			$PARTNER['link'] = 'thelotobot.com/?ref='.$ID__ADDED__PARTNER;

			$json = defined('JSON_UNESCAPED_UNICODE')
			  ? json_encode($PARTNER, JSON_UNESCAPED_UNICODE)
			  : json_encode($PARTNER);
			echo $json;
		}
		else echo 'email_busy';
	} else echo 'false';
?>
