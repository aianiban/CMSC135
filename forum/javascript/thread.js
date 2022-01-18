var myVar = setInterval(LoadData, 2000);

http_request = new XMLHttpRequest();



$(document).on('click', '#view-more', function() {
	$('#num-comments').val(+$('#num-comments').val() + 10);
	LoadData();

});

$(document).on('click', '#view-entire', function() {
	$('#num-comments').val(0);
	LoadData();

});





// $("#view-more").on('click', function() {
// 	$('#num-comments').val(+$('#num-comments').val() + 5);
// 	var shit = $('#num-comments').val();
// 	console.log("view more: " + shit);
// 	LoadData();
	
// });


// $("#view-entire").on('click', function() {
// 	$('#num-comments').val(0);
// 	var shit = $('#num-comments').val();
// 	console.log("entire: " + shit);
// 	LoadData();

// });

function LoadData(){
	var numComments = $('#num-comments').val();
	var forumBtns = document.getElementById("forum-btns");
	$.ajax({
		url: 'php/view.php',
		type: "POST",
		dataType: 'json',
		data: {
			numComments: numComments
		},
		success: function(data) {
			$('#MyTable tbody').empty();
			console.log("index: " + numComments);
			console.log("total: " + data[0].total_comments);
			if(numComments < data[0].total_comments && numComments != 0){
				$("#forum-btns").html('<input type="button" class="btn btn-outline-success" id="view-more" value="View More Comments"><input type="button" class="btn btn-outline-success" id="view-entire" value="View Entire Discussion">');
			} else {
				// if(numComments >= data[0].total_comments || numComments == 0){$("#forum-btns").html("");}	
				if(numComments >= data[0].total_comments || numComments == 0){
					forumBtns.style.display = "none"; 
					console.log("potanginaasfijshflsafjad");
				}
			}
			for (var i=1; i<data.length; i++) {
				var commentId = data[i].id;
				if(data[i].parent_comment == 0){
					var row = $('<tr><td><b><img src="../img/' + data[i].img + '" width="30px" height="30px" />   ' + data[i].comment_user + '     </b><i>' + data[i].date_posted + '</i></br><p style="padding-left:80px">' + data[i].comment_content + '</br><a data-toggle="modal" data-id="'+ commentId +'" title="Add this item" class="open-reply-modal" href="#reply-modal">Reply</a>'+'</p></td></tr>');
					$('#record').append(row);
					for (var r = 1; (r < data.length); r++)
							{
								if ( data[r].parent_comment == commentId)
								{
									var comments = $('<tr><td style="padding-left:80px"><b><img src="../img/' + data[r].img + '" width="30px" height="30px" />   ' + data[r].comment_user + '     </b><i>' + data[r].date_posted + '</i></b></br><p style="padding-left:40px">'+ data[r].comment_content +'</p></td></tr>');
									$('#record').append(comments);
								}
							}
				}
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log('Error: ' + textStatus + ' - ' + errorThrown);
		}
	});
}



$(document).on("click", ".open-reply-modal", function () {
     var commentid = $(this).data('id');
     $(".modal-body #commentid").val( commentid );
});


		
//Post data to the server
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$('#num-comments').val(0);
		var id = document.forms["frm"]["Pcommentid"].value;
		var msg = document.forms["frm"]["msg"].value;
		if(msg!=""){
			$.ajax({
				url: "php/save.php",
				type: "POST",
				data: {
					id: id,
					msg: msg,			
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						// $("#butsave").removeAttr("disabled");
						document.forms["frm"]["Pcommentid"].value = "0";
						document.forms["frm"]["msg"].value = "";
						LoadData(); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
				}
			});
		}
		else{			
			alert('There\'s no reply.');
			// $("#btnsave").removeAttr("disabled");
		}
	});
});

//Reply comment
$(document).ready(function() {
	$('#btnreply').on('click', function() {
		// $("#btnreply").attr("disabled", "disabled");
		$('#num-comments').val(0);
		var id = document.forms["frm1"]["Rcommentid"].value;
		var msg = document.forms["frm1"]["Rmsg"].value;
		if(msg!=""){
			$.ajax({
				url: "php/save.php",
				type: "POST",
				data: {
					id: id,
					msg: msg,			
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						// $("#btnreply").removeAttr("disabled");
						document.forms["frm1"]["Rcommentid"].value = "";
						document.forms["frm1"]["Rmsg"].value = "";
						LoadData(); 
						$("#reply-modal").modal("hide");
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{			
			alert('There\'s no reply.');
			// $("#btnreply").removeAttr("disabled");
		}
	});
});


