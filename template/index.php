<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?><br><br></h2>
	<div class="advantage">
		<div>
			<span>1</span>
			<p><?= $CONTENT__DATA['SQUARE1']; ?></p>
		</div>
		<div>
			<span>2</span>
			<p><?= $CONTENT__DATA['SQUARE2']; ?></p>
		</div>
		<div>
			<span>3</span>
			<p><?= $CONTENT__DATA['SQUARE3']; ?></p>
		</div>
		<div>
			<span>4</span>
			<p><?= $CONTENT__DATA['SQUARE4']; ?></p>
		</div>
		<div>
			<span>5</span>
			<p><?= $CONTENT__DATA['SQUARE5']; ?></p>
		</div>
		<div>
			<span>6</span>
			<p><?= $CONTENT__DATA['SQUARE6']; ?></p>
		</div>
	</div>
	<h2><?= $CONTENT__DATA['HOW_IT_WORKS']; ?></h2>
	<p class="p__rules">
		<span class="num__line">1</span>
		<?= $CONTENT__DATA['RULE1']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">2</span>
		<?= $CONTENT__DATA['RULE2']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">3</span>
		<?= $CONTENT__DATA['RULE3']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">4</span>
		<?= $CONTENT__DATA['RULE4']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">5</span>
		<?= $CONTENT__DATA['RULE5']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">6</span>
		<?= $CONTENT__DATA['RULE6_1']; ?>
		<a href="/<? echo $_SESSION['LANG']; ?>/lottery-number" target="_blank"><?= $CONTENT__DATA['RULE6_2']; ?></a>.
	</p>
	<p class="p__rules">
		<span class="num__line">7</span>
		<?= $CONTENT__DATA['RULE7']; ?>
	</p>
	<p class="p__rules">
		<span class="num__line">8</span>
		<?= $CONTENT__DATA['RULE8']; ?>
	</p>
	<div class="ancor_in_rules">
		<a href="/<? echo $_SESSION['LANG']; ?>/rules/">
			<button><?= $CONTENT__DATA['DETAIL_RULES']; ?></button>
		</a>
	</div>

	<h2><?= $CONTENT__DATA['OPPORTUNITY']; ?></h2>
	<?
		// Import cards for select type of the lotteries
		include SITE__DIR.'template/lottery-cards.php';
	?>
</div>
