// (A)  Is non-jQuery equivalent of `$(document).ready()`
//      `$(document).ready()` to make a function available after the document is loaded

document.onreadystatechange = function () {                    // <- (A)
    if (document.readyState == "interactive") {                // <- (A)
               
        // -------------------------------------------------------------
        // Calling functions:
      
        // toastrFunction();
        passwordDisplayToggle();
        dropdownmenu1Toggle();
        sideMenuToggle();



        // -------------------------------------------------------------        
    }
}

////////////////////////////////////////////////////////////////////////

// Declare functions:


function passwordDisplayToggle() {

    const svgField = document.querySelector('#svg-icon-eye');
    const passwdField = document.querySelector('#sign-password');
    

    if (svgField && passwdField) {    
        const svgIconEye = svgField.childNodes[1];

        svgField.addEventListener('click', ()=>{

            if (passwdField.getAttribute('type') === 'text') {
                passwdField.setAttribute('type', 'password')
                svgIconEye.setAttribute('xlink:href', '../static/svg/icomoon.svg#icon-eye-slash');

            } else {
                passwdField.setAttribute('type', 'text')
                svgIconEye.setAttribute('xlink:href', '../static/svg/icomoon.svg#icon-eye');
            }  
        });
    }
}







//----------------------------------------------------------------------

// function toastrFunction() {
//     toastr.options.closeMethod = 'fadeOut';
//     toastr.options.closeDuration = 500;
//     toastr.options.closeEasing = 'swing';


//     let emailMessage = Cookies.get('icemalta_php_lesson_11_email');

//     if (emailMessage && emailMessage !== 'null') {
            

//         toastr.info(emailMessage);
//         Cookies.set('icemalta_php_lesson_11_email', 'null', { expires: 1 }); 

      
        
//     } 
// }

function dropdownmenu1Toggle() {

    const btn = document.querySelector('#topbar-dropdown'); 
    const dropdownmenu = document.querySelector('#dropdownmenu-1'); 
    

    if (btn) {
        
        btn.addEventListener('click', ()=>{
            console.log('clicked');

            dropdownmenu.classList.toggle('display_none');
        });
    }

    const dropdownmenuIsClose = dropdownmenu.classList.contains('display_none');

    document.addEventListener('click', (e)=>{
        if (! e.target.closest("#dropdownmenu-1") && 
            ! e.target.closest("#topbar-dropdown") && 
            dropdownmenuIsClose ) {

            dropdownmenu.classList.add('display_none');            
        }
    }); 
}

function sideMenuToggle () {

    const menuBtn  = document.querySelector('#menu-btn'); 
    const sidemenu = document.querySelector('#sidemenu');
    
    if (menuBtn && sidemenu) {
        menuBtn.addEventListener('click',  ()=>{
            sidemenu.style.transform = 'translateX(0)';
        } );
    }

    document.addEventListener('click', (e)=>{
        if (! e.target.closest("#sidemenu") && 
            ! e.target.closest("#menu-btn") &&
            window.innerWidth <= 800
            ) {

            sidemenu.style.transform = 'translateX(-100%)';             
        }
    }); 
    
}
