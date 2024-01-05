be = {
	getCategory:function(thiss){
		var hotel_cd = $(thiss).val();
		var link = $(thiss).attr('data-link');
		var csrf_token = $('input[name="_token"]').val();
		$.ajax({
            type: "POST",
            url: link,
            data: { hotel_cd : hotel_cd, _token: csrf_token },
	        beforeSend: function(){
	          $('.loading-container').css('display', 'flex');
	        },
            success: function (response) {
				var catList = response.category_list;
				//console.log(catList);
				$('.room_categorycd').html(catList);
				var cat_cd = $('.room_categorycd').attr('data-cat_cd');
				if(cat_cd > 0){
					$('.room_categorycd').val(cat_cd);
				}
				var op_len = $('.room_categorycd').find('option').length;
				//console.log(op_len);
				if(parseInt(op_len) == 1){
					$('.room_categorycd option:eq(0)').attr('selected', 'selected');
				}
				//$('.room_categorycd').trigger('change');
				$('.loading-container').css('display', 'none');
            },
            error: function (error) {
                console.log(error);
            }
        });
	},
	getHotels:function(thiss){
		var eventcd = $(thiss).val();
		var stt = $(thiss).find('option:selected').attr('data-stt');
		var end = $(thiss).find('option:selected').attr('data-end');
		var emp_evv_id = $('.emp_evv_id').val();
		var user_cd = $('.cd').val();
		if(parseInt(emp_evv_id) <= 0 || emp_evv_id == ''){
			$('.assign_check_in').val(stt);
			$('.assign_check_out').val(end);
		}
		var link = $(thiss).attr('data-link');
		var csrf_token = $('input[name="_token"]').val();
		$.ajax({
            type: "POST",
            url: link,
            data: { eventcd : eventcd, user_cd : user_cd, _token: csrf_token },
	        beforeSend: function(){
	          $('.loading-container').css('display', 'flex');
	        },
            success: function (response) {
				var hotel_list = response.hotel_list;
				var user_exist = response.user_exist;
				if(user_exist === true){
					show_msgT(3, 'This user is already registred for selected event.');
					$('.btnUsrSubmit').attr('disabled', 'disabled');
					return false;
				}else{
					$('.btnUsrSubmit').removeAttr('disabled');
				}
				//console.log(response);
				$('.hotel_cd').html(hotel_list);
				var hotel_cd = $('.hotel_cd').attr('data-hotel_cd');
				if(hotel_cd > 0){
					$('.hotel_cd').val(hotel_cd);
				}
				$('.hotel_cd').trigger('change');
				$('.loading-container').css('display', 'none');
            },
            error: function (error) {
                console.log(error);
            }
        });
	},
	setUserInfo:function(thiss){
		var eventcd = $('.eventcd').val();
		var room_categorycd = $('.room_categorycd').val();
		if(eventcd == '' || eventcd == undefined || eventcd == null || room_categorycd == '' || room_categorycd == undefined || room_categorycd == null){
			show_msgT(3, 'Please select event and hotel room category.');
			$('.tHeadAdd .td_empId').select2('destroy').val("").select2();
			return false;
		}
		var trr = $(thiss).closest('tr');
		var usr_id = $(thiss).val();
		var usr_level = usr_desi = usr_cate = '';
		//console.log(selectedOptionHTML);
		trr.find('.td_empShareRm').val('');
		trr.find('.td_empShareRm').find('option').prop('disabled', false);
		if(parseInt(usr_id) > 0){
			usr_level = $(thiss).find('option:selected').attr('data-level');
			usr_desi = $(thiss).find('option:selected').attr('data-desi');
			usr_cate = $(thiss).find('option:selected').attr('data-cate');
			trr.find('.td_empShareRm').find('option[value="'+usr_id+'"]').prop('disabled', true);
			
		}
		trr.find('.td_empLevel').text(usr_level);
		trr.find('.td_empDesig').text(usr_desi);
		trr.find('.td_empShareRm').trigger('change');
	},
	getShareRoom:function(thiss){
		$('.td_empShareRm ').html('');
		var link = $(thiss).attr('data-link');
		var eventcd = $('.eventcd').val();
		var hotel_cd = $('.hotel_cd').val();
		var room_categorycd = $('.room_categorycd').val();
		var csrf_token = $('input[name="_token"]').val();
		if(parseInt(room_categorycd) > 0){
			$.ajax({
				type: "POST",
				url: link,
				data: { hotel_cd : hotel_cd, eventcd: eventcd, categorycd: room_categorycd, _token: csrf_token },
		        beforeSend: function(){
		          $('.loading-container').css('display', 'flex');
		        },
				success: function (response) {
					//console.log(response);
					var rmList = response.result;
					var status = response.status;
					if(parseInt(status) == 1){
						$('.td_empShareRm ').html(rmList);
					}
					$('.loading-container').css('display', 'none');
				},
				error: function (error) {
					console.log(error);
				}
			});
		}
	},
	addMore:function(thiss){
		var linkExist = $(thiss).attr('data-link');
		var csrf_token = $('input[name="_token"]').val();
		var eventcd = $('.eventcd').val();
		var room_categorycd = $('.room_categorycd').val();
		if(eventcd == '' || eventcd == undefined || eventcd == null || room_categorycd == '' || room_categorycd == undefined || room_categorycd == null){
			show_msgT(3, 'Please select event and hotel room category.');
			return false;
		}

		var trr = $(thiss).closest('tr');
		var linkDel = trr.attr('data-linkDel');
		var index = trr.attr('data-index');
		var intno = trr.attr('data-intno');
		var td_empId = trr.find('.td_empId').val();
		//console.log(td_empId);
		var td_empTxt = trr.find('.td_empId option:selected').text();
		var usr_level = trr.find('.td_empId option:selected').attr('data-level');
		var usr_desi = trr.find('.td_empId option:selected').attr('data-desi');
		var usr_cate = trr.find('.td_empId option:selected').attr('data-cate');
		var selectedOptionHTML = trr.find('.td_empId option:selected').prop('outerHTML');
		var td_empShareRm = trr.find('.td_empShareRm').val();
		var td_empShareRmTxt = '';
		if(parseInt(td_empShareRm) > 0){
			td_empShareRmTxt = trr.find('.td_empShareRm option:selected').text();
		}
		if(parseInt(intno) <= 0 || intno == '' || intno == undefined){
			intno = 0;
		}
		if(parseInt(td_empShareRm) <= 0 || td_empShareRm == '' || td_empShareRm == undefined){
			td_empShareRm = 0;
		}
		if(td_empId == '' || td_empId == undefined || td_empId == null){
			show_msgT(3, 'Please select employee.');
			trr.find('.td_empId').focus();
			return false;
		}
		var categoryExists = false;
		$('.user_info').not('.user_info:eq('+index+')').each(function(index) {
			// Check if the text content of the element is equal to 'hotel_category'
			var idd = $(this).attr('data-idd');
			if (idd === td_empId) {
				categoryExists = true;
				return false;
			}
		});
		$.ajax({
			async: false,
			type: "POST",
			url: linkExist,
			data: { empId : td_empId, eventcd: eventcd, intno: intno, _token: csrf_token },
	        beforeSend: function(){
	          $('.loading-container').css('display', 'flex');
	        },
			success: function (response) {
				//console.log(response);
				var result = response.result;
				var status = response.status;
				if(parseInt(status) == 0){
					categoryExists = true;
				}
				$('.loading-container').css('display', 'none');
			},
			error: function (error) {
				console.log(error);
			}
		});
		if (categoryExists) {
			show_msgT(3, 'This employee is already exist.');
			return false;
		}

		var info = intno+'^'+td_empId+'^'+td_empShareRm;
		var row = '<tr class="trEmp">\
			<td class="pt-0 pb-0">'+td_empTxt+'</td>\
			<td class="pt-0 pb-0">'+usr_level+'</td>\
			<td class="pt-0 pb-0">'+usr_desi+'</td>\
			<td class="pt-0 pb-0">'+td_empShareRmTxt+'</td>\
			<td class="pt-0 pb-0"style="text-align: center;"> \
				<input type="hidden" class="user_info" name="user_info[]" data-idd="'+td_empId+'" value="'+info+'">\
				<button type="button" class="btn btn-xs btn-info" onclick="be.edit(this);">Edit</button>\
				<button type="button" class="btn btn-xs btn-danger" data-link="'+linkDel+'" onclick="recordsDelete(this, '+intno+');">Delete</button>\
			</td>\
		</tr>';

		if(parseInt(index) >= 0){
			$('.tBodyList tr:eq(' + index + ')').replaceWith(row);
		}else{
			$('.tBodyList').append(row);
			trr.find('.td_empShareRm').append(selectedOptionHTML);
			trr.find('.td_empShareRm').select2('destroy').val("").select2();
		}
		be.reset();
	},
	reset:function(){
		var trr = $('.tHeadAdd');
		trr.find('input').val('');
		trr.find('select').val('').trigger('change');
		trr.removeAttr('data-index');
		trr.removeAttr('data-intno');
		trr.find('.btnAdUpd').text('Add More');
	},
	edit:function(thiss){
		var trr = $(thiss).closest('tr');
		var index = trr.index();
		var user_info = trr.find('.user_info').val();
		user_info = user_info.split('^');
		var intno = user_info[0];
		var emp_cd = user_info[1];
		var emp_cd_share = user_info[2];
		if(parseInt(emp_cd_share) <= 0 || emp_cd_share == ''){
			emp_cd_share = '';
		}

		var trrH = $('.tHeadAdd');
		trrH.attr('data-index', index);
		trrH.attr('data-intno', intno);
		trrH.find('.btnAdUpd').text('Update');
		trrH.find('.td_empId').val(emp_cd).trigger('change');
		trrH.find('.td_empShareRm').val(emp_cd_share).trigger('change');
	},
	/*
	delImage:function(thiss, image){
		var cnf = confirm('Are you sure to delete this image..?');
		if(cnf){
			var input = '<input type="hidden" name="delImg[]" class="delImg" value="'+image+'" />';
			$('.divDelImg').append(input);
			$(thiss).closest('.img-wraps').remove();
		}
	},*/
}
//////////////////////////////////////////////////////////////////////////
$('.frmBookEventSave').on('submit', function(e) {
    e.preventDefault(); 
	var trEmpLen = $('.trEmp').length;
	if(parseInt(trEmpLen) <= 0 || trEmpLen == undefined || trEmpLen == null){
		show_msgT(3, 'Please add atleat 1 employee.');
		return false;
	}
	var urlSave = $(this).attr('action');
    $.ajax({
        type: "POST",
        url: urlSave,
        data: $(this).serialize(),
        beforeSend: function(){
          $('.loading-container').css('display', 'flex');
        },
        success: function(result) {
        	//console.log(result);
			var status = result.status;
			var message = result.message;
			show_msgT(status, message);
			if(parseInt(status) == 1){
				setTimeout(function(){
					location.reload();
				}, 1500);
			}
			$('.loading-container').css('display', 'none');
        }
    });
});
////////////////////////////////////////////////////////////////////////////
var cat_cd = $('.room_categorycd').attr('data-cat_cd');
if(cat_cd > 0){
	be.getCategory('.hotel_cd');
	setTimeout(function(){
		be.getShareRoom('.room_categorycd');
	}, 1000);
}
/////////////////////////////////////////////////////////////
be.getCategory('.hotel_cd');