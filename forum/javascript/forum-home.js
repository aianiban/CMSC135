const forumList = document.querySelector(".forum-list"),
addThreadBtn = document.querySelector(".top-bar button");




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