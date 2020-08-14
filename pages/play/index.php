<?
	require_once'../../template/prolog/all-pages.php';
	require_once SITE__DIR.'template/prolog/play.php';

  /*
   * The ID for all ticket purchase pages
   * is in the template/prolog/play.php file
  */
?>
<!DOCTYPE HTML>
<html lang="<?= getHtmlLang($_SESSION['LANG']); ?>">
<head>
	<? require_once SITE__DIR.'google-analytics.php'; ?>
	<? require_once SITE__DIR.'template/head.php'; ?>
	<meta name="description" content="<?= $CONTENT__DATA['PAGE_DESCRIPTION']; ?>">
  <meta name="keywords" content="<?= $CONTENT__DATA['PAGE_KEYWORDS']; ?>">
  <title>
    <?= $CONTENT__DATA['TITLE_HEADER_PLAY'].' | '.$CONTENT__DATA__ALL_PAGE['PAGE_TITLE']; ?>
  </title>
</head>
<body data-lang-code="<?= $_SESSION['LANG'];?>">
	<?
		require_once SITE__DIR.'template/header.php';
		require_once SITE__DIR.'template/play.php';
		require_once SITE__DIR.'template/footer.php';
	?>
	<script async src="/js/play.min.js"></script>
</body>
</html>
<? require_once SITE__DIR.'template/epilogue/all-pages.php'; ?>