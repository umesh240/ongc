htl = {
	addMore:function(thiss){
		var trr = $(thiss).closest('tr');

		var index = trr.attr('data-index');
		var intno = trr.attr('data-intno');
		var hotel_category = trr.find('.hotel_category').val();
		var room_for = trr.find('.room_for').val();
		var hotel_noofrooms = trr.find('.hotel_noofrooms').val();
		if(parseInt(index) < 0 || index == '' || index == undefined){
			index = '';
		}
		if(room_for == '' || room_for == undefined || room_for == null){
			room_for = '';
		}
		if(parseInt(intno) <= 0 || intno == '' || intno == undefined){
			intno = 0;
		}
		if(hotel_category == '' || hotel_category == undefined || hotel_category == null){
			show_msgT(3, 'Please enter room category');
			trr.find('.hotel_category').focus();
			return false;
		}
		if(hotel_noofrooms <= 0 || hotel_noofrooms == '' || hotel_noofrooms == undefined || hotel_noofrooms == null){
			show_msgT(3, 'No of rooms should be greater then 0.');
			trr.find('.hotel_noofrooms').focus();
			return false;
		}
		var hotel_category = hotel_category[0].toUpperCase() + hotel_category.substring(1);
		var categoryExists = false;
		$('.td_cat').not('.td_cat:eq('+index+')').each(function(index) {
			// Check if the text content of the element is equal to 'hotel_category'
			if ($(this).text().trim() === hotel_category) {
				categoryExists = true;
				return false;
			}
		});
		if (categoryExists) {
			show_msgT(3, 'This hotel category is already exist.');
			return false;
		}

		var info = intno+'^'+hotel_category+'^'+hotel_noofrooms+'^'+room_for;
		var row = '<tr>\
			<td class="td_cat">'+hotel_category+'</td>\
			<td>'+hotel_noofrooms+'</td><td>'+room_for+'</td>\
			<td style="text-align: center;"> \
				<input type="hidden" class="category_info" name="category_info[]" value="'+info+'">\
				<button type="button" class="btn btn-xs btn-info" onclick="htl.edit(this);">Edit</button>\
				<button type="button" class="btn btn-xs btn-danger" onclick="htl.delete(this);">Delete</button>\
			</td>\
		</tr>';

		if(parseInt(index) >= 0){
			$('.tBodyList tr:eq(' + index + ')').replaceWith(row);
		}else{
			$('.tBodyList').append(row);
		}
		htl.reset();
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
		var category_info = trr.find('.category_info').val();
		category_info = category_info.split('^');
		var intno = category_info[0];
		var hotel_category = category_info[1];
		var total_rooms = category_info[2];

		var trrH = $('.tHeadAdd');
		trrH.attr('data-index', index);
		trrH.attr('data-intno', intno);
		trrH.find('.btnAdUpd').text('Update');
		trrH.find('.hotel_category').attr('value', hotel_category).val(hotel_category);
		trrH.find('.hotel_noofrooms').attr('value', total_rooms).val(total_rooms);
	},
	delImage:function(thiss, image){
		var cnf = confirm('Are you sure to delete this image..?');
		if(cnf){
			var input = '<input type="hidden" name="delImg[]" class="delImg" value="'+image+'" />';
			$('.divDelImg').append(input);
			$(thiss).closest('.img-wraps').remove();
		}
	},
	hideUser:function(thiss, l_or_h){
		var l_or_h = l_or_h.toUpperCase();
		var fpr_id = $(thiss).val();
		if(parseInt(fpr_id) > 0){
			console.log(fpr_id);
			if(l_or_h == 'L'){
				var sltCls = '.hospitality_fpr';
			}else{
				var sltCls = '.logistic_fpr';
			}
			$(sltCls).find('option').removeAttr('disabled');
			$(sltCls).find('option[value="'+fpr_id+'"]').attr('disabled', 'disabled');
			$(sltCls).select2('destroy').select2();
		}else{
			$('.hospitality_fpr').find('option').removeAttr('disabled');
			$('.logistic_fpr').find('option').removeAttr('disabled');
		}
	},
}
//////////////////////////////////////////////////////////////////////////

var op_len = $('.eventcd').find('option').length;
if(parseInt(op_len) == 1){
$('.eventcd').find('option:eq(0)').attr('selected', 'selected');
}