window.onload = () => {
    
const inputsearchPerm = document.getElementById("searchbarPerm");
const perms = document.getElementsByClassName("perm");

// function barsearch
const mySearchBarPerm = () => {
    let valueInput = inputsearchPerm.value;

    for (i = 0; i < perms.length; i++) {
        if (perms[i].innerHTML.toLowerCase().indexOf(valueInput) != -1) {
            perms[i].classList.remove("d-none");
        } else {
            perms[i].classList.add("d-none");
        }
    }

}

inputsearchPerm.addEventListener("change", mySearchBarPerm);
};
