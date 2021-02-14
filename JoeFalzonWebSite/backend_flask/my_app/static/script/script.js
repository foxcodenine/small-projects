
passwordDisplayToggle();


// _____________________________________________________________________

// Password Display Toggle 
function passwordDisplayToggle() {

    const toggle_password = document.querySelector('#toggle-password');
    const password_field = document.querySelector('#password-field');

    toggle_password.addEventListener('click', ()=>{
        toggle_password.classList.toggle('fa-eye')
        toggle_password.classList.toggle('fa-eye-slash')

        if (password_field.getAttribute('type') === 'text') {
            password_field.setAttribute('type', 'password')
        } else {
            password_field.setAttribute('type', 'text')
        }  
    });
}

// _____________________________________________________________________