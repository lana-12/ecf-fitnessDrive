// alert('display')
// Function dispalyPassword
// NE MARCHE PAS 0 REVOIR
const passwordInput = document.querySelector('#inputPassword')
const eyeIcon = document.querySelector('#eye')
const eyeSlashIcone = document.querySelector('#eye-slash')

function togglePassword(){
    passwordInput.type = passwordInput.type === 'text' ? 'password' : 'text'
    eyeIcon.classList.contains('d-none') ? eyeIcon.classList.remove('d-none') : eyeIcon.classList.add('d-none')  
    eyeSlashIcone.classList.contains('d-none') ? eyeSlashIcone.classList.remove('d-none') : eyeSlashIcone.classList.add('d-none');
}

// passwordInput.addEventListener('click', togglePassword());


