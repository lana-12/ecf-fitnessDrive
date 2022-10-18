window.onload= () => {
console.log('test');

const inputsearch = document.getElementById("searchbar");
const partners = document.getElementsByClassName('partner'); // array tte les cards


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

    // partners.forEach(partner => { //-1 qui existe pas ds array ou <=0
    // });
    // console.log(valueInput);
};
//puisque function => mettre apres
inputsearch.addEventListener("change", mySearch); // pas de () sinon cela l'appelle ici


}