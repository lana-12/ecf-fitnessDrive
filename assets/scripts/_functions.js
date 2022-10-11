// window.onload = function ()
// {

let sidebarBtn = document.querySelector(".sidebar-btn");


sidebarBtn.addEventListener("click", function () {
    console.log(sidebarBtn, wrapper);
    const wrapper = document.querySelector(".wrapper");
    wrapper.classList.toggle("collapse");
    
    
});



// }