var manufacturer_mgmt = {
	editing: 0,
	data_id: null,

	edit: function(){
		$('#addManufacturer').toggleClass('d-none');
		$('#btnOk, .checkbox').prop('disabled', function(i, v){ return !v; });
		if(!manufacturer_mgmt.editing){
			manufacturer_mgmt.editing = 1;
			$('#btnEdit').text('Cancel');
			$('.new, .removeManufacturer').removeClass('d-none');
			$('.manufacturers').find('span').addClass('d-none');
			$('.manufacturers').find('.desc').removeClass('d-none');
		}else{
			manufacturer_mgmt.editing = 0;
			$('#btnEdit').text('Edit');
			$('.new, .removeManufacturer').addClass('d-none');
			$('.manufacturers').find('span').removeClass('d-none');
			$('.manufacturers').find('.desc').addClass('d-none');
		}
	},

	addManufacturer: function(){
		var rows = $('#tblManufacturers tbody > tr');
		manufacturer_mgmt.data_id = $(rows).length ? $(rows).last().attr('data-id') : null;
		console.log($(rows).length);
		$.post('manufacturer_management/new_input',
			{
				data_id: manufacturer_mgmt.data_id
			},
			function(data){
			if(data.status == 'error'){
				return;
			}

			$('#tblManufacturers tbody').append(data.html);
		});
	},

	removeManufacturer: function(item){
		$(item).closest('tr').remove();
	}
};