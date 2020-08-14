<?
	$PAGE_ID = 10; // ID for all ticket purchase pages

  require_once SITE__DIR.'utils/get-page-content.php';  // Get content from db for complete arrays with text data of page

  $CONTENT__DATA__ALL_PAGE = getAllPagesContent($link);
	$CONTENT__DATA = getPageContent($PAGE_ID, $link);

	// Create the variable of lottery type
	if (strpos($CLIENT__URL, '/play')) {
		if(strpos($CLIENT__URL, '/week')) $TYPE__LOTTERY='W';
		else if(strpos($CLIENT__URL, '/month')) $TYPE__LOTTERY='M';
		else if(strpos($CLIENT__URL, '/quarter')) $TYPE__LOTTERY='Q';
		else $TYPE__LOTTERY = 'index';
	} else $TYPE__LOTTERY = false;

	// Receive the unique wallet address for ticket payment
	define('CONFIRMATIONS', 3); // number of confirmations you need
	define('FEE_LEVEL', 'low'); // commission level, the higher the faster the deposit

	$payout_address = "39cjjxHTu7344mXExKb5SoDzbAoDWBpCj9"; // cold wallet for profit on a ticket after it is paid
	$callback = 'https://thelotobot.com/payment-callback.php'; // address for get bitaps.com collback
	$callback = urlencode($callback);

	// Build url address for get pay
	$requestUrl = 'https://bitaps.com/api/create/payment/';
	$requestUrl .= $payout_address . '/';
	$requestUrl .= $callback;
	$requestUrl .= '?confirmations=' . CONFIRMATIONS . '&fee_level='. FEE_LEVEL;

	// get data from bitaps.com and save it in variable $result
	$data = file_get_contents($requestUrl);
	$result = json_decode($data, true);

	// If query take back error
	if (!$result or isset($result['error_code'])) {
		$TYPE__LOTTERY=false;
	}

	// Get referrer id
	if(isset($_SESSION['REFERRER'])):
		$id_refer_result = mysqli_query($link, "
			SELECT `id_referrer`
			FROM `referrer`
			WHERE `id_referrer`='$_SESSION[REFERRER]'");
		if(!mysqli_num_rows($id_refer_result)) $_SESSION['REFERRER'] = 0;
	endif;

	// Get lottery id and a price ticket
	$DATA_LOTTERY = mysqli_fetch_assoc(mysqli_query($link, "
		SELECT `id_lottery`,
			`lottery_type`,
			`date`,
			`price`,
			`profit`
		FROM `lottery`
		WHERE `lottery_type`='$TYPE__LOTTERY'
		AND `completed`=0
		AND `date`> now()
		ORDER BY `date` DESC limit 1"));

	if($DATA_LOTTERY){
		// Get a lottery price
		$LOTTERY__PRICE = $DATA_LOTTERY['price']/100000000;

		// Add a new ticket to the db
		mysqli_query($link, "
			INSERT INTO `ticket`(
				`id_ticket`,
				`id_lottery`,
				`id_referrer`,
				`lang`,
				`address`,
				`invoice`,
				`date_create_ticket`)
			VALUES (
				null,
				'$DATA_LOTTERY[id_lottery]',
				'$_SESSION[REFERRER]',
				'$_SESSION[LANG]',
				'$result[address]',
				'$result[invoice]',
				NOW())");

		$ID__ADDED__TICKET = mysqli_insert_id($link);

		mysqli_query($link, "
			INSERT INTO `data`(
				`id_data_ticket`,
				`id_ticket`,
				`payment_code`)
			VALUES (
				null,
				'$ID__ADDED__TICKET',
				'$result[payment_code]')");

		// Make url component for get a QR image of ticket
		$URL__MESSAGE = 'bitcoin:';
		$URL__MESSAGE .= $result['address'];
		$URL__MESSAGE .= '?';
		$URL__MESSAGE .= 'amount='.$LOTTERY__PRICE;
		$URL__MESSAGE = urlencode($URL__MESSAGE);
	}

	if ($_SESSION['LANG'] == 'ja' || $_SESSION['LANG'] == 'zh-cn' || $_SESSION['LANG'] == 'zh-tw' || $_SESSION['LANG'] == 'ko' || $_SESSION['LANG'] == 'th') {
		$COLON = false;
	} else {
		$COLON = true;
	}
?>