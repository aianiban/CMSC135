const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorTxt = form.querySelector(".error-text");
form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "index/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "dashboard/home.php";
                } else{
                    errorTxt.textContent = data;
                    errorTxt.style.display = "block";
                }
                
            }
        }
    }
    //sending form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData);
    // xhr.send();
}