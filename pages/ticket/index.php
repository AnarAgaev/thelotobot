<?
	require_once'../../template/prolog/all-pages.php';

  $PAGE_ID = 8; // Identifier of this page
  require_once SITE__DIR.'utils/get-page-content.php'; // Get content from db for complete arrays with text data of page

  $CONTENT__DATA__ALL_PAGE = getAllPagesContent($link);
  $CONTENT__DATA = getPageContent($PAGE_ID, $link);
?>
<!DOCTYPE HTML>
<html lang="<?= getHtmlLang($_SESSION['LANG']); ?>">
<head>
	<? require_once SITE__DIR.'google-analytics.php'; ?>
	<? require_once SITE__DIR.'template/head.php'; ?>
	<meta name="description" content="<?= $CONTENT__DATA['PAGE_DESCRIPTION']; ?>">
  <meta name="keywords" content="<?= $CONTENT__DATA['PAGE_KEYWORDS']; ?>">
  <title>
    <?= $CONTENT__DATA['TITLE_HEADER'].' | '.$CONTENT__DATA__ALL_PAGE['PAGE_TITLE']; ?>
  </title>
</head>
<body data-lang-code="<?= $_SESSION['LANG'];?>">
	<div class="popup__message" id="false__get__data">
  	<p><?= $CONTENT__DATA['REQUEST_ERROR'] ;?></p>
  	<button><?= $CONTENT__DATA__ALL_PAGE['CLOSE'] ;?></button>
  </div>

  <div class="popup__message" id="error__data">
  	<p><?= $CONTENT__DATA['DATA_ERROR'] ;?></p>
  	<button><?= $CONTENT__DATA__ALL_PAGE['CLOSE'] ;?></button>
  </div>
	<?
		require_once SITE__DIR.'template/header.php';
		require_once SITE__DIR.'template/ticket.php';
		require_once SITE__DIR.'template/footer.php';
	?>
	<script async src="/js/ticket.min.js"></script>
</body>
</html>
<? require_once SITE__DIR.'template/epilogue/all-pages.php'; ?>