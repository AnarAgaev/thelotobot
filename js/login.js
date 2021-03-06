// Check user data
$('body').on("submit", "#show__ref__date", function(e){
	e.preventDefault();

	let form = this; // submit form
	let validForm = true;

	const number = $('#num').val();
	const mail = $('#mail').val();
	const password = $('#pas').val();

	// Clean error styles when the user enters data
	$('#num, #pas, #mail').keyup(function(){
    cleanError($(this));
	});

	if (password === '') { // verification of password
		$('#pas')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	const activeError = () => {
    $('#mail')
      .addClass('input__error-border')
      .focus();
    validForm = false;
  };

	if (mail === '') {
	  activeError();
	} else if (!validMail(mail)) {
	  activeError();
	}

	if (number === '') { // verification of partner's number
		$('#num')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	if (validForm) {
	  showSpinner();
		$.ajax({
			type: "POST",
			url: "/utils/get-referral-data.php",
			data: {
				num:  number,
				mail: mail,
				pas:  password
      },
			dataType: "text",
			success: function(data) {
			  hideSpinner();
        switch (data) {
          case 'false':
            $('.background_popup, #query__false')
              .addClass('show');
            break;
          case 'error':
            $('.background_popup, #data__error')
              .addClass('show');
            break;
          case 'true':
            form.submit();
            break;
        }
			}
		});
	}
});

// Send query for get profit
$('body').on("submit", ".get-profit", function(e) {
	e.preventDefault();

	let wallet = $(this).children('.wallet');
  let id_lottery = $(this).children('.id_lottery').val();
  let id_refferrer = $(this).children('.id_refferrer').val();

  if (wallet.val() == '') {
		wallet.addClass('input__error-border').focus();
		wallet.keyup(function() {
      cleanError($(this));
		});
	} else {
    showSpinner();
		$.ajax({
			type: "POST",
			url: "/utils/pay-referral-profit.php",
			data: {
				wallet: wallet.val(),
				id_lottery: id_lottery,
				id_refferrer: id_refferrer
      },
			dataType: "text",
			success: function(data) {
			  hideSpinner();
				if ( data == 'error' ) {
				  $('.background_popup,#pay__error').addClass('show');
				} else {
					$('.background_popup,#pay__ok').addClass('show');
					let query_resault = $('#' + data).attr('data-query-result');
					$('#' + data).html('<font>' + query_resault + '</font>');
				}
			}
		});
	}
});