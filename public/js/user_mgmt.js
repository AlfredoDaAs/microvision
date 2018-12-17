var user_mgmt = {
	user_id: 0,

	init: function(){
		$('.editUser, .deleteUser').tooltip();
	},

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
		$('#editUserModal input[type="email"]').val('');
		$('#editUserModal input:text').val('');
		$('#drpManufacture > option:eq(0)').prop('selected', true);
		$('#chkStatus').prop('checked', false);
		$('#errors ul').empty();
		$('#errors').addClass('d-none');
	},

	save: function(e){
		e.preventDefault();

		var data = $('#frmSaveUser').serialize() + '&user_id=' + user_mgmt.user_id;

		$.post('user_management/save',
		{
			data
		},
		function(data){
			$('#errors').addClass('d-none');
			if(data.status == 'error'){
				var errors = data.errors ? data.errors : null;
				if(errors){
					$.each(errors, function(i, error){
						$.each(error, function(e, msg){
							$('#errors ul').append('<li>'+ msg +'</li>');
						});
					});
					$('#errors').removeClass('d-none');
				}
				return;
			}

			$('#editUserModal').modal('hide');
			user_mgmt.refreshUsers();
		});
	},

	refreshUsers: function(){
		$.post('load_users_card',
		function(data){
			if(data.status == 'error'){
				return;
			}

			$('#contentCard').html(data.html);
		});
	},

	openDelete: function(id, user_name){
		user_mgmt.user_id = id? id : 0;
		$('#deleteUserModal .deleteTitle').text(user_name);
		$('#deleteUserModal').modal('show');
	},

	delete: function(){
		if(user_mgmt.user_id){
			$.post('user_management/delete',
			{
				user_id: user_mgmt.user_id
			},
			function(data){
				if(data.status == 'error'){
					return;
				}

				$('#deleteUserModal').modal('hide');
				user_mgmt.refreshUsers();
			});
		}
	}
};