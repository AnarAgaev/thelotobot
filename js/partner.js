$('body').on("submit", "#define__partner", function(e){
	e.preventDefault();

	// Clean error styles when the user enters data
	$('#mail').keyup(function(){
    cleanError($(this));
	});

	// verification of email
	if ($('#mail').val() == '') {
	  $('#mail')
      .addClass('input__error-border')
      .focus();
	} else {
		if ( validMail($('#mail').val()) == false ) {
		  $('#mail')
        .addClass('input__error-border')
        .focus();
		} else {
		  showSpinner();
			$.ajax({
				type: "POST",
				cache: false ,
				url: "/utils/define-partner.php",
				data: { mail:$('#mail').val() },
				dataType: "text",
				success: function(data) {
				  hideSpinner();
          switch (data) {
            case 'false':
              $('.background_popup, #error__add__account').addClass('show');
              break;
            case 'email_busy':
              $('.background_popup, #email__busy').addClass('show');
              break;
            default:

              let obj = isJSON(data);

              if (!obj) {
                $('.background_popup, #error__add__account').addClass('show');
              } else {
                $('#btn__define__partner, #mail').css('display','none');
                $('#resault__define__partner').css('display','block');
                $('#define__partner, #mail').css('width','auto');

                $('#id__partner').html(obj.id);
                $('#pas__partner').html(obj.pas);
                $('#mail__partner').html(obj.mail);
                $('#link__partner').html(obj.link);
              }
              break;
					}
				}
			});
		}
	}
});