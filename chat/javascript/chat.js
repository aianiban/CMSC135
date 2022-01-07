const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();

}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    //sending form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData);
}

document.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

// document.onmouseleave = ()=>{
//     chatBox.classList.remove("active");
// }

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}


setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              let data = xhr.response;
              chatBox.innerHTML = data;   
              if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
  }, 500);

  function scrollToBottom(){
      chatBox.scrollTop = chatBox.scrollHeight;
  }