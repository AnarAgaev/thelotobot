<?
	/*
	 * This script:
	 * 1. closes the ended drawing
	 * 2. determines the winners of the drawing
	 * 3. Adds to the database a new raffle of the appropriate lottery type
	*/

	require_once dirname(__DIR__).'/config/connect.php'; // Connection to db

	// we get raffles in which we need to determine the winners and raffle them
	$RES__LOTTERY__DATA = mysqli_query($link,"
		SELECT
			`id_lottery`,
			`lottery_type`,
			`date`,
			`profit`
		FROM `lottery`
		WHERE `date` < NOW()
		AND `completed` = 0");

	for ($rld = 0; $rld < mysqli_num_rows($RES__LOTTERY__DATA); $rld++) {
		$row = mysqli_fetch_row($RES__LOTTERY__DATA);

		$ID__LOTTERY = $row[0];
		$LOTTERY_TYPE = $row[1];
		$DATE__PLAY = $row[2];
		$LOTTERY_PROFIT = $row[3];

		// close the lottery
		mysqli_query($link, "UPDATE `lottery` SET `completed` = 1 WHERE `id_lottery`= '$ID__LOTTERY'");

		// add a new lottery
		switch ($LOTTERY_TYPE) {
      case 'W':
        mysqli_query($link, "
          INSERT INTO `lottery`(
            `id_lottery`,
            `lottery_type`,
            `date`,
            `price`)
          VALUES (
            NULL,
            '$LOTTERY_TYPE',
            DATE_ADD(NOW(),
            INTERVAL 7 DAY),
            '50000')");
        break;

      case 'M':
				mysqli_query($link, "
					INSERT INTO `lottery`(
						`id_lottery`,
						`lottery_type`,
						`date`,
						`price`)
					VALUES (
						NULL,
						'$LOTTERY_TYPE',
						DATE_ADD(NOW(),
						INTERVAL 1 MONTH),
						'50000')");
        break;

      case 'Q':
				mysqli_query($link, "
					INSERT INTO `lottery`(
						`id_lottery`,
						`lottery_type`,
						`date`,
						`price`)
					VALUES (
						NULL,
						'$LOTTERY_TYPE',
						DATE_ADD(NOW(),
						INTERVAL 3 MONTH),
						'50000')");
        break;
    }

		// we get all tickets from the lottery being played and transfer them to a convenient array
		$RESULT__TICKETS = mysqli_query($link, "
			SELECT
				`id_ticket`,
				`num1`,
				`num2`,
				`num3`,
				`num4`,
				`num5`,
				`num6`,
				`num7`,
				`optim_md5hash`
			FROM `ticket`
			WHERE `id_lottery`='$ID__LOTTERY'
			AND `error`='NOT_ERROR'
			ORDER BY `id_ticket`
			ASC");

		$SOLD__TICKET = mysqli_num_rows($RESULT__TICKETS); // the number of tickets sold in the lottery
		$TICKETS = array(); // an array containing all the tickets of the lottery
		$AMOUNT_OF_NUMBERS_AS_LINE = 0; // the sum of all numbers represented by a string in all lottery tickets

		for ($s = 0; $s < $SOLD__TICKET; $s++) {
			$ONE_TICKET = array();

			$item = mysqli_fetch_row($RESULT__TICKETS);
			$ID_TICKETS = $item[0];

		  $NUMBERS_AS_LINE = ''; // обнуляем строку содержащую цифры билета

	    for($num = 1; $num < 8; $num++){
				$ONE_TICKET[] = $item[$num];
			}

			// concatenate all ticket digits into a string for further hashing
			for($z = 0; $z < 7; $z++) {
				$NUMBERS_AS_LINE .=  $ONE_TICKET[$z];
			}

			// write the resulting string from the ticket digits to the array
			$ONE_TICKET['NUMBERS_AS_LINE'] = $NUMBERS_AS_LINE;

			// hash the resulting string of ticket numbers
			$ONE_TICKET['HASH_OF_LINE'] = md5($NUMBERS_AS_LINE);

			// we cut everything except the digits from the hash of the sum
			$ONE_TICKET['HASH_WITHOUT_LETTERS'] = preg_replace('~[^0-9]+~', '', $ONE_TICKET['HASH_OF_LINE']);

			// cut zeros at the beginning and end of the line
			$ONE_TICKET['OPTIM_MD5_HASH_OF_AMOUNT']  = trim($ONE_TICKET['HASH_WITHOUT_LETTERS'], '0');

			// add a ticket to the array containing all tickets
			$TICKETS[$ID_TICKETS] = $ONE_TICKET;
		}

		// we consider the sum of all numbers concatenated in a row in all lottery tickets
		foreach($TICKETS as $VALUE) {
			$AMOUNT_OF_NUMBERS_AS_LINE += $VALUE['NUMBERS_AS_LINE'];
		}

		// save the sum of all numbers represented by a string of all tickets
		$TICKETS['AMOUNT_OF_NUMBERS_AS_LINE'] = number_format($AMOUNT_OF_NUMBERS_AS_LINE, 0, ".", "");

		// we get a hash from the sum of all numbers as a string of all tickets
		$TICKETS['MD5_HASH_OF_AMOUNT'] = md5($TICKETS['AMOUNT_OF_NUMBERS_AS_LINE']);

		// we cut everything except the digits from the hash of the sum
		$TICKETS['HASH_WITHOUT_LETTERS'] = preg_replace('~[^0-9]+~', '', $TICKETS['MD5_HASH_OF_AMOUNT']);

		// cut zeros at the beginning and end of the line
		$TICKETS['OPTIM_MD5_HASH_OF_AMOUNT'] = trim($TICKETS['HASH_WITHOUT_LETTERS'], '0');


		// add the sum of all numbers in the form of lines,
		// the number of tickets sold and the optimized hash
		// of the total of all lines in the lottery
		mysqli_query($link, "
			UPDATE `lottery`
			SET `amount_of_numbers_as_line`='$TICKETS[AMOUNT_OF_NUMBERS_AS_LINE]',
				`col_tickets_sold`='$SOLD__TICKET',
				`optim_md5hash`='$TICKETS[OPTIM_MD5_HASH_OF_AMOUNT]'
			WHERE `id_lottery`='$ID__LOTTERY'");


		// we get for each ticket a delta between its optimized hash and the optimized lottery hash
		foreach($TICKETS as $KEY => $VALUE){
			if (gettype($VALUE) == 'array' and isset($VALUE['OPTIM_MD5_HASH_OF_AMOUNT'])) {

				// save the delta in each ticket between its optimized hash and the hash of the sums of all hashes of all tickets
				$TICKETS[$KEY]['DELTA_OF_TICKET'] = abs($TICKETS['OPTIM_MD5_HASH_OF_AMOUNT'] - $VALUE['OPTIM_MD5_HASH_OF_AMOUNT']);
				$TICKETS[$KEY]['DELTA_OF_TICKET'] = number_format($TICKETS[$KEY]['DELTA_OF_TICKET'], 0, ".", "");

				// update the delta for each ticket of the processed lottery
				$DELTA__OF__TICKET = $TICKETS[$KEY]['DELTA_OF_TICKET'];
				mysqli_query($link, "
					UPDATE `ticket`
					SET `delta`='$DELTA__OF__TICKET'
					WHERE `id_ticket`='$KEY'");
			}
		}


		/*
		 * GET WINNERS
		*/
		$LARGEST_MAX = 0; // in this variable we will store the largest number in the lottery

		// get the largest playing number in the lottery
		foreach ($TICKETS as $VALUE) {
			if ( gettype($VALUE) == 'array' and isset($VALUE['DELTA_OF_TICKET']) ) {
				if ( $VALUE['DELTA_OF_TICKET'] > $LARGEST_MAX ) $LARGEST_MAX = $VALUE['DELTA_OF_TICKET'];
			}
		}

		// minimum value, after the first penetration it becomes the winner’s delta
		$MIN = 0;

		// the maximum value becomes in the delta of the winner after each penetration in the foreach loop inside the for
		$MAX = $LARGEST_MAX;

		 // the cycle is performed three times, because three types of places: first, second and third
		for( $p = 1; $p < 4; $p++ ) {
			foreach( $TICKETS as $VALUE ){
				if ( gettype($VALUE) == 'array' and isset($VALUE['DELTA_OF_TICKET']) ) {
					if( $MIN < $VALUE['DELTA_OF_TICKET'] and $VALUE['DELTA_OF_TICKET'] < $MAX ){
						$MAX = $VALUE['DELTA_OF_TICKET'];
					}
				}
			}
			// we are looking for more winners with the same delta as there may be several first,
			// second and third places (tickets with the same delta)
			foreach( $TICKETS as $KEY => $VALUE ){
				if ( gettype($VALUE) == 'array' and isset($VALUE['DELTA_OF_TICKET']) ) {
					if( $VALUE['DELTA_OF_TICKET'] == $MAX ){
						$WINNER[$p][$KEY] = $VALUE['DELTA_OF_TICKET'];
					}
				}
			}

			// reset the value of the minimum search in the winner delta to search for large deltas and places
			$MIN = $MAX;

			// reset the starting value of the ceiling for comparison
			$MAX = $LARGEST_MAX;
		}

		// add the winners of the draw in the database
		foreach($WINNER as $place => $arr_data){
			foreach($arr_data as $id_tick => $value){
				mysqli_query($link, "
					INSERT INTO `winner`(
						`id_winner`,
						`id_lottery`,
						`id_ticket`,
						`place`)
					 VALUES (
					  NULL,
					  '$ID__LOTTERY',
					  '$id_tick',
					  '$place')");
			}
		}


		// distribution of the results of the draw to the participants who left emails
		$RES__MAIL__SEND = mysqli_query($link, "
			SELECT
				`id_ticket`,
				`mail`,
				`num1`,
				`num2`,
				`num3`,
				`num4`,
				`num5`,
				`num6`,
				`num7`,
				`optim_md5hash`,
				`delta`,
				`date_create_ticket`,
				`date_payment_ticket`
			FROM `ticket`
			WHERE `id_lottery` = '$ID__LOTTERY'
			AND `mail` <> ''");

		for ($rms = 0; $rms < mysqli_num_rows($RES__MAIL__SEND); $rms++) {
			$row_mail = mysqli_fetch_row($RES__MAIL__SEND);

			$ID_TICKET = $row_mail[0];
			$EMAIL = $row_mail[1];
			$NUM1 = $row_mail[2];
			$NUM2 = $row_mail[3];
			$NUM3 = $row_mail[4];
			$NUM4 = $row_mail[5];
			$NUM5 = $row_mail[6];
			$NUM6 = $row_mail[7];
			$NUM7 = $row_mail[8];
			$OPTIM_MD5HASH = $row_mail[9];
			$DELTA = $row_mail[10];
			$DATE_CREATE_TICKET = date("Y-m-d", strtotime($row_mail[11]));
			$DATE_PAYMENT_TICKET = date("Y-m-d", strtotime($row_mail[12]));

			$MESSAGE = "Hello. You would like to get results of the Lotobot lottery.\r\n\n";
			$MESSAGE .= "*******\r\n\n";
			$MESSAGE .= "DATA OF THE LOTTERY:\r\n\n";
			$MESSAGE .= "Number of the lottery: ".$LOTTERY_TYPE.$ID__LOTTERY.";\r\n";
			$MESSAGE .= "Date of the draw: ".$DATE__PLAY.";\r\n";
			$MESSAGE .= "Sold ticket: ".$SOLD__TICKET.";\r\n";
			$MESSAGE .= "Optimized MD5 hash of the lottery: ".$TICKETS['OPTIM_MD5_HASH_OF_AMOUNT'].";\r\n";
			$MESSAGE .= "Profit fund: ".($LOTTERY_PROFIT/10000000)." Bitcoin.\r\n\n\n";

			$MESSAGE .= "YOUR TICKET DATA:\r\n\n";
			$MESSAGE .= "  Number of ticket: ".$ID__LOTTERY.'/'.$ID_TICKET.";\r\n";
			$MESSAGE .= "  Selected numbers: ".$NUM1." - ".$NUM2." - ".$NUM3." - ".$NUM4." - ".$NUM5." - ".$NUM6." - ".$NUM7.";\r\n";
			$MESSAGE .= "  Optimized MD5 hash: ".$OPTIM_MD5HASH.";\r\n";
			$MESSAGE .= "  The difference between the optimized hash of your ticket and the optimized hash of the lottery: ".$DELTA.";\r\n";
			$MESSAGE .= "  Date created the ticket: ".$DATE_CREATE_TICKET.";\r\n";
			$MESSAGE .= "  Date payment ticket: ".$DATE_PAYMENT_TICKET.".\r\n\n\n";

			$MESSAGE .= "DRAW RESULT AND WINNERS:\r\n\n";
			foreach($WINNER as $place => $arr_data){
				$MESSAGE .= "Category of winners number ".$place." - ";
				if($place == 1) $MESSAGE .= "got a 50% of profit:\r\n";
				elseif($place == 2) $MESSAGE .= "got a 30% of profit:\r\n";
				elseif($place == 3) $MESSAGE .= "got a 20% of profit:\r\n";
				foreach($arr_data as $id_tick => $value) {
					$MESSAGE .= "  Number of the ticket: ".$ID__LOTTERY.'/'.$id_tick."\r\n";
					$MESSAGE .= "  Selected numbers: " .
						$TICKETS[$id_tick][0] . " - " .
						$TICKETS[$id_tick][1] . " - " .
						$TICKETS[$id_tick][2] . " - " .
						$TICKETS[$id_tick][3] . " - " .
						$TICKETS[$id_tick][4] . " - " .
						$TICKETS[$id_tick][5] . " - " .
						$TICKETS[$id_tick][6] . "\r\n";
					$MESSAGE .= "  Optimized MD5 hash: " .
						$TICKETS[$id_tick]['OPTIM_MD5_HASH_OF_AMOUNT'] . "\r\n";
					$MESSAGE .= "  The difference between the optimized hash of the winning ticket and the optimized hash of the lottery: " .
						$TICKETS[$id_tick]['DELTA_OF_TICKET'] . "\r\n\n";
				}
			}
			$MESSAGE .= "*******\r\n\n\n";
			$MESSAGE .= "Thank you for playing the Lotobot lottery. Good luck.\r\n\n";
			$SUBJECT = "Results of the Lotobot lottery.";
			$SUBJECT = "=?utf-8?b?". base64_encode($SUBJECT) ."?=";
			$FROM = "Lotobot - bitcoin lottery";
			$FROM = "=?utf-8?b?". base64_encode($FROM) ."?=";
			$HEADER = "Content-type: text/plain; charset=utf-8\r\n";
			$HEADER .= "From: ".$FROM."<hi@thelotobot.com>\r\n";
			$HEADER .= "MIME-Version: 1.0\r\n";
			$HEADER .= "Date: ".date('D, d M Y h:i:s O');

			mail($EMAIL, $SUBJECT, $MESSAGE, $HEADER);
		}

		unset($WINNER,$TICKETS,$AVAERAGE__OF__ALL,$SUM__OF__ALL,$NUMBER__OF__ALL);
	}
?>