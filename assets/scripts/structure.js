window.onload = () => {

// Init constance

    //BarSearch
const inputsearchStructure = document.getElementById("searchbarStructure");
const structures = document.getElementsByClassName("structure");

    //Recup structure Actif/inactif
const active = document.getElementsByClassName("structure-active");
// const all = document.getElementsByClassName("structure-all");
const inActive = document.getElementsByClassName("structure-inActive");

    //btn all/active/inactive
const btnAll = document.getElementById("all-structure");
const btnActive = document.getElementById("active-structure");
const btnInActive = document.getElementById("inactive-structure");


// function barsearch
const mySearchBarStructure = () => {
    let valueInput = inputsearchStructure.value;

    for (i = 0; i < structures.length; i++) {
        if (structures[i].innerHTML.toLowerCase().indexOf(valueInput) != -1) {
            structures[i].classList.remove("d-none");
        } else {
            structures[i].classList.add("d-none");
        }
    }
};

inputsearchStructure.addEventListener("change", mySearchBarStructure);


//functions display on click
function displayAll(){
    for (i = 0; i < structures.length; i++) {
        structures[i].classList.remove("d-none");
        // structures[i].classList.add("d-flex");
    }
    btnActive.classList.remove("active");
    btnInActive.classList.remove("active");
    btnAll.classList.add("active");

}

function displayActive(){
    Array.from(active).forEach(element =>{
        element.classList.remove('d-none');
    });
    Array.from(inActive).forEach(element=>{
        element.classList.add('d-none');
    });
    btnAll.classList.remove('active');
    btnActive.classList.add('active');
    btnInActive.classList.remove("active");

    
}

function displayInActive(){
    Array.from(inActive).forEach((element) => {
        element.classList.remove("d-none");
    });
    Array.from(active).forEach(element=>{
        element.classList.add('d-none');
    });
    btnActive.classList.remove("active");
    btnAll.classList.remove('active');
    btnInActive.classList.add("active");
}

btnAll.addEventListener('click', displayAll);
btnActive.addEventListener('click', displayActive);
btnInActive.addEventListener('click', displayInActive);

};
