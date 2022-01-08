const searchBtn = document.getElementById("show-search"),
    searchBar = document.getElementById("search-bar"),
    searchList = document.getElementById("search-list");

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    } else{
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "home-search.php", true);
}

// searchBar.onkeyup = ()=> {
//     let searchTerm = searchBar.value;
//     if(searchTerm != "") {
//         searchList.style.display = "block";
//     } else {
//         searchList.style.display = "none";
//     }
    
// }