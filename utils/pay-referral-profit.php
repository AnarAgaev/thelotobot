<?
	// Pay referrer profit to the wallet

	session_start();
	require_once'../config/connect.php';

	$EMAIL = 'support@thelotobot.com'; // mail of support

	if ( isset($_POST['wallet']) and isset($_POST['id_lottery']) and isset($_POST['id_refferrer']) ) {

		$WALLET = htmlspecialchars(strip_tags(trim($_POST['wallet'])));
		$ID_LOTTERY = htmlspecialchars(strip_tags(trim($_POST['id_lottery'])));
		$ID_REFERRER = htmlspecialchars(strip_tags(trim($_POST['id_refferrer'])));


		// Add information of query at DB
		mysqli_query($link, "
			INSERT INTO `payment`(
				`id_payment`,
				`id_lottery`,
				`id_referrer`,
				`address`,
				`request_date`)
			VALUES (
				NULL,
				'$ID_LOTTERY',
				'$ID_REFERRER',
				'$WALLET',
				NOW())");

		$ID_QUERY = mysqli_insert_id($link);

		if($ID_QUERY != '') {

			// Send message to the suppurt
			$MESSAGE = "Hello. New message from the Lotobot website.\r\n";
			$MESSAGE .= "Referral with id ".$ID_REFERRER." asks for profit\r\n\n";
			$MESSAGE .= "*******\r\n";
			$MESSAGE .= "Referral data:\r\n";
			$MESSAGE .= "Id refferrer: ".$ID_REFERRER."\r\n";
			$MESSAGE .= "Id lottery: ".$ID_LOTTERY."\r\n";
			$MESSAGE .= "Wallet for payment: ".$WALLET."\r\n";
			$MESSAGE .= "ID of query in DB: ".$ID_QUERY."\r\n";
			$MESSAGE .= "*******\r\n\n\n";
			$MESSAGE .= "I remind you, according to the rules of the lottery, the referral profit must be paid within 24 hours.\r\n\n";
			$SUBJECT = "Message from the Lotobot website referral.";
			$SUBJECT = "=?utf-8?b?". base64_encode($SUBJECT) ."?=";
			$FROM = "Lotobot - bitcoin lottery";
			$FROM = "=?utf-8?b?". base64_encode($FROM) ."?=";
			$HEADER = "Content-type: text/plain; charset=utf-8\r\n";
			$HEADER .= "From: ".$FROM."<hi@thelotobot.com>\r\n";
			$HEADER .= "MIME-Version: 1.0\r\n";
			$HEADER .= "Date: ".date('D, d M Y h:i:s O');

			if( mail($EMAIL, $SUBJECT, $MESSAGE, $HEADER) ) {
				echo 'form_get_profit_'.$ID_LOTTERY;
			} else echo 'error';
		} else echo 'error';
	} else echo 'error';
?>