window.onload= () => {
console.log('test page user');

const inputsearch = document.getElementById("searchbarUser");
const users = document.getElementsByClassName("users");

console.log(inputsearch);
console.log(users);

const mySearchBar = ()=>{
    let valueInput = inputsearch.value;
    console.log(valueInput);

    for (i = 0; i < users.length; i++) {
        if (users[i].innerHTML.toLowerCase().indexOf(valueInput) != -1) {
            users[i].classList.remove("d-none");
            users[i].classList.add("d-block");
        } else {
            users[i].classList.remove("d-block");
            users[i].classList.add("d-none");
        }   
    }
}
inputsearch.addEventListener("change", mySearchBar); 





}