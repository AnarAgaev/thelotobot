<?php
	/*
	 * Get the data of the selected ticket
	*/

	session_start();

	require_once'../config/connect.php'; // Connection to db

	// Get content from db for complete array with text data of ticket
	require_once 'get-page-content.php';

  $CONTENT = getAllPagesContent($link);

	if( isset($_POST['num']) and isset($_POST['inv']) and isset($_POST['pas']) ) {
		$NUMBER = htmlspecialchars(strip_tags(trim($_POST['num'])));
		$INVOICE = htmlspecialchars(strip_tags(trim($_POST['inv'])));
		$PASSWORD = htmlspecialchars(strip_tags(trim($_POST['pas'])));

		$IDS = explode('/', $NUMBER);
		$ID_LOTTERY = $IDS[0];
		$ID_TICKET = $IDS[1];

		if( !preg_match('#^[0-9]+$#', $ID_LOTTERY) or !preg_match('#^[0-9]+$#', $ID_TICKET)) {
				echo 'error';
		}
		else {
			$INVOICE__FROM__DB = mysqli_fetch_assoc(mysqli_query($link, "
				SELECT `invoice`
				FROM `ticket`
				WHERE `id_ticket`=$ID_TICKET
				AND `id_lottery`=$ID_LOTTERY"))	;
			if ($INVOICE__FROM__DB['invoice'] == $INVOICE) { //compare invoices

				$HASH__FROM__DB = mysqli_fetch_assoc(mysqli_query($link, "
					SELECT `hash`
					FROM `data`
					WHERE `id_ticket`='$ID_TICKET'"));

				if ( password_verify($PASSWORD, $HASH__FROM__DB['hash']) ) { //compare passwords

					$RESAULT__TICKET = mysqli_fetch_assoc(mysqli_query($link, "
						SELECT *
						FROM `ticket`
						WHERE `id_ticket`='$ID_TICKET'"));
					$RESAULT__LOTTERY = mysqli_fetch_assoc(mysqli_query($link, "
						SELECT *
						FROM `lottery`
						WHERE `id_lottery`='$ID_LOTTERY'"));

					$RESAULT = array_merge($RESAULT__LOTTERY, $RESAULT__TICKET); // It is possible to overwrite data. When edit, check.

					$RESAULT['date_create_ticket'] = date("Y-m-d h:i A",strtotime($RESAULT['date_create_ticket']));

					if (!$RESAULT['date_payment_ticket'] == 0) $RESAULT['date_payment_ticket'] = $CONTENT['NOT_PAID'];
					else $RESAULT['date_payment_ticket'] = date("Y-m-d h:i A",strtotime($RESAULT['date_payment_ticket']));

					$RESAULT['date'] = date("Y-m-d",strtotime($RESAULT['date']));
					$RESAULT['amount'] = $RESAULT['amount']/100000000;

					if ($RESAULT['completed']) $RESAULT['completed'] = $CONTENT['LOTTERY_STATUS_CLOSE'];
					else $RESAULT['completed'] = $CONTENT['LOTTERY_STATUS_OPEN'];

					if ($RESAULT['error'] == 'NOT_PAID') $RESAULT['error'] = $CONTENT['NOT_PAID'];
					else if($RESAULT['error'] == 'NOT_ERROR') $RESAULT['error'] = $CONTENT['PAID'];

					$RESAULT['lottery_type_as_text'] = $CONTENT['LOTTERY_TYPE_'.strtoupper($RESAULT__LOTTERY['lottery_type'])];
					$RESAULT['price'] = $RESAULT['price']/100000000;
					$RESAULT['profit'] = $RESAULT['profit']/100000000;

					$RESAULT['moment'] = $CONTENT['MOMENT_SHOW_TICKET'];

					$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
					  ? json_encode($RESAULT, JSON_UNESCAPED_UNICODE)
					  : json_encode($RESAULT);

					echo $JSON__DATA;
				} else echo 'error';
			} else echo 'error';
		}
	} else echo 'false';
?>