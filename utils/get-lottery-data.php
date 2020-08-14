<?
	/*
	 * The script create array $RESULTS that has data of lotteries,
	 * winners and victorious places
	*/

	session_start();
	require_once'../config/connect.php';

	$ID_LANG = htmlspecialchars(strip_tags(trim($_POST['id_lang']))); // ID of the language

	$ISSUE__NUMBER = htmlspecialchars(strip_tags(trim($_POST['issue_number']))); // number of the selected lottery
	$TYPE__OF__LOTTERY = substr($ISSUE__NUMBER, 0, 1); // type of the selected lottery
	$TYPE__OF__LOTTERY = mb_strtoupper($TYPE__OF__LOTTERY, 'UTF-8'); // do the lottery type as upper
	$ID__OF__LOTTERY = substr($ISSUE__NUMBER, 1); // id of the selected lottery

	if( preg_match('#^[0-9]+$#', $ID__OF__LOTTERY) ) {

		$RES__LOTTERY__DATA = mysqli_fetch_assoc(mysqli_query($link,
			"SELECT
				`date`,
				`price`,
				`profit`,
				`amount_of_numbers_as_line`,
				`col_tickets_sold`,
				`optim_md5hash`,
				`completed`
			FROM `lottery`
			WHERE `id_lottery`= '$ID__OF__LOTTERY'
			AND `lottery_type`='$TYPE__OF__LOTTERY'"));

		if ($RES__LOTTERY__DATA) {
			if ($RES__LOTTERY__DATA['completed'] == 0) {
				echo 'did_not_play'; // lottery has not played yet
			} else {
				$RESULTS['LOTTERY__TYPE'] = $TYPE__OF__LOTTERY;

				$NAME_CONTENT_BLOCK = 'LOTTERY_TYPE_'.$RESULTS['LOTTERY__TYPE'];
				$RES__LOTTERY__TYPE = mysqli_fetch_assoc(mysqli_query($link,
					"SELECT `value_content_block`
					FROM `content`
					WHERE `name_content_block`='$NAME_CONTENT_BLOCK'
					AND `id_lang`='$ID_LANG'
					AND `id_page`=0"));
				$RESULTS['LOTTERY__TYPE_STRING'] = $RES__LOTTERY__TYPE['value_content_block'];

				$RESULTS['ID_LOTTERY'] = $ID__OF__LOTTERY;
				$RESULTS['DATE__GAME'] = $RES__LOTTERY__DATA['date'];
				$RESULTS['PRICE'] = $RES__LOTTERY__DATA['price'];
				$RESULTS['PROFIT'] = $RES__LOTTERY__DATA['profit'] / 100000000;
				$RESULTS['AMOUNT_OF_NUMBERS_AS_LINE'] = $RES__LOTTERY__DATA['amount_of_numbers_as_line'];
				$RESULTS['COL_TICKETS_SOLD'] = $RES__LOTTERY__DATA['col_tickets_sold'];
				$RESULTS['OPTIM_MD5HASH'] = $RES__LOTTERY__DATA['optim_md5hash'];

				// adding winners in the array width lottery
				$RES__WINNER__DATA = mysqli_query($link,
				"SELECT
					`id_ticket`,
					`place`
				FROM `winner`
				WHERE `id_lottery` = '$ID__OF__LOTTERY'
				ORDER BY `place` ASC");

				for($i=0; $i < mysqli_num_rows($RES__WINNER__DATA); $i++) {
					$row = mysqli_fetch_row($RES__WINNER__DATA);
					$ID_TICKET = $row[0];
					$PLACE = $row[1];

					$TICKET__DATE = mysqli_fetch_assoc(mysqli_query($link,
						"SELECT
							`lang`,
							`num1`,
							`num2`,
							`num3`,
							`num4`,
							`num5`,
							`num6`,
							`num7`,
							`optim_md5hash`,
							`delta`,
							`date_create_ticket`
						FROM `ticket`
						WHERE `id_ticket`='$ID_TICKET'"))	;

					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['LANG'] = $TICKET__DATE['lang'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['OPTIM_MD5HASH'] = $TICKET__DATE['optim_md5hash'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['DELTA'] = $TICKET__DATE['delta'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['DATE_CREATE'] = date("Y-m-d", strtotime($TICKET__DATE['date_create_ticket']));
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM1'] = $TICKET__DATE['num1'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM2'] = $TICKET__DATE['num2'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM3'] = $TICKET__DATE['num3'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM4'] = $TICKET__DATE['num4'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM5'] = $TICKET__DATE['num5'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM6'] = $TICKET__DATE['num6'];
					$RESULTS['TICKETS'][$PLACE][$ID_TICKET]['NUM7'] = $TICKET__DATE['num7'];
				}

				$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
				  ? json_encode($RESULTS, JSON_UNESCAPED_UNICODE)
				  : json_encode($RESULTS);

				echo $JSON__DATA;
			}
		} else echo 'error';
	} else echo 'error';
?>
