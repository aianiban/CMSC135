$(document).ready(function() {
	$.ajax({
		url: "../buttons/view.php",
		type: "POST",
		cache: false,
		success: function(dataResult){
			$('#table').html(dataResult); 
		}
	});
	$(document).on("click", "#edit_data", function() { 
		$.ajax({
			url: "../buttons/edit.php",
			type: "POST",
			cache: false,
			data:{
				email: $('#email').val(),
				contact: $('#contact').val(),
				address: $('#address').val(),
			},
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#update_profile').modal().hide();
					alert('Data updated successfully !');
					location.reload();					
				}
			}
		});
	}); 
});