<?
	require_once dirname(dirname(__DIR__)).'/config/connect.php'; // Connection to db

	// Функция создаёт слуячайные массив с случайными числами
	function generate_nums($number){
		$stack = array();
		for($i = 0; $i < $number; $i++) { array_push($stack, mt_rand(0,99)); }
		return $stack;
	}

	/*-----------
		ФУНКЦИЯ, КОТОРАЯ ДОБАВЛЯЕТ БИЛЕТЫ В ЛОТЕРЕЮ

		Данные с BITAPS (такие как счёт оплаты и адрес оплаты)
		запрашивать не будем что бы не загружать сторонний
		сервис ненужными запросами
	 -----------*/

	function create_ticket($LOTTERY_TYPE, $link) {
		if (mt_rand()%2 == 0) {
			$DATA_LOTTERY = mysqli_fetch_assoc(mysqli_query($link,
				"SELECT
					`id_lottery`,
					`lottery_type`,
					`price`
				FROM `lottery`
				WHERE `lottery_type`='$LOTTERY_TYPE'
				AND `completed`='0'
				AND `date`> now()
				ORDER BY `date`
				DESC limit 1")); // получаем данные лотереи

			if($DATA_LOTTERY){
				$NUMS = generate_nums(7); // генерируем семь чисел билета
				$NUMBERS_AS_LINE = ''; // обнуляем строку содержащую цифры билета

				// конкатируем сгенерированный числа в строку
				for($z = 0; $z < 7; $z++) {
					$NUMBERS_AS_LINE .=  $NUMS[$z];
				}

				$HASH_OF_LINE = md5($NUMBERS_AS_LINE); // хэшируем полученную строку из цифр билета
				$HASH_WITHOUT_LETTERS = preg_replace('~[^0-9]+~', '', $HASH_OF_LINE); // вырезаем всё кроме цифр из хэш суммы
				$OPTIM_MD5_HASH_OF_AMOUNT  = trim($HASH_WITHOUT_LETTERS, '0'); // вырезаем нули в начале и конце строки

				mysqli_query($link, "
					INSERT INTO `ticket`(
						`id_ticket`,
						`id_lottery`,
						`lang`,
						`amount`,
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
						`error`)
					VALUES (
						null,
						'$DATA_LOTTERY[id_lottery]',
						'en',
						'$DATA_LOTTERY[price]',
						'$NUMS[0]',
						'$NUMS[1]',
						'$NUMS[2]',
						'$NUMS[3]',
						'$NUMS[4]',
						'$NUMS[5]',
						'$NUMS[6]',
						'$OPTIM_MD5_HASH_OF_AMOUNT',
						NOW(),
						NOW(),
						'NOT_ERROR')"); // Добавляем билет в БД
				$PROFIT = mysqli_fetch_assoc(mysqli_query($link, "
					SELECT `profit`
					FROM `lottery`
					WHERE `id_lottery` = '$DATA_LOTTERY[id_lottery]'")); // получаем призовой фонд лотереи
				$PROFIT = $PROFIT['profit'] + $DATA_LOTTERY['price'];
				mysqli_query($link, "
					UPDATE `lottery`
					SET `profit`='$PROFIT'
					WHERE `id_lottery`='$DATA_LOTTERY[id_lottery]'");
			}
		}
		unset($NUMS); // уничтожаем цифры/освобождаем переменную под новый массив с цифрами
	}

	if (!$link) { // если соединение завершено неудачно посылаем себе письмо, что нет соединения с БД
		$message ="Error in the CRON script adding a ticket to the lottery.\r\n\n";
		$message .="Script name: create-ticket.php\r\n";
		$message .="Script Folder: ../utils/temp/";
		$subject = "Error in the CRON script";
		$subject = "=?utf-8?b?". base64_encode($subject) ."?=";
		$from = "Lotobot - bitcoin lottery";
		$from = "=?utf-8?b?". base64_encode($from) ."?=";
		$header = "Content-type: text/plain; charset=utf-8\r\n";
		$header .= "From: ".$from."<hi@thelotobot.com>\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Date: ".date('D, d M Y h:i:s O');

		mail('support@thelotobot.com', $subject, $message, $header);
	} else {
		// запускаем функцию генерации билетя для каждого типа лотереи
		create_ticket('W', $link);
		create_ticket('M', $link);
		create_ticket('Q', $link);
	}
?>