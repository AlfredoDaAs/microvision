var manufacturer_access = {
	refresh_cms: function(){
		var selected_id = $('#drpManufacturer').val();
		$('#drpAvailableCM, #drpAsignedCM').empty();
		$('#btnOk').prop('disabled', true);

		if(selected_id){
			$('#btnOk').prop('disabled', false);
			$.post('manufacturer_access/cms',
				{
					selected_id
				},
				function(data){
					if(data.status == 'error'){
						return;
					}

					$.each(data.available_cms, function(i, cm){
						$('#drpAvailableCM').append('<option value="'+ cm.ID +'">'+
							cm.Description +
							'</option>');
					});

					$.each(data.asigned_cms, function(i, cm){
						$('#drpAsignedCM').append('<option value="'+ cm.ID +'">'+
							cm.Description +
							'</option>');
					});
				});
		}
	},

	move_left: function(){
		var selected_items = $('#drpAsignedCM :selected');

		if($(selected_items).length){
			$(selected_items).appendTo('#drpAvailableCM');
		}
	},

	move_right: function(){
		var selected_items = $('#drpAvailableCM :selected');

		if($(selected_items).length){
			$(selected_items).appendTo('#drpAsignedCM');
		}
	},

	submit: function(form){
		$('#drpAsignedCM option').each(function(i){
			$(this).prop('selected', true);
		});
	}
};