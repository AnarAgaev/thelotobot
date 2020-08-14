</main>
<footer>
	<div class="wrap">
		<div>
			<a href="/<?= $_SESSION['LANG']; ?>/login">
				<button>
					<?= $CONTENT__DATA__ALL_PAGE['PARTNER_ENTRANCE']; ?>
				</button>
			</a>
			<a href="/<?= $_SESSION['LANG']; ?>/partner"> 
				<?= $CONTENT__DATA__ALL_PAGE['BECOME_PARTNER']; ?>
			</a>
			<a href="/<?= $_SESSION['LANG']; ?>/lottery-number">
        <?= $CONTENT__DATA__ALL_PAGE['TICKET_PLAY_NUMBER']; ?>
      </a>
			<a href="/">
				<?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LANGUAGE']; ?>
			</a>
		</div>
		<div>
			<a href="/<?= $_SESSION['LANG']; ?>/ticket">
				<button>
					<?= $CONTENT__DATA__ALL_PAGE['VIEW_TIC_DATA']; ?>
				</button>
			</a>
			<a href="/<?= $_SESSION['LANG']; ?>/results">
        <?= $CONTENT__DATA__ALL_PAGE['DRAWING_RESULTS']; ?>
      </a>
			<a href="/<?= $_SESSION['LANG']; ?>/profit">
        <?= $CONTENT__DATA__ALL_PAGE['GET_WIN']; ?>
      </a>
		</div>
		<div>
			<a class="logo" href="/<?= $_SESSION['LANG']; ?>">
				<img src="/img/logo.svg" alt="thelotobot.com">
			</a>
			<div class="logo-description">
				<?= $CONTENT__DATA__ALL_PAGE['LOTTERY_100']; ?>
			</div>
			<a class="mailto" href="mailto:hi@thelotobot.com">
				hi@thelotobot.com
			</a>
      <span class="copyright">
        thelotobot.com &copy;2019-<?= date('Y'); ?>
      </span>
		</div>
	</div>
</footer>
<script src="/js/script.min.js"></script>