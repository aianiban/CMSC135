$(document).ready(function() {
    $("#search-bar").keyup(function() {
        var searchTerm = document.forms["search-form"]["search-bar"].value;
        if(searchTerm != "") {
            console.log("ajax good");
            $.ajax({
                url: '../index/search-items.php',
                type: 'post',
                data: {
                    searchTerm: searchTerm
                }, 
                cache: false,
                success: function(data) {
                    if(searchTerm != "") {
                        $('#search').html(data);
                    } else {
                        $('#search').html("");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
            console.log(searchTerm);
        } else {
            console.log("nope");
            $('#search').html("");
        }
    });



});