$('body').on("submit", "#show__results__lottery", function(e){
	e.preventDefault();

	const data_num_ticket     = $('#results').attr('data-num-ticket');
	const data_numbers_ticket = $('#results').attr('data-numbers-ticket');
	const data_optim_ticket   = $('#results').attr('data-optim-ticket');
	const data_delta_ticket   = $('#results').attr('data-delta-ticket');
	const data_date_ticket    = $('#results').attr('data-date-ticket');

	// Clean error styles when the user enters data
	$('#issue_number').keyup(function(){
      cleanError($(this));
	});

  if( $('#issue_number').val() == '' ) {
    $('#issue_number')
      .addClass('input__error-border')
      .focus();
  } else {
    showSpinner();
		$.ajax({
			type: "POST",
			cache: false ,
			url: "/utils/get-lottery-data.php",
			data: {
			  issue_number: $('#issue_number').val(),
              id_lang: $('#id_lang').val()
            },
			dataType: "text",
			async: true,
			success: function(data) {
				
				console.log(data);				
				
                hideSpinner();
                switch (data) {
                    case 'error':
                        $('.background_popup, #results__get__data__false')
                        .addClass('show');
                        break;
                    case 'did_not_play':
                        $('.background_popup, #results__did__not__play')
                        .addClass('show');
                        break;
                    default:

            let obj = $.parseJSON(data);

            if (!obj) {
              $('.background_popup, #false__get__data')
                .addClass('show');
            } else {
              $('#num_lottary').html(obj.LOTTERY__TYPE + obj.ID_LOTTERY);
              $('#type_lottary').html(obj.LOTTERY__TYPE_STRING);
              $('#date_lottary').html(obj.DATE__GAME);
              $('#profit_lottary').html(obj.PROFIT + ' Bitcoin');
              $('#tickets_lottary').html(obj.COL_TICKETS_SOLD);
              $('#sum_lottary').html(obj.AMOUNT_OF_NUMBERS_AS_LINE);
              $('#optim_lottary').html(obj.OPTIM_MD5HASH);

              for (let i = 1; i < 4; i++) {
                $.each(obj.TICKETS[i], function(key,value) {
                  let htmltag = '';
                  htmltag += '<ul class="winner__tickens">';
                  htmltag += '<li>' + data_num_ticket + ': <span>' + obj.ID_LOTTERY + '/' + key.toString() + '</span></li>';
                  htmltag += '<li>' + data_numbers_ticket + ': <span>' + value['NUM1'] + ' - ' + value['NUM2'] + ' - ' + value['NUM3'] + ' - ' + value['NUM4'] + ' - ' + value['NUM5'] + ' - ' + value['NUM6'] + ' - ' + value['NUM7'] + '</span></li>';
                  htmltag += '<li>' + data_optim_ticket + ': <span>' + value['OPTIM_MD5HASH'] + '</span></li>';
                  htmltag += '<li>' + data_delta_ticket + ': <span>' + value['DELTA'] + '</span></li>';
                  htmltag += '<li>' + data_date_ticket + ': <span>' + value['DATE_CREATE'] + '</span></li>';
                  htmltag += '</ul>';
                  $('#place' + i).append(htmltag);
                });
              }
              $('#show__results__lottery').css('display','none');
              $('.results, #next__lottary').addClass('show');
            }
            break;
        }
			}
		});
	}
});

// Show another lottery
$("#next__lottary").click(function(){
	$('#place1,' +
    '#place2,' +
    '#place3,' +
    '#num_lottary,' +
    '#type_lottary,' +
    '#date_lottary,' +
    '#profit_lottary,' +
    '#tickets_lottary,' +
    '#sum_lottary,' +
    '#optim_lottary').html('');
	$('#issue_number').val('');
	$('.results, #next__lottary').removeClass('show');
	$('#show__results__lottery').css('display','block');
	$('html,body').animate({scrollTop: 0});
});