<?
	/*
    * The function to get the content that is used on all pages.
    * After receiving the data from the database, we will make array
    * with variables that we will use on the all pages
  */
	function getAllPagesContent($db_link) {

		// Get content from db
		$RES__CONTENT__DATA__ALL__PAGE = mysqli_query($db_link, "SELECT
  		`name_content_block`,
  		`value_content_block`
  		FROM  `content`
  		WHERE  `id_lang` = (SELECT `id_lang` FROM `languages` WHERE `name_lang` = '$_SESSION[LANG]')
  		AND `id_page` = '0'");

  	// Complete the resulting array with the content which we use on each page
  	for ($i = 0; $i < mysqli_num_rows($RES__CONTENT__DATA__ALL__PAGE); $i++) {
  		$row = mysqli_fetch_row($RES__CONTENT__DATA__ALL__PAGE);
      $ARR[$row[0]] = $row[1]; // Push data in array
  	}

  	// Add language id to the array used on all page
  	$RES_ID_LANG = mysqli_fetch_assoc(mysqli_query($db_link, "
  		SELECT `id_lang`
  		FROM `languages`
  		WHERE `name_lang`='$_SESSION[LANG]'"));
    $ARR['ID_LANG'] = $RES_ID_LANG['id_lang'];

    return $ARR;
	}

	/*
		* The function to get the content that is used on a single page.
		* after receiving the data from the database,
		* we will make array with variables that we will use on the page
	*/
	function getPageContent($PAGE_ID, $db_link) {

		// Get content from db
		$RES__CONTENT__DATA = mysqli_query($db_link, "
			SELECT `name_content_block`,
			`value_content_block`
			FROM `content`
			WHERE `id_lang` = (SELECT `id_lang` FROM `languages` WHERE `name_lang` = '$_SESSION[LANG]')
			AND `id_page` = '$PAGE_ID'");

		// Complete the resulting array with the text content of the page
		for ($i = 0; $i < mysqli_num_rows($RES__CONTENT__DATA); $i++) {
			$row = mysqli_fetch_row($RES__CONTENT__DATA);
			$ARR[$row[0]] = $row[1]; // Push data in array
		}

		return $ARR;
	}
?>