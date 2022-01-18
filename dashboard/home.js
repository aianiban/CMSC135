const searchBtn = document.getElementById("show-search"),
    searchBar = document.getElementById("search-bar"),
    searchList = document.getElementById("search-list");

// searchBar.onkeyup = ()=>{
//     let searchTerm = searchBar.value;
//     if(searchTerm != ""){
//         searchBar.classList.add("active");
//     } else{
//         searchBar.classList.remove("active");
//     }
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "home-search.php", true);
// }


$(document).ready(function() {
    $("#search-bar").keyup(function() {
        // var items = $('<div class="people"><p>People</p><div class="search-item"><img src="../img/sample.jpg" width="50px" height="50px"><p>Agent Dude</p></div><div class="search-item"><img src="../img/sample.jpg" width="50px" height="50px"><p>Agent Dude</p></div></div><div class="forum-search"><p>Forum Threads</p><div class="search-item"><p><b>Sample Thread title</b></p></div></div>');
        // $('#search').html(items);
        var searchTerm = document.forms["search-form"]["search-bar"].value;
        if(searchTerm != "") {
            console.log("ajax good");
            $.ajax({
                url: 'search-items.php',
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
            $('#search').html("");s
        }
    });



});





// searchBar.onkeyup = ()=> {
//     let searchTerm = searchBar.value;
//     if(searchTerm != "") {
//         searchList.style.display = "block";
//     } else {
//         searchList.style.display = "none";
//     }
    
// }