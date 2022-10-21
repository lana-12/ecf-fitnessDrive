window.onload= () => {
console.log('test');

// Init constance

    //BarSearch
const inputsearch = document.getElementById("searchbar");
const partners = document.getElementsByClassName('partner'); 

    //Recup partner Actif/inactif
const active = document.getElementsByClassName("partner-active");
// const all = document.getElementsByClassName("partner-all");
const inActive = document.getElementsByClassName("partner-inActive");

    //btn all/active/inactive
const btnAll = document.getElementById("all");
const btnActive = document.getElementById("active");
const btnInActive = document.getElementById("inactive");


// function barsearch
const mySearch = () => {
    let valueInput = inputsearch.value;
        for( i=0; i< partners.length; i++) {
                if (partners[i].innerHTML.toLowerCase().indexOf(valueInput) != -1) {
                    partners[i].classList.remove("d-none");
                    partners[i].classList.add("d-flex");
                } else {
                    partners[i].classList.remove("d-flex");
                    partners[i].classList.add("d-none");
                }
        }
};
inputsearch.addEventListener("change", mySearch); 



//functions display on click

function displayAll(){
    for (i = 0; i < partners.length; i++) {
        partners[i].classList.remove("d-none");
        partners[i].classList.add("d-flex");
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
}

function displayInActive(){
    Array.from(inActive).forEach((element) => {
        element.classList.remove("d-none");
    });
    Array.from(active).forEach(element=>{
        element.classList.add('d-none');
    });
    btnActive.classList.remove("active");
    btnInActive.classList.add("active");
}


btnAll.addEventListener('click', displayAll);
btnActive.addEventListener('click', displayActive);
btnInActive.addEventListener('click', displayInActive);

}