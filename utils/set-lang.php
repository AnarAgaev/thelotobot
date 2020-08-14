<?
	/*
   * Set the language used in the session
   *
   * If the URL does not contain any language,
   * set English (en) as the base language for
   * the entire site.
  */

  function getLangFromUrl($url) {
    $url .= '/';

    if (strpos($url, '/uk/')) return 'uk';
    if (strpos($url, '/en/')) return 'en';
    if (strpos($url, '/fr/')) return 'fr';
    if (strpos($url, '/de/')) return 'de';
    if (strpos($url, '/it/')) return 'it';
    if (strpos($url, '/es/')) return 'es';
    if (strpos($url, '/da/')) return 'da';
    if (strpos($url, '/pt/')) return 'pt';
    if (strpos($url, '/ru/')) return 'ru';
    if (strpos($url, '/pl/')) return 'pl';
    if (strpos($url, '/no/')) return 'no';
    if (strpos($url, '/sv/')) return 'sv';
    if (strpos($url, '/fi/')) return 'fi';
    if (strpos($url, '/id/')) return 'id';
    if (strpos($url, '/ms/')) return 'ms';
    if (strpos($url, '/hu/')) return 'hu';
    if (strpos($url, '/nl/')) return 'nl';
    if (strpos($url, '/ro/')) return 'ro';
    if (strpos($url, '/cs/')) return 'cs';
    if (strpos($url, '/grk/')) return 'grk';
    if (strpos($url, '/ja/')) return 'ja';
    if (strpos($url, '/ko/')) return 'ko';
    if (strpos($url, '/sk/')) return 'sk';
    if (strpos($url, '/tr/')) return 'tr';
    if (strpos($url, '/vi/')) return 'vi';
    if (strpos($url, '/th/')) return 'th';
    if (strpos($url, '/zh-cn/')) return 'zh-cn';
    if (strpos($url, '/zh-tw/')) return 'zh-tw';
    if (strpos($url, '/lv/')) return 'lv';
    if (strpos($url, '/et/')) return 'et';
  }

  function setLangInSession($url) {
    switch (getLangFromUrl($url)) {
      case 'uk':
        $_SESSION['LANG'] = 'uk';
        break;
      case 'fr':
        $_SESSION['LANG'] = 'fr';
        break;
      case 'de':
        $_SESSION['LANG'] = 'de';
        break;
      case 'it':
        $_SESSION['LANG'] = 'it';
        break;
      case 'es':
        $_SESSION['LANG'] = 'es';
        break;
      case 'da':
        $_SESSION['LANG'] = 'da';
        break;
      case 'pl':
        $_SESSION['LANG'] = 'pl';
        break;
      case 'pt':
        $_SESSION['LANG'] = 'pt';
        break;
      case 'no':
        $_SESSION['LANG'] = 'no';
        break;
      case 'sv':
        $_SESSION['LANG'] = 'sv';
        break;
      case 'fi':
        $_SESSION['LANG'] = 'fi';
        break;
      case 'id':
        $_SESSION['LANG'] = 'id';
        break;
      case 'ms':
        $_SESSION['LANG'] = 'ms';
        break;
      case 'hu':
        $_SESSION['LANG'] = 'hu';
        break;
      case 'nl':
        $_SESSION['LANG'] = 'nl';
        break;
      case 'ro':
        $_SESSION['LANG'] = 'ro';
        break;
      case 'cs':
        $_SESSION['LANG'] = 'cs';
        break;
      case 'grk':
        $_SESSION['LANG'] = 'grk';
        break;
      case 'ja':
        $_SESSION['LANG'] = 'ja';
        break;
      case 'ko':
        $_SESSION['LANG'] = 'ko';
        break;
      case 'sk':
        $_SESSION['LANG'] = 'sk';
        break;
      case 'tr':
        $_SESSION['LANG'] = 'tr';
        break;
      case 'ru':
        $_SESSION['LANG'] = 'ru';
        break;
      case 'vi':
        $_SESSION['LANG'] = 'vi';
        break;
      case 'th':
        $_SESSION['LANG'] = 'th';
        break;
      case 'zh-cn':
        $_SESSION['LANG'] = 'zh-cn';
        break;
      case 'zh-tw':
        $_SESSION['LANG'] = 'zh-tw';
        break;
      case 'lv':
        $_SESSION['LANG'] = 'lv';
        break;
      case 'et':
        $_SESSION['LANG'] = 'et';
        break;
      default:
        $_SESSION['LANG'] = 'en';
        break;
    }
  }

  if ( $_SESSION['LANG'] != getLangFromUrl($CLIENT__URL) ) {
    setLangInSession($CLIENT__URL);
  }
?>