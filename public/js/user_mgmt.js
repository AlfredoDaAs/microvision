var user_mgmt = {
	user_id: 0,
	openEdit: function(id){
		user_mgmt.user_id = id? id : 0;
		user_mgmt.refreshEdit();

		if(user_mgmt.user_id){
			$.post('/load_user',
			{
				user_id: user_mgmt.user_id
			},
			function(data){
				if(data.status == 'error'){
					return;
				}

				var user = data.user;

				$('#modalTitle').text(user.UserName);
				$('#txtLoginName').val(user.LoginName);
				$('#txtUserName').val(user.UserName);
				$('#drpManufacture').val(user.ManufacturerID);
				$('#txtEmail').val(user.Email);
				$('#chkStatus').prop('checked', (user.status_value)? true : false);
				$('#editUserModal').modal('show');
			});
		}else{
			$('#modalTitle').text('Add New User');
			$('#editUserModal').modal('show');
		}
	},

	refreshEdit: function(){
		$('#editUserModal input:text').val('');
		$('#drpManufacture > option:eq(0)').prop('selected', true);
		$('#chkStatus').prop('checked', false);
	},

	save: function(e){
		e.preventDefault();

		var data = $('#frmSaveUser').serialize() + '&user_id=' + user_mgmt.user_id;

		$.post('user_management/save',
		{
			data
		},
		function(data){
			if(data.status == 'error'){
				return;
			}


		});
	},

	refreshUsers: function(){

	}
};