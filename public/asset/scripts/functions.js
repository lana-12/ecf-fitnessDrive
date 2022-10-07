

// Function dispalyPassword
const togglePassword = () =>{
    const passwordInput = document.querySelector('#inputPassword')
    passwordInput.type = passwordInput.type === 'text' ? 'password' : 'text'
    const eyeIcon = document.querySelector('#eye')
    eyeIcon.classList.contains('d-none') ? eyeIcon.classList.remove('d-none') : eyeIcon.classList.add('d-none')
    const eyeSlashIcone = document.querySelector('#eye-slash')
    eyeSlashIcone.classList.contains('d-none') ? eyeSlashIcone.classList.remove('d-none') : eyeSlashIcone.classList.add('d-none')
}

alert('hello')
console.log('test function');
console.log('test function');
let franchises= document.querySelectorAll('partner');
console.log(franchises)
// function display Active/Inactive
window.onload =function myFunction() {
    // Get the checkbox
    let checkBox = document.getElementById("switchCheck");
    // Get the output text
    let text = document.getElementById("switchText");
    // If the checkbox is checked, display the output text
    
    if (checkBox.checked == 1){
        // text.style.display = "block";
        text.innerText = "Active"
    } else {
        // text.style.display = "block";
        text.innerText = "InActive"
    }
}
