<?
	/*
		* If the transition from the creation of the ticket and the numbers that the user chose to
		* add them to the array, otherwise we fill the array with the numbers 1, 2, 3, 4, 5, 6, 7
	*/
	$AMOUNT_OF_NUMBERS = 7; // number of playing figures in a separate ticket

	if (isset($_POST['selected_number_1'])){
		foreach($_POST as $value){
			$TICKET[] = htmlspecialchars(strip_tags(trim($value)));;
		}

		$TICKET['FROM_PLAY_PAGE'] = 'true'; // the user came from play page
	} else {
		for($n = $AMOUNT_OF_NUMBERS; $n > 0; $n--){
			$TICKET[] = $n;
		}

		$TICKET['FROM_PLAY_PAGE'] = 'false'; // the user came from another page
	}

	// we process numbers from an array
	$NUMBERS_AS_LINE = '';
	for($i = 0; $i < count($TICKET); $i++) {
		$NUMBERS_AS_LINE .=  $TICKET[$i];
	}
	$TICKET['NUMBERS_AS_LINE'] = $NUMBERS_AS_LINE; // add the resulting string from the ticket digits to the array
	$TICKET['HASH_OF_LINE'] = md5($NUMBERS_AS_LINE); // hash the received string from the ticket digits
	$TICKET['HASH_WITHOUT_LETTERS'] = preg_replace('~[^0-9]+~', '', $TICKET['HASH_OF_LINE']); // Cut out all but the numbers from the hash sum
	$TICKET['OPTIM_MD5_HASH_OF_AMOUNT']  = trim($TICKET['HASH_WITHOUT_LETTERS'], '0'); // Cut out zeros at the beginning and end of the line
?>