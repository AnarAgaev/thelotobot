$('body').on("submit", "#show__ticket", function(e){
		e.preventDefault();
		let validForm = true; // variable in order to track the correctness of the data entered by the user

		// Cleaning error styles before running the script
		$('#num, #inv, #pas').removeClass('input__error-border');

		// Cleaning error styles when the user enters data
		$('#num, #inv, #pas').keyup(function(){
      cleanError($(this));
		});

		// verification user data
		if ($('#pas').val() === '') {
			$('#pas')
        .addClass('input__error-border')
        .focus();
			validForm = false;
		}

		if ($('#inv').val() === '') {
			$('#inv')
        .addClass('input__error-border')
        .focus();
			validForm = false;
		}

		if ($('#num').val() == '') {
			$('#num')
        .addClass('input__error-border')
        .focus();
			validForm = false;
		}

		// Script for get data of the ticket
		if (validForm) {
		  showSpinner();
			$.ajax({
				type: "POST",
				cache: false ,
				url: "/utils/get-ticket-data.php",
				data: {
					num: $('#num').val(),
					inv: $('#inv').val(),
					pas: $('#pas').val(),
				},
				dataType: "text",
				async: true,
				success: function(data) {
          hideSpinner();
          switch (data) {
            case 'false':
              $('.background_popup, #false__get__data')
                .addClass('show');
              break;
            case 'error':
              $('.background_popup, #error__data')
                .addClass('show');
              break;
            default:

              let obj = $.parseJSON(data);

              if (!obj) {
                $('.background_popup, #false__get__data')
                  .addClass('show');
              } else {
                $('#num__ticket').html(obj.id_lottery + '/' + obj.id_ticket);
                $('#num__wallet').html(obj.address);
                $('#num__invoice').html(obj.invoice);
                $('#nums').html(obj.num1 + ' - ' +
                  obj.num2 + ' - ' +
                  obj.num3 + ' - ' +
                  obj.num4 + ' - ' +
                  obj.num5 + ' - ' +
                  obj.num6 + ' - ' +
                  obj.num7);
                $('#date__create').html(obj.date_create_ticket +
                  '<a class="anchor" target="_black" href="https://en.wikipedia.org/wiki/Greenwich_Mean_Time">' +
                  'Greenwich Mean Time (GMT)' +
                  '</a>');
                $('#date__get__pay').html(obj.date_payment_ticket);
                $('#sum__get__pay').html(obj.amount + ' Bitcoin');
                $('#num__lottery').html(obj.lottery_type + obj.id_lottery);
                $('#type__lottery').html(obj.lottery_type_as_text);
                $('#date__lottery').html(obj.date);
                $('#price').html(obj.price + ' Bitcoin');
                $('#profit').html(obj.profit + ' Bitcoin <span class="red_text">' + obj.moment + '</span>');
                $('#lottery__status').html(obj.completed);
                $('#num__error').html(obj.error);
                $('#show__ticket,#title__show__ticket').css('display','none');
                $('.data__ticket,#next__ticket').css({'display':'block','height':'auto'});
                $('html,body').animate({scrollTop: 30});

                let description = $('#optim_md5hash').attr('data-description');
                $('#optim_md5hash .number').html(obj.optim_md5hash);
                $('#optim_md5hash .anchor').html(description);

                $('#selected_number_1').val(obj.num1);
                $('#selected_number_2').val(obj.num2);
                $('#selected_number_3').val(obj.num3);
                $('#selected_number_4').val(obj.num4);
                $('#selected_number_5').val(obj.num5);
                $('#selected_number_6').val(obj.num6);
                $('#selected_number_7').val(obj.num7);

                let swipes = document.querySelector('.horizontal-swipe');
                [].forEach.call(swipes, function(elem) {
                  elem.style.display = 'block';
                });

                addSwipe();
              }
              break;
          }
				}
			});
		}
});

// Show another ticket
$("#next__ticket").click(function() {
	$('#num__ticket, ' +
    '#num__wallet, ' +
    '#num__invoice, ' +
    '#nums, ' +
    '#date__create, ' +
    '#date__get__pay, ' +
    '#sum__get__pay, ' +
    '#num__lottery, ' +
    '#type__lottery, ' +
    '#date__lottery, ' +
    '#price,#profit, ' +
    '#lottery__status, ' +
    '#num__error, ' +
    '#optim_md5hash .number, ' +
    '#optim_md5hash .anchor').html('');
	$('#num, #inv, #pas').val('');
	$('#show__ticket, #title__show__ticket').css('display','block');
	$('.data__ticket, #next__ticket').css({
    'display':'none',
    'height':'0'});
	$('html,body').animate({scrollTop: 380});
});

// Submit form with numbers of ticket to HOW TO GET THE NUMBER PAGE
$('#optim_md5hash .anchor').click(function(){
  $('#lottery-number-form').submit();
});