function show_msgT(type, msg){
	type = parseInt(type);
	switch(type){
		case 1:
			toastr.success(msg);
		break;
		case 2:
			toastr.info(msg);
		break;
		case 3:
			toastr.error(msg);
		break;
		case 4:
			toastr.warning(msg);
		break;
		default:
			toastr.error("Invalid alert call.");
		break;
	}
}
//////////////////////////////////////////////////////////////////
function linkClick(thiss, target=''){
	target = target.toUpperCase();
	if(target == 'O'){
		var link = $(thiss).find('option:selected').attr('data-link');
	}else{
		var link = $(thiss).attr('data-link');
	}
	
	if(target == 'B'){
		window.open(link, '_blank');
	}else{
		window.location = link;
	}
}
//////////////////////////////////////////////////////////////////
function recordsDelete(thiss, idd){
	var cnf = confirm("Are you sure to delete it..?");
	if(cnf){
		var url = $(thiss).attr('data-link');
		$.ajax({
			type: "POST",
			url: url,
			data: {id:idd, _token: "{{ csrf_token() }}"},
			success:function(result){
			  console.log(result);
			  result = result.trim();
			  result = result.split('||');
			  var msg = result[1];
			  var mod = result[2];
			  show_msgT(mod, msg);
			  if(mod == '1'){
				setTimeout(function() {
				  //location = "{{ route('login') }}";
				  location.reload();
				}, 2000);
			  }
			}
		});
	}
}
//////////////////////////////////////////////////////////////////
$('.alpnum').on('keyup', function() {
	var inputValue = $(this).val();
	var alphanumericRegex = /^[a-zA-Z0-9_]+$/;

	if (!alphanumericRegex.test(inputValue)) {
	  $(this).val(inputValue.replace(/[^a-zA-Z0-9_]/g, ''));
	}
});
///////////////////////////////////////////////////////////////////
$(document).on('keyup', 'input[type="text"]', function(){
	var value = $(this).val();
	value = value.trim();
	if(value == ''){
		$(this).val('');
	}
});
////////////////////////////////////////////////////////
$(".float").on("keypress keyup blur",function (event) {
	//this.value = this.value.replace(/[^0-9\.]/g,'');
	$(this).val($(this).val().replace(/[^0-9\.]/g,''));
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
	
	if($(this).val() < 1){		$(this).val('');			}
});

	
//////////////////////////////////////////////////////////////
$(".int").on("keypress keyup blur",function (event) {    
   $(this).val($(this).val().replace(/[^\d].+/, ""));
	if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});
////////////////////////////////////////////////////////////
$('.char').on("keypress keyup blur",function (e) { 
var key = e.keyCode;
	if (!((key == 8) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (e.shiftKey || e.ctrlKey || e.altKey))) {
	  e.preventDefault();
	}	 
});
///////////////////////////////////////////////////////////////////
$(document).on('keyup, keypress', 'input[maxlength]', function(e){
	var maxx = $(this).attr('maxlength');
	var value = $(this).val();
	value = value.trim();
	if(value.length == maxx){
		e.preventDefault();
	}
});
/////////////////////////////////////////////////////////////////////////
$('.listSearch').on('keyup', function(){
	var value = $(this).val().toLowerCase();
	$(".table tbody tr").filter(function() {
      $(this).toggle($(this).find('td').text().toLowerCase().indexOf(value) > -1)
    });
});