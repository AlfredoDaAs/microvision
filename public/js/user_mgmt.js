var user_mgmt = {
	openEdit: function(id){
		$.post('/load_user',
		{
			user_id: id
		},
		function(data){
			if(data.status == 'error'){
				return;
			}

			var user = data.user;

			$('#modalTitle').text(user.UserName);
			$('#editUserModal').modal('show');
		});
	}
};