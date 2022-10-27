window.onload= () => {

const inputsearchUser = document.getElementById("searchbarUser");
const users = document.getElementsByClassName("user");

// function barsearch
const mySearchBar = ()=>{
    let valueInput = inputsearchUser.value;

    for (i = 0; i < users.length; i++) {
        if (users[i].innerHTML.toLowerCase().indexOf(valueInput) != -1) {
            users[i].classList.remove("d-none");
        } else {
            users[i].classList.add("d-none");
        }   
    }
}
inputsearchUser.addEventListener("change", mySearchBar); 

}