$(document).ready(function() {
  // Window width for get scroll step
  let windowWidth = document.documentElement.clientWidth;

  // Add the ticket at the selected lottery
	$('#add_ticket').on('click', function() {
    if ($(this).attr('class') === 'play__true') {

      $('#num0, #num1, #num2, #num3, #num4, #num5, #num6').css('borderColor', '#111'); // reset errors

			let errors = []; // an array for incorrect input errors; it's the resulting array
			let error__mark = true; // marker to track that all fields are entered correctly

      for (let i = 0; i < 7; i++) {
				errors[i] = /^[0-9]+$/.test($('#num'+i).val());

				if (errors[i] === false) {
          $('#num'+i).css('borderColor', '#df2831');
          error__mark = false;
        }
			}

			if (error__mark) {
			  showSpinner();
				$.post(
					"/utils/define-ticket.php",
					{
						id__added__ticket: $('#id__added__ticket').val(),
            pay__status__paid: $('#pay__status__paid').val(),
            pay__status__not__paid: $('#pay__status__not__paid').val(),
            num0: $('#num0').val(),
            num1: $('#num1').val(),
            num2: $('#num2').val(),
            num3: $('#num3').val(),
            num4: $('#num4').val(),
            num5: $('#num5').val(),
            num6: $('#num6').val(),
					},
					function (data) {
						let obj = $.parseJSON(data);
						if (obj === '') {
						  hideSpinner();
              $('.background_popup, #error__add__ticket').addClass('show');
						} else {

						  // Add data to the block with ticket on the page
							$('#num__ticket').html(obj.id_lottery + '/' + obj.id_ticket);
							$('#num__wallet').html(obj.address);
							$('#num__invoice').html(obj.invoice);
							$('#num__selected').html(
							  obj.num1 + ' - ' +
                obj.num2 + ' - ' +
                obj.num3 + ' - ' +
                obj.num4 + ' - ' +
                obj.num5 + ' - ' +
                obj.num6 + ' - ' +
                obj.num7 );
							$('#num__date').html(
							  obj.date_create_ticket +
                '<a class="anchor" target="_black" href="https://en.wikipedia.org/wiki/Greenwich_Mean_Time">Greenwich Mean Time (GMT)</a>');
							$('#num__error').html(obj.error);
							$('#num__password').html(obj.passw);

							// Show result container and block action buttons
              $('.define-ticket_title').show();
							$('.result__define__ticket').css({'height':'auto'});
							$('#add_ticket').removeClass('play__true').addClass('play__false');
							$('#ticket__define__true').css({'display':'flex', 'cursor':'not-allowed'});
              $('#generate_random_numbers').addClass('no_reaction');

              hideSpinner();

							// Scroll to the result container
							let scrollTo = $('#define-ticket_title').offset().top - 100;
							$('html,body').animate({scrollTop: scrollTo});

							// Show swipes
              let swipes = document.querySelector('.horizontal-swipe');
              [].forEach.call(swipes, function(elem) {
                elem.style.display = 'block';
              });
              addSwipe();

              // Create form and link How we get a number for play lottery
							let description = $('#optim_md5hash').attr('data-description');
							$('#optim_md5hash').prepend(obj.optim_md5hash);
							$('#optim_md5hash span').html(description);
							$('#selected_number_1').val(obj.num1);
							$('#selected_number_2').val(obj.num2);
							$('#selected_number_3').val(obj.num3);
							$('#selected_number_4').val(obj.num4);
							$('#selected_number_5').val(obj.num5);
							$('#selected_number_6').val(obj.num6);
							$('#selected_number_7').val(obj.num7);
						}
					},
					'text'
				);
			} else $('.background_popup, #error__nums').addClass('show');
		 }
	});

	// Scroll after click on Error selected nums
	$("#err__nums").on('click', function() {
		$('.background_popup, #error__nums').removeClass('show');

		let minusScroll;
		if (windowWidth < 797) minusScroll = 70;
    else if (windowWidth < 1020) minusScroll = 80;
    else if (windowWidth < 1220) minusScroll = 100;
    else minusScroll = 200;

		let play__content__top = $('.play__content').offset().top - minusScroll;
		$('html, body').animate({scrollTop: play__content__top});
	});

	// Send a ticket to the mail
	$('#send__ticket').on('click', function() {
	  let mail = $('#mail').val();

		if (mail !== '' && /.+@.+\..+/i.test(mail)) {
		  showSpinner();
      $.post(
        "/utils/send-ticket-to-mail.php",
        {
          id__added__ticket: $('#id__added__ticket').val(),
          mail: mail,
        },
        function (data) {
          hideSpinner();
          if (data === 'true') {
            $('.background_popup, #send__mail__true')
              .addClass('show');
          } else {
            $('.background_popup, #send__mail__error')
              .addClass('show');
          }
        },
        'text'
      );
		} else {
      $('#mail')
        .addClass('input__error-border')
        .focus()
        .on('input', function() {
          cleanError($('#mail'));
        });
    }
	});

	// Submit form width numbers of ticket to "HOW TO GET THE NUMBER" page
	$('#optim_md5hash span').on('click', function() {
	  $('#lottery-number-form').submit();
	});

	// Generate random numbers for the ticket
	$('#generate_random_numbers').on('click', function() {
		if ( $(this).attr('class') != 'no_reaction' ) {
      for (let i= 0; i < 7; i++) {
        $('#num' + i).val( Math.floor(Math.random()*99) );
      }
		}
	});
});