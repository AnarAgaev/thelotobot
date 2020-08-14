<?
	// Payoff user profit to the wallet

	session_start();

	require_once'../config/connect.php';

	$EMAIL = 'support@thelotobot.com'; // mail of support

	if (isset( $_POST['num'] ) and
			isset( $_POST['inv'] ) and
			isset( $_POST['pas'] ) and
			isset( $_POST['wallet'] ) and
			isset( $_POST['mail'] )) {

		$NUM = explode("/", htmlspecialchars(strip_tags(trim($_POST['num']))));
		$ID__LOTTARY = $NUM['0'];
		$ID__TICKET = $NUM['1'];
		$INVOICE = htmlspecialchars(strip_tags(trim($_POST['inv'])));
		$PASSWORD = htmlspecialchars(strip_tags(trim($_POST['pas'])));
		$WALLET = htmlspecialchars(strip_tags(trim($_POST['wallet'])));
		$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));

		if( !preg_match('#^[0-9]+$#', $ID__LOTTARY) or !preg_match('#^[0-9]+$#', $ID__TICKET)) {
				echo 'error__date';
		}
		else {

			// Get the password from the database
			$HASH__FROM__DB = mysqli_fetch_assoc(mysqli_query($link, "
				SELECT `hash`
				FROM `data`
				WHERE `id_ticket`='$ID__TICKET'"));

			if( password_verify($PASSWORD, $HASH__FROM__DB['hash']) ) { // check passwords

				// Check the winner or not
				$WINNER__FROM__DB = mysqli_fetch_assoc(mysqli_query($link, "
					SELECT `place`
					FROM `winner`
					WHERE `id_lottery`='$ID__LOTTARY'
					AND `id_ticket`='$ID__TICKET'"));

				if ($WINNER__FROM__DB['place'] != '') {

					// check the query in the database and it's status
					$DATE__PAY__QUERY = mysqli_fetch_assoc(mysqli_query($link, "
						SELECT
							`id_payoff`,
							`payment_amount`,
							`pyment_date`
						FROM `payoff`
						WHERE `id_ticket`='$ID__TICKET'"));

					if ($DATE__PAY__QUERY['id_payoff'] == '') {
						// define payoff at DB
						mysqli_query($link, "
							INSERT INTO `payoff`(
								`id_payoff`,
								`id_ticket`,
								`id_lottery`,
								`invoice`,
								`wallet`,
								`mail`,
								`request_date`)
							VALUES (
								NULL,
								'$ID__TICKET',
								'$ID__LOTTARY',
								'$INVOICE',
								'$WALLET',
								'$MAIL',
								NOW())");

						// Query id in the database
						$QUERY__ID = mysqli_insert_id($link);

						if ($QUERY__ID != '') {
							// Send message to the support
							$MESSAGE = "Hello. New message from the Lotobot website.\r\n";
							$MESSAGE .= "Player asks for profit.\r\n\n";
							$MESSAGE .= "*******\r\n\n";
							$MESSAGE .= "Ticket date:\r\n";
							$MESSAGE .= "Id lottary: ".$ID__LOTTARY."\r\n";
							$MESSAGE .= "Id ticket: ".$ID__TICKET."\r\n";
							$MESSAGE .= "Invoice: ".$INVOICE."\r\n";
							$MESSAGE .= "Wallet for payoff: ".$WALLET."\r\n";
							$MESSAGE .= "Mail for contacts: ".$MAIL."\r\n";
							$MESSAGE .= "Query id in the database: ".$QUERY__ID."\r\n";
							$MESSAGE .= "Password entered correctly\r\n\n";
							$MESSAGE .= "*******\r\n\n";
							$MESSAGE .= "I remind you, according to the rules of the lottery, the player profit must be paid within 24 hours.\r\n\n";
							$SUBJECT = "Message from the Lotobot website player.";
							$SUBJECT = "=?utf-8?b?". base64_encode($SUBJECT) ."?=";
							$FROM = "Lotobot - bitcoin lottery";
							$FROM = "=?utf-8?b?". base64_encode($FROM) ."?=";
							$HEADER = "Content-type: text/plain; charset=utf-8\r\n";
							$HEADER .= "From: ".$FROM."<hi@thelotobot.com>\r\n";
							$HEADER .= "MIME-Version: 1.0\r\n";
							$HEADER .= "Date: ".date('D, d M Y h:i:s O');

							if( mail($EMAIL, $SUBJECT, $MESSAGE, $HEADER) ) echo 'true';
							else echo 'error__send__mail';
						} else echo 'error__send__mail';
					} else {
						if ($DATE__PAY__QUERY['payment_amount'] == 0 and $DATE__PAY__QUERY['pyment_date'] == 0) {
							echo 'pay_in_progress';
						} else echo 'pay__completed';
					}
				} else echo 'not__winner';
			} else echo 'error__date';
		}
	} else echo 'error__date';
?>
