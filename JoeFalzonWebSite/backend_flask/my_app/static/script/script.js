
passwordDisplayToggle();


// _____________________________________________________________________
// Password Display Toggle 

function passwordDisplayToggle() {

    const toggle_password = document.querySelector('#toggle-password');
    const password_field = document.querySelector('#password-field');

    if (toggle_password && password_field) {

    

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
}

// _____________________________________________________________________
// Password Display Toggle

const sidebar = document.querySelector('#sidebar'); 
const sidebarBtn = document.querySelector('#sidebar__btn'); 
const sidebarMenu = document.querySelector('#sidebar__menu'); 



const allElements = document.documentElement.style

sidebar.addEventListener('click', (e)=>{

    if (!e.target.closest('.sidebar__item')) {

    
        sidebarBtn.classList.toggle('fa-angle-double-right');
        sidebarBtn.classList.toggle('fa-angle-double-left');

        sidebarMenu.classList.toggle('sidebar__off')


        const sidebarWidth = allElements.getPropertyValue('--sidebar-width');
        if (sidebarWidth == '20rem') {
            allElements.setProperty('--sidebar-width', '5rem');
        }else {
            allElements.setProperty('--sidebar-width', '20rem');
        }
    }
});

document.addEventListener('click', (e)=>{
        if (e.target.closest(".main")) {
        sidebarBtn.classList.remove('fa-angle-double-right');
        sidebarBtn.classList.add('fa-angle-double-right');
        sidebarBtn.classList.remove('fa-angle-double-left');


        const sidebarWidth = allElements.getPropertyValue('--sidebar-width');
        if (sidebarWidth == '20rem') {
            allElements.setProperty('--sidebar-width', '5rem');
            sidebarMenu.classList.add('sidebar__off')
        }
    }
})

// _____________________________________________________________________