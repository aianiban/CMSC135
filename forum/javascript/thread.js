const comments = document.querySelector(".comments");




setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/thread.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              let data = xhr.response;
                comments.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500);