<?
	// This script send ticket data to the owner/crater

	if (isset($_POST['id__added__ticket']) and isset($_POST['mail'])){
		$ID__TICKET = htmlspecialchars(strip_tags(trim($_POST['id__added__ticket'])));
		$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));

		// Get data
		require_once'../config/connect.php';
		$RESULT = mysqli_fetch_assoc(mysqli_query($link, "
			SELECT
				`id_lottery`,
				`address`,
				`invoice`,
				`num1`,
				`num2`,
				`num3`,
				`num4`,
				`num5`,
				`num6`,
				`num7`,
				`optim_md5hash`,
				`date_create_ticket`,
				`date_payment_ticket`,
				`error`
			FROM `ticket`
			WHERE `id_ticket`='$ID__TICKET'"));

		$ID_LOTTERY =$RESULT['id_lottery'];
		$DATE__LOTTERY = mysqli_fetch_assoc(mysqli_query($link, "
			SELECT
				`id_lottery`,
				`lottery_type`,
				`date`,
				`price`
			FROM `lottery`
			WHERE `id_lottery`='$ID_LOTTERY'"));

		// Create and send mail
		$message = "Hey. You bought a lottery ticket for bitcoin lottery Lotobot.\r\n\n";
		$message .= "*******\r\n\n";
		$message .= "Your check:\r\n\n";
		$message .= "Ticket number: ".$ID_LOTTERY."/".$ID__TICKET."\r\n";
		$message .= "Pay to the wallet: ".$RESULT['address']."\r\n";
		$message .= "Number of the invoice: ".$RESULT['invoice']."\r\n";
		$message .= "Selected numbers: ".$RESULT['num1']." - ".$RESULT['num2']." - ".$RESULT['num3']." - ".$RESULT['num4']." - ".$RESULT['num5']." - ".$RESULT['num6']." - ".$RESULT['num7']."\r\n";
		$message .= "Optimized MD5 hash: ".$RESULT['optim_md5hash']."\r\n";
		$message .= "The date of creating the ticket: ".$RESULT['date_create_ticket']."\r\n";
		$message .= "Status: ".$RESULT['error']."\r\n\n";
		$message .= "Lottery number: ".$DATE__LOTTERY['lottery_type'].$DATE__LOTTERY['id_lottery']."\r\n";
		$message .= "Date of the drawing: ".$DATE__LOTTERY['date']."\r\n";
		$message .= "Price of the lottery ticket: ".$DATE__LOTTERY['price']." Satoshi\r\n\n";
		$message .= "*******\r\n\n";
		$message .= "Please note, there is no password in the receipt. Save the password separately from the email. You will need the password to receive the winnings.\r\n\n\n";

		$subject = "Your ticket on Lotobot";
		$subject = "=?utf-8?b?". base64_encode($subject) ."?=";

		$from = "Lotobot - bitcoin lottery";
		$from = "=?utf-8?b?". base64_encode($from) ."?=";
		$header = "Content-type: text/plain; charset=utf-8\r\n";
		$header .= "From: ".$from."<hi@thelotobot.com>\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Date: ".date('D, d M Y h:i:s O');

		if(mail($MAIL, $subject, $message, $header)) {
			echo 'true';
			mysqli_query($link, "UPDATE `ticket` SET `mail`='$MAIL' WHERE `id_ticket`='$ID__TICKET'"); // define mail on db
		} else echo 'false';
	} else echo 'false';
?>