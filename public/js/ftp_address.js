var ftp_address = {
	edit: function(){
		$('#frmFtpAddress').find('.ftpsetting').prop('disabled', function(i, v){ return !v; });
		$('#btnOk').prop('disabled', function(i, v){ return !v; });
	}
};