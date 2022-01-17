const forumList = document.querySelector(".forum-list"),
addThreadBtn = document.querySelector(".top-bar button");
http_request = new XMLHttpRequest();

$(document).ready(function() {
    $('#add-new-thread-btn').on('click', function() {
        var newThreadTitle = document.forms["new-thread-form"]["new-thread-title"].value;
        var newThreadBody = document.forms["new-thread-form"]["new-thread-body"].value;
        if(newThreadTitle != "" && newThreadBody != "") {
            $.ajax({
                url: "php/add-new-thread.php",
                type: "POST",
                data: {
                    newThreadTitle: newThreadTitle,
                    newThreadBody: newThreadBody,
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode == 200) {
                        console.log("pumasok naman");
                        document.forms["new-thread-form"]["new-thread-title"].value = "";
                        document.forms["new-thread-form"]["new-thread-body"].value = "";
                    } else {
                        alert("Error in json");
                    }
                }

            });
        } else {
            alert("alang laman");
        }

        
    });

});




setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/forum-home.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              let data = xhr.response;
                forumList.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500);