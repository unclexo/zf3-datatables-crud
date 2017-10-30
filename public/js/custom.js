jQuery(function($){

	// Populates table with data
    var dataTable = $('#user-table').DataTable({	
        "processing": true,
        "serverSide": true,
    	"order": [0, 'DESC'],
    	"ajax": {
			type: "POST",
			url: "/users/all-users",
			dataType: 'JSON',
			// success: function(data) {
			// 	console.log(data);
			// },
            error: function(error) {
                console.log(error);
            },	    		
    	},
		"columnDefs": [
			{
				"targets": [4,5],
				"orderable": false,
			},
		],
		// "columns": [
		// 	{ 
		// 		"data": "id", 
		// 	},
		// 	{ 
		// 		"data": "firstname", 
		// 	},
		// 	{
		// 		"data": "lastname",
		// 	},
		// 	{
		// 		"data": "email",
		// 	},
		// 	{
		// 		"data": "edit",
		// 	},
		// 	{
		// 		"data": "delete",
		// 	},
		// ],	    	
    });

	// Clears form's data and changes text
	$('#add-this-user').on('click', function(e){
		e.preventDefault();
		$('#user-action-form')[0].reset();
		$('#status-message').html("");
	    $('#modal-title').text('Add New User');
	    $('#user-submit').val('Add User');
		$(document.body).append('<script>var useridEdit=null;</script>');
	});

	// Loads user data
	$('#user-table').on('click', '#edit-this-user', function(e){
		e.preventDefault();

		$('#status-message').html("");
		var fetchId = $(this).data('userid');
		$(document.body).append('<script>var useridEdit=' + fetchId + ';</script>');
	    var userId = useridEdit;

		$.ajax({
			type: 'POST',
			url: '/users/single-user',
			dataType: 'JSON',
			cache: false,
			data: {
				'userId': userId,
			},
			success: function(data){
			    $('#user-action-modal #firstname').val(data.user.firstname);
			    $('#user-action-modal #lastname').val(data.user.lastname);
			    $('#user-action-modal #email').val(data.user.email);
			    $('#user-action-modal #password').val("");
			    $('#modal-title').text('Update User');
			    $('#user-submit').val('Update User');
			    console.log("Loaded");
			},
			// https://stackoverflow.com/a/13698395
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});	    

	    // Opens modal
	    $('#user-action-modal').modal('show');		
	});

	// Adds and updates user
	$('#user-action-form').on('submit', function(e) {
		e.preventDefault();

		$('#status-message').html('');

		var firstname, lastname, email, password, userId;
		
		firstname = $('#firstname').val();
		lastname = $('#lastname').val();
		email = $('#email').val();
		password = $('#password').val();
		userId = useridEdit;

		$.ajax({
			type: 'POST',
			url: '/users/handle',
			dataType: 'JSON',
			cache: false,
			data: {
				'firstname': firstname, 
				'lastname': lastname, 
				'email': email, 
				'password': password,
				'userId': userId,
			},
			success: function(data) {
				if (data.error) {
					for (i = 0; i < data.error.length; i++) {
						$('#status-message').append('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+ data.error[i] + '</div>');
					}
				} else {
					// Resets input values
					$('#user-action-form')[0].reset();

					// Status
					console.log(data.success);

					// Hides modal
					$('#user-action-modal').modal('hide');

					// Reloads the table
					dataTable.ajax.reload();					
				}
			},
			// https://stackoverflow.com/a/13698395
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});
	});

	// Sets user id
	$('#user-delete-modal').on('show.bs.modal', function(e){
		var button = $(e.relatedTarget);
		var userId = button.data('userid');

		$(document.body).append('<script>var useridDelete=' + userId + ';</script>');
		$('#user-number-delete').text(useridDelete);
	});

	// Deletes user
	$('#delete-this-user').on('click', function(e){
		e.preventDefault();

	    var userId = useridDelete;
		
		$.ajax({
			type: 'POST',
			url: '/users/delete-user',
			dataType: 'JSON',
			cache: false,
			data: {
				'userId': userId,
			},
			success: function(data){
				// Status
				console.log(data.success);

				// Empty user ID
				$('#userid-edit').val("");

				// Hides modal
				$('#user-delete-modal').modal('hide');

				// Reloads the table
				dataTable.ajax.reload();
			},
			// https://stackoverflow.com/a/13698395
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});		
	});	
});