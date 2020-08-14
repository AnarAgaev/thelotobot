<div class="background_popup"></div>

<div class="loadingio-spinner-dual-ball" id="spinner">
  <div class="ldio">
    <div></div><div></div><div></div>
  </div>
</div>

<div class="overlay">
	<span class="close__select__lottery"><?= $CONTENT__DATA__ALL_PAGE['CLOSE']; ?></span>
	<img src="/img/map.svg" class="overlay-back" alt="<?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LOTTERY']; ?>" title="<?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LOTTERY']; ?>">
	<div class="wrap">
		<h1 style="margin-bottom:1em;"><?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LOTTERY']; ?></h1>
		<?
			// Import cards for select type of the lotteries
			include SITE__DIR.'template/lottery-cards.php';
		?>
	</div>
</div>

<header>
	<span id="backHead"></span>
	<div class="wrap">
		<nav>
			<div class="logo-wrap">
				<div id="menu-switch" class="mobile-show"></div>
				<a class="logo" href="/<?= $_SESSION['LANG']; ?>">
					<img src="/img/logo.svg" alt="thelotobot.com">
				</a>
			</div>
			<div class="nav-list" id="nav-list">
        <button class="btn-close mobile-show" id="nav-invisible"></button>
				<ul>
					<li>
						<a href="/<?= $_SESSION['LANG']; ?>/rules"<? if (substr_count($CLIENT__URL, '/rules') > 0) echo ' class="active"'; ?>>
							<?= $CONTENT__DATA__ALL_PAGE['RULES']; ?><span></span>
						</a>
					<li>
						<a href="/<?echo $_SESSION['LANG'];?>/results"<?if (substr_count($CLIENT__URL, '/results') > 0) echo ' class="active"';?>>
							<?= $CONTENT__DATA__ALL_PAGE['RESULTS']; ?><span></span>
						</a>
					<li>
						<a href="/<?echo $_SESSION['LANG'];?>/ticket"<?if (substr_count($CLIENT__URL, '/ticket') > 0) echo ' class="active"';?>>
							<?= $CONTENT__DATA__ALL_PAGE['TICKET']; ?><span></span>
						</a>
					<li>
						<a href="/<?echo $_SESSION['LANG'];?>/contacts"<?if (substr_count($CLIENT__URL, '/contacts') > 0) echo ' class="active"';?>>
							<?= $CONTENT__DATA__ALL_PAGE['CONTACTS']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/<?= $_SESSION['LANG']; ?>/profit"<?if (substr_count($CLIENT__URL, '/profit') > 0) echo ' class="active"';?>>
						  <?= $CONTENT__DATA__ALL_PAGE['GET_WIN']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/<?= $_SESSION['LANG']; ?>/login"<?if (substr_count($CLIENT__URL, '/login') > 0) echo ' class="active"';?>>
						  <?= $CONTENT__DATA__ALL_PAGE['PARTNER_ENTRANCE']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/<?= $_SESSION['LANG']; ?>/partner"<?if (substr_count($CLIENT__URL, '/partner') > 0) echo ' class="active"';?>>
						  <?= $CONTENT__DATA__ALL_PAGE['BECOME_PARTNER']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/<?= $_SESSION['LANG']; ?>/lottery-number"<?if (substr_count($CLIENT__URL, '/lottery-number') > 0) echo ' class="active"';?>>
						  <?= $CONTENT__DATA__ALL_PAGE['TICKET_PLAY_NUMBER']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/<?= $_SESSION['LANG']; ?>/play"<?if (substr_count($CLIENT__URL, '/play') > 0) echo ' class="active"';?>>
						  <?= $CONTENT__DATA__ALL_PAGE['BUY_LOTTERY_TICKET']; ?><span></span>
						</a>
					<li class="mobile-show">
						<a href="/">
						  <?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LANGUAGE']; ?><span></span>
						</a>
				</ul>
			</div>
		</nav>
		<button id="select__lottery">
			<?= $CONTENT__DATA__ALL_PAGE['BUY_LOTTERY_TICKET']; ?>
		</button>
	</div>
</header>
<main>