<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?></h2>
	<div class="text__content">
		<form action="" method="post" enctype="multipart/form-data" id="show__results__lottery" class="base__form">
			<input type="text" id="issue_number" placeholder="<?= $CONTENT__DATA__ALL_PAGE['EG']?> W149661">
			<input type="hidden" id="id_lang" value="<?=  $CONTENT__DATA__ALL_PAGE['ID_LANG']; ?>">
			<button><?= $CONTENT__DATA['SHOW_RESULTS']; ?></button>
		</form>

		<div class="results"
				 id="results"
				 data-num-ticket="<?= $CONTENT__DATA['NUMBER_OF_TICKET']; ?>"
				 data-numbers-ticket="<?= $CONTENT__DATA['GUESSED_NUMBERS']; ?>"
				 data-optim-ticket="<?= $CONTENT__DATA['MD5_HASH']; ?>"
				 data-delta-ticket="<?= $CONTENT__DATA['DIFFERENCE_AVERAGE']; ?>"
				 data-date-ticket="<?= $CONTENT__DATA['CREATION_DATE']; ?>">

			<h3><?= $CONTENT__DATA__ALL_PAGE['LOTTERY']; ?> <span id="num_lottary"></span></h3>
			<ul class="header-list">
				<li>
					<div class="title"><?= $CONTENT__DATA['LOTTERY_TYPE']; ?></div>
					<div id="type_lottary"></div>
				</li>
				<li>
					<div class="title"><?= $CONTENT__DATA['DRAW_DATE']; ?></div>
					<div id="date_lottary"></div>
				</li>
				<li>
					<div class="title"><?= $CONTENT__DATA['PRIZE_FUND']; ?></div>
					<div id="profit_lottary"></div>
				</li>
				<li>
					<div class="title"><?= $CONTENT__DATA['TICKETS_SOLD']; ?></div>
					<div id="tickets_lottary"></div>
				</li>
				<li>
					<div class="title"><?= $CONTENT__DATA['AMOUNT_OF_NUMBERS']; ?></div>
					<div id="sum_lottary"></div>
				</li>
				<li>
					<div class="title"><?= $CONTENT__DATA['OPTIMIZED_HASH']; ?>
					</div><div id="optim_lottary"></div>
				</li>
				<a href="/<?= $_SESSION['LANG'];?>/profit" target="_blank"><button><?= $CONTENT__DATA['GET_WIN']; ?></button></a>
			</ul>

			<h4><?= $CONTENT__DATA['PRIZE_CATEGORY_1']; ?></h4>
			<div id="place1"></div>

			<h4><?= $CONTENT__DATA['PRIZE_CATEGORY_2']; ?></h4>
			<div id="place2"></div>

			<h4><?= $CONTENT__DATA['PRIZE_CATEGORY_3']; ?></h4>
			<div id="place3"></div>
		</div>

		<button id="next__lottary"><?= $CONTENT__DATA['VIEW_ANOTHER_LOTTERY']; ?></button>
	</div>
</div>