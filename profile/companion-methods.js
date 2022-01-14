// const addBtn = document.getElementById("add-companion"),
//         removeReqBtn = document.getElementById("remove-request");

const form = document.getElementById("add"),
msgBtn = document.getElementById("message"),
remCompanionBtn = document.getElementById("remove-companion"),
addBtn = document.getElementById("add-companion"),
removeReqBtn = document.getElementById("remove-request"),
confirmBtn = document.getElementById("confirm-request");



form.onsubmit = (e)=>{
    e.preventDefault();

}

//Add Companion Request
$(document).ready(function(){
    $("#add-companion").on('click', function() {        
        var user = document.forms["add"]["unique_id"].value;
        var add_user = document.forms["add"]["add_user"].value;
        if(user != "" && add_user != "") {
            
            $.ajax({
                url: "php/add-companion.php",
                type: "POST",
                data: {
                    user: user,
                    add_user: add_user
                },
                cache: false,
                success: function(dataResult){
                    // console.log(user, add_user);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        addBtn.style.display = "none";
                        removeReqBtn.style.display = "inline-block";
                        console.log("success");
                    } else if(dataResult.statusCode==201) {
                        alert("error");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        } else {
            alert("alawz laman");
        }
        
    });
});



//Remove Companion Request
$(document).ready(function(){
    $("#remove-request-confirm").on('click', function() {        
        var user = document.forms["add"]["unique_id"].value;
        var add_user = document.forms["add"]["add_user"].value;
        if(user != "" && add_user != "") {
            
            $.ajax({
                url: "php/remove-request.php",
                type: "POST",
                data: {
                    user: user,
                    add_user: add_user
                },
                cache: false,
                success: function(dataResult){
                    // console.log(user, add_user);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        addBtn.style.display = "inline-block";
                        removeReqBtn.style.display = "none";
                        // console.log("success");
                    } else if(dataResult.statusCode==201) {
                        alert("error");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        } else {
            alert("alawz laman");
        }
        
    });
});

//Confirm Companion Request
$(document).ready(function(){
    $("#confirm-request").on('click', function() {        
        var user = document.forms["add"]["unique_id"].value;
        var add_user = document.forms["add"]["add_user"].value;
        if(user != "" && add_user != "") {
            $.ajax({
                url: "php/confirm-request.php",
                type: "POST",
                data: {
                    user: user,
                    add_user: add_user
                },
                cache: false,
                success: function(dataResult){
                    console.log(user, add_user);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        confirmBtn.style.display = "none";
                        msgBtn.style.display = "inline-block";
                        remCompanionBtn.style.display = "inline-block";
                        alert("You are now friends!");
                        // console.log("success");
                    } else if(dataResult.statusCode==201) {
                        alert("error");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        } else {
            alert("alawz laman");
        }
        
    });
});

//Remove Companion 
$(document).ready(function(){
    $("#remove-companion-confirm").on('click', function() {        
        var user = document.forms["add"]["unique_id"].value;
        var add_user = document.forms["add"]["add_user"].value;
        if(user != "" && add_user != "") {
            
            $.ajax({
                url: "php/remove-companion.php",
                type: "POST",
                data: {
                    user: user,
                    add_user: add_user
                },
                cache: false,
                success: function(dataResult){
                    // console.log(user, add_user);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        msgBtn.style.display = "none";
                        remCompanionBtn.style.display = "none";
                        addBtn.style.display = "inline-block";
                        // console.log("success");
                    } else if(dataResult.statusCode==201) {
                        alert("error");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        } else {
            alert("alawz laman");
        }
        
    });
});