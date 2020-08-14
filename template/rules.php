<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE'];?></h1>
	<div class="text__content">
		<h2><?= $CONTENT__DATA['TERMS_TITLE'];?></h2>
		<ul>
			<li><?= $CONTENT__DATA['TERMS_1'];?></li>
			<li><?= $CONTENT__DATA['TERMS_2'];?></li>
			<li><?= $CONTENT__DATA['TERMS_3'];?></li>
			<li>
				<?= $CONTENT__DATA['TERMS_4'];?>
				<a href="/<?echo $_SESSION['LANG'];?>/lottery-number" target="_blank">
					<?= $CONTENT__DATA__ALL_PAGE['ON_THIS_PAGE']; ?></a><?
						if ($_SESSION['LANG'] == 'ja' || $_SESSION['LANG'] == 'zh-cn' || $_SESSION['LANG'] == 'zh-tw') echo '。';
						else echo '.';
					?>
			</li>
			<li><?= $CONTENT__DATA['TERMS_5'];?></li>
			<li><?= $CONTENT__DATA['TERMS_6'];?></li>
			<li>
				<?= $CONTENT__DATA['TERMS_7'];?>
				<a href="/<?echo $_SESSION['LANG'];?>/lottery-number" target="_blank">
					<?= $CONTENT__DATA__ALL_PAGE['ON_THIS_PAGE']; ?></a><?
            if ($_SESSION['LANG'] == 'ja' || $_SESSION['LANG'] == 'zh-cn' || $_SESSION['LANG'] == 'zh-tw') echo '。';
            else echo '.';
          ?>
			</li>
			<li><?= $CONTENT__DATA['TERMS_8'];?></li>
		</ul>
		<h2><?= $CONTENT__DATA['RULES_TITLE'];?></h2>
			<br><br>
			<p class="p__rules long__point"><span class="num__line">1</span><?= $CONTENT__DATA['RULES_1'];?></p>
			<p class="p__rules long__point"><span class="num__line">2</span><?= $CONTENT__DATA['RULES_2'];?></p>
			<p class="p__rules long__point"><span class="num__line">3</span><?= $CONTENT__DATA['RULES_3'];?></p>
			<p class="p__rules long__point"><span class="num__line">4</span><?= $CONTENT__DATA['RULES_4'];?></p>
			<p class="p__rules long__point"><span class="num__line">5</span><?= $CONTENT__DATA['RULES_5'];?></p>
			<p class="p__rules long__point"><span class="num__line">6</span><?= $CONTENT__DATA['RULES_6'];?></p>
			<p class="p__rules long__point"><span class="num__line">7</span><?= $CONTENT__DATA['RULES_7'];?></p>
			<p class="p__rules long__point"><span class="num__line">8</span><?= $CONTENT__DATA['RULES_8'];?></p>
			<p class="p__rules long__point"><span class="num__line">9</span><?= $CONTENT__DATA['RULES_9'];?></p>
			<p class="p__rules long__point"><span class="num__line">10</span><?= $CONTENT__DATA['RULES_10'];?></p>
			<p class="p__rules long__point"><span class="num__line">11</span><?= $CONTENT__DATA['RULES_11'];?></p>
			<p class="p__rules long__point"><span class="num__line">12</span><?= $CONTENT__DATA['RULES_12'];?></p>
			<p class="p__rules long__point"><span class="num__line">13</span><?= $CONTENT__DATA['RULES_13'];?></p>
			<p class="p__rules long__point"><span class="num__line">14</span><?= $CONTENT__DATA['RULES_14'];?></p>
			<p class="p__rules long__point">
				<span class="num__line">15</span>
				<?= $CONTENT__DATA['RULES_15_1'];?>
				<a href="/<?echo $_SESSION['LANG'];?>/results/" target="_blank">
					<?= $CONTENT__DATA__ALL_PAGE['RESULTS_LINK'];?></a>
				<?= $CONTENT__DATA['RULES_15_2'];?>
			</p>
			<p class="p__rules long__point">
				<span class="num__line">16</span>
				<?= $CONTENT__DATA['RULES_16_1'];?>
				<a href="/<?echo $_SESSION['LANG'];?>/profit/" target="_blank">
					<?= $CONTENT__DATA__ALL_PAGE['REQUEST_PROFIT_LINK'];?></a>
				<?= $CONTENT__DATA['RULES_16_2'];?>
			</p>
			<p class="p__rules long__point"><span class="num__line">17</span><?= $CONTENT__DATA['RULES_17'];?></p>
			<h2><?= $CONTENT__DATA__ALL_PAGE['HAVE_QUESTS'];?></h2>
			<br><br>
			<form action="" method="post" enctype="multipart/form-data" id="send__feedback">
				<input type="hidden" id="from__fb" value="Rules">
				<input type="text" id="name__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['NAME'];?>">
				<input type="text" id="mail__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['MAIL'];?>">
				<textarea id="msg__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['QUESTION'];?>"></textarea>
				<button id="submit__fb"><?= $CONTENT__DATA__ALL_PAGE['SEND__MSG'];?></button>
				<span><?= $CONTENT__DATA__ALL_PAGE['PRIVACY_POLICY'];?></span>
			</form>
	</div>
</div>