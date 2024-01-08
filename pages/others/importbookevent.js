ibe = {

}
//////////////////////////////////////////////////////////////////////////
$('.frmBookEventSave').on('submit', function(e) {
    e.preventDefault(); 
	var bok_ev_id = $('.bok_ev_id').val();
	var urlSave = $(this).attr('action');
	var csrf_token = $('input[name="_token"]').val();
	$('.tdStatus').text("Progress").addClass('text-info');
	$('.btnSubmit').attr('disabled', 'disabled');
	$('.event_book').not('.trrAdd').each(function(index){
		var thiss = this;
		var info = $(thiss).val();
		$.ajax({
			type: "POST",
			url: urlSave,
			data: { info : info, bok_ev_id: bok_ev_id, _token: csrf_token },
			beforeSend: function(){
				$('.btnSubmit').attr('disabled', 'disabled');
			},
			success: function(result) {
				//console.log(result.status);
				var status = result.status;
				var message = result.message;
				var clr = 'text-warning';
				if(status == '1'){
					clr = 'text-success';
				}
				$(thiss).closest('.trrEB').find('.tdStatus').removeClass('text-info');
				$(thiss).closest('.trrEB').addClass('trrAdd');
				$(thiss).closest('.trrEB').find('.tdStatus').text(message).addClass(clr);
			},
			error: function(result) {
				$('.btnSubmit').removeAttr('disabled');
			}
		});
		
	});
});
//////////////////////////////////////////////////////////////////////////
$('.frmQuizSave').on('submit', function(e) {
    e.preventDefault(); 
	var urlSave = $(this).attr('action');
	var csrf_token = $('input[name="_token"]').val();
	$('.quizAdd').not('.trrAdd').each(function(index){
		var thiss = this;
		var info = $(thiss).val();
		$.ajax({
			async: false,
			type: "POST",
			url: urlSave,
			data: { info : info, _token: csrf_token },
			success: function(result) {
				console.log(result);
				var status = result.status;
				var message = result.message;
				var clr = 'text-dander';
				if(status == '1'){
					clr = 'text-success';
				}
				$(thiss).closest('.trrEB').addClass('trrAdd');
				$(thiss).closest('.trrEB').find('.tdStatus').text(message).addClass(clr);
			}
		});
	});
});