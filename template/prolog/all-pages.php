<?
	session_start();

	/*
		* Create a global variable containing the name of the root folder of the site
		* Change the variable $BASE__ROOT__DIR when moving a site to a new hosting on the host folder of the hosting
		* SITE__DIR - ROOT FOLDER OF THE SITE
	*/
	$BASE__ROOT__DIR = '/home/thelot';
	define ('SITE__DIR', explode($BASE__ROOT__DIR, __DIR__)[0].$BASE__ROOT__DIR.'/public_html/');

	require_once SITE__DIR.'config/connect.php'; // connecting to db

	require_once SITE__DIR.'utils/get-url.php';

	require_once SITE__DIR.'utils/set-lang.php'; // set language in Session

	// Save referrer utm marker
	if(isset($_GET['ref'])):
		$_SESSION['REFERRER'] = $_GET['ref'];
	endif;

	// Get data of open lotteries
	$DATA__WEEK__LOTTERY = 	mysqli_fetch_assoc(
		mysqli_query($link, "SELECT
			`id_lottery`,
			`lottery_type`,
			`date`,
			`profit`
			FROM `lottery`
			WHERE `lottery_type`='W'
			AND `completed`=0
			AND `date`> now()
			ORDER BY `date`
			DESC LIMIT 1"));
	
	$DATA__MONTH__LOTTERY = mysqli_fetch_assoc(
		mysqli_query($link, "SELECT
			`id_lottery`,
			`lottery_type`,
			`date`,
			`profit`
			FROM `lottery`
			WHERE `lottery_type`='M'
			AND `completed`=0
			AND `date`> now()
			ORDER BY `date`
			DESC LIMIT 1"));
	
	$DATA__QUARTER__LOTTERY = mysqli_fetch_assoc(
		mysqli_query($link, "SELECT
			`id_lottery`,
			`lottery_type`,
			`date`,
			`profit`
			FROM `lottery`
			WHERE `lottery_type`='Q'
			AND `completed`=0
			AND `date`> now()
			ORDER BY `date`
			DESC LIMIT 1"));

	// Count the remaining time
  function dataToString($DATE, $CONTENT, $LANG) {
    $CHECK_TIME = strtotime($DATE) - time();
    if($CHECK_TIME <= 0) return false;

    $DAYS = floor($CHECK_TIME/86400);
    $HOURS = floor(($CHECK_TIME%86400)/3600);
    $MINUTES = floor(($CHECK_TIME%3600)/60);
    // $SECONDS = $CHECK_TIME%60;

    $RESULT__STR = '';
    if($DAYS > 0) {
      $RESULT__STR .= $DAYS.$CONTENT['DAY_SHORT'];
      if ($LANG != 'ja' && $LANG != 'ko' && $LANG != 'zh-cn' && $LANG != 'zh-tw') $RESULT__STR .= '.';
      $RESULT__STR .= ' ';
    }
    if($HOURS > 0) {
      $RESULT__STR .= $HOURS.$CONTENT['HOUR_SHORT'];
      if ($LANG != 'ja' && $LANG != 'ko' && $LANG != 'zh-cn' && $LANG != 'zh-tw') $RESULT__STR .= '.';
      $RESULT__STR .= ' ';
    }
    if($MINUTES > 0) {
      $RESULT__STR .= $MINUTES.$CONTENT['MINUTE_SHORT'];
      if ($LANG != 'ja' && $LANG != 'ko' && $LANG != 'zh-cn' && $LANG != 'zh-tw') $RESULT__STR .= '.';
      $RESULT__STR .= ' ';
    }

    return $RESULT__STR;
  }

	function getHtmlLang($LANG) {
		if ($LANG =='zh-cn' || $LANG == 'zh-tw') {
			return 'zh';
		} else return $LANG;
  }

  function printColon($LANG) {
		if ($LANG != 'ja' &&
			$LANG != 'ko' &&
			$LANG != 'zh-cn' &&
			$LANG != 'zh-tw' &&
			$LANG != 'th') {
			return ':';
		} else return;
  }