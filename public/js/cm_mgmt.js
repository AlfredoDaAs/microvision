var cm_mgmt = {
	editing: 0,

	edit:  function(){
		$('#addCM').toggleClass('d-none');
		$('#btnOk').prop('disabled', function(i, v){ return !v; });
		if(!cm_mgmt.editing){
			cm_mgmt.editing = 1;
			$('#btnEdit').text('Cancel');
			$('.new').removeClass('d-none');
		}else{
			cm_mgmt.editing = 0;
			$('#btnEdit').text('Edit');
			$('.new').addClass('d-none');
		}
	},

	addCM: function(){
		$.post('cm_management/new_input', function(data){
			if(data.status == 'error'){
				return;
			}

			$('#tblCM').append(data.html);
		});
	},

	removeCM: function(item){
		$(item).closest('tr').remove();
	}
};