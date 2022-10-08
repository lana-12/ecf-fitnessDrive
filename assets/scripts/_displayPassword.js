// ------- Display input Password whith Icon -------

// Selected Icon and inputPassword
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#inputPassword");

//Attach an event listener to the icon to display the input
togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye-slash");
});

