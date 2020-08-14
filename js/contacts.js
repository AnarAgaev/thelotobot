$('body').on('submit', '#send__feedback', function(e) {
	e.preventDefault();
	let validForm = true;

	$('#name__fb, #mail__fb, #msg__fb').keyup(function() {
    cleanError($(this));
	});

	// verification of message
	if ($('#msg__fb').val() == '') {
		$('#msg__fb')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	// verification of email
	if ( $('#mail__fb').val() == '' ) {
		$('#mail__fb')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}
	else {
		if ( validMail($('#mail__fb').val()) == false ) {
			$('#mail__fb')
        .addClass('input__error-border')
        .focus();
			validForm = false;
		}
	}

	// verification of name
	if ($('#name__fb').val() == '') {
		$('#name__fb')
      .addClass('input__error-border')
      .focus();
		validForm = false;
	}

	if (validForm) {
	  showSpinner();
		$.ajax({
			type: "POST",
			cache: false ,
			url: "/utils/send-feedback.php",
			data: {
				name: $('#name__fb').val(),
				mail: $('#mail__fb').val(),
				msg: $('#msg__fb').val(),
				from_page: $('#from__fb').val()
      },
			dataType: "text",
			async: true,
			success: function(data) {
			  hideSpinner();
        switch(data) {
          case 'true':
            $('#name__fb, #mail__fb, #msg__fb')
              .val('')
              .removeClass('input__error-border');

            $('.background_popup, #send__feedback__true')
              .addClass('show');
            break;

          case 'false':
            $('.background_popup, #send__feedback__false')
              .addClass('show');
            break;
        }
			}
		});
	}
});