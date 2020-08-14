$('body').on("submit", "#get-profit", function(e){

	e.preventDefault();
	let validForm = true;

	// Clean error styles before running the script
	$('#num,#inv,#pas,#wallet,#mail').removeClass('input__error-border');

	// Clean error styles when the user enters data
	$('#mail, #wallet, #pas, #inv, #num').keyup(function(){
    cleanError($(this));
	});

	// verification of email
	if ($('#mail').val() == '') {
		$('#mail')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}
	else {
		if (validMail($('#mail').val()) == false) {
			$('#mail')
        .addClass('input__error-border')
        .focus();
			validForm = false;
		}
	}

	// verification of wallet
	if ($('#wallet').val() == '') {
		$('#wallet')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	// verification of password
	if ($('#pas').val() == '') {
		$('#pas')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	// verification of invoice
	if ($('#inv').val() == '') {
		$('#inv')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	// verification of ticket's number
	if($('#num').val() == ''){
		$('#num').addClass('input__error-border').focus();
		validForm = false;
	}

	if (validForm) {
	  showSpinner();
		$.ajax({
			type: "POST",
			url: "/utils/pay-user-profit.php",
			data: {
				num:$('#num').val(),
				inv:$('#inv').val(),
				pas:$('#pas').val(),
				wallet:$('#wallet').val(),
				mail:$('#mail').val() },
			dataType: "text",
			async: true,
			success: function(data) {
			  hideSpinner();
				switch (data) {
					case 'error__send__mail':
						$('.background_popup, #error__send__mail').addClass('show');
				    break;
				  case 'error__date':
				    $('.background_popup, #error__input__data').addClass('show');
				    break;
				  case 'pay_in_progress':
				    $('.background_popup, #pay__progress').addClass('show');
				    break;
					case 'pay__completed':
				    $('.background_popup, #pay__completed').addClass('show');
				    break;
					case 'not__winner':
				    $('.background_popup, #not__winner').addClass('show');
				    break;
					case 'true':
				    $('.background_popup, #pay__ok').addClass('show');
				    break;
          default:
            $('.background_popup, #error__send__mail').addClass('show');
            break;
				}
			}
		});
	}
});