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
        wysiwyg();
        formatDateInput();
        scrollTable();
        myTippyFunction();
        closeImagesMenu();

        // -------------------------------------------------------------        
    }
}

////////////////////////////////////////////////////////////////////////

// Declare functions:


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

//----------------------------------------------------------------------

function passwordDisplayToggle () {

    const svgField = document.querySelector('#svg-icon-eye');
    const passwdField = document.querySelector('#sign-password');
    

    if (svgField && passwdField) {    
        const svgIconEye = svgField.childNodes[1];

        svgField.addEventListener('click', ()=>{

            if (passwdField.getAttribute('type') === 'text') {
                passwdField.setAttribute('type', 'password')
                svgIconEye.setAttribute('xlink:href', './app/static/svg/icomoon.svg#icon-eye-slash');

            } else {
                passwdField.setAttribute('type', 'text')
                svgIconEye.setAttribute('xlink:href', './app/static/svg/icomoon.svg#icon-eye');
            }  
        });
    }
}

//----------------------------------------------------------------------


function dropdownmenu1Toggle () {

    const btn = document.querySelector('#topbar-dropdown'); 
    const dropdownmenu = document.querySelector('#dropdownmenu-1'); 

    if ( !btn || !dropdownmenu ) return;
    

    if (btn) {
        
        btn.addEventListener('click', ()=>{
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

    document.addEventListener('keydown', (e) => {        
        if (e.key === 'Escape' && dropdownmenuIsClose) dropdownmenu.classList.add('display_none');
    });
}


//----------------------------------------------------------------------

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

//----------------------------------------------------------------------

function wysiwyg () {

    if (document.querySelector('#editor_body')) {
        // https://ckeditor.com/docs/ckeditor5/latest/builds/guides/integration/configuration.html
        // https://ckeditor.com/docs/ckeditor5/latest/builds/guides/quick-start.html
        ClassicEditor
        .create( document.querySelector( '#editor_body' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic','bulletedList', 'numberedList', 'blockQuote','|','undo', 'redo' ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            }
        } )
        .catch( error => {
            console.log( error );
        } );            
    } 
}

//----------------------------------------------------------------------


function formatDateInput() {

    const dateInput = document.querySelector('.dateFormat');

    if (dateInput) {

        const datepicker = new Datepicker(dateInput, {
            // format : 'dd-mm-yyyy'
            format : 'dd/mm/yyyy'
        });       
     
    } 
}

//----------------------------------------------------------------------

function scrollTable () {

    
    const table = document.querySelector('#table-container');    

    if (!table) return;

    let myMouse = { 'down': 0, 'position' : 0 , 'scroll' : false  };

    // --- When mouse pressed down over the table
    table.addEventListener('mousedown', (e) => {
        myMouse.down = e.clientX;
        myMouse.scroll = true;
    });  

    // --- When mouse is lifted over the table
    table.addEventListener('mouseup', (e) => {
        myMouse.scroll = false;
    }); 

    // --- When mouse is moving inside the table
    table.addEventListener('mousemove', (e) => {
        myMouse.position = e.clientX;

        if (myMouse.scroll) {
            table.scrollLeft = (myMouse.position - myMouse.down) * -1;
        }
    });

    // --- When mouse leave the table
    document.addEventListener('mousemove', (e) => {
        if (! e.target.closest("#table-container")) {
            myMouse.scroll = false;
        }
    });
};

//----------------------------------------------------------------------


function myTippyFunction () {
    tippy('#table-icon-update',    { content: 'Update'});
    tippy('#table-icon-details', { content: 'Details'});
    tippy('#table-icon-remove',  { content: 'Remove'});
    tippy('#table-images',       { content: 'Update images'});
}

//----------------------------------------------------------------------


function closeImagesMenu () {

    const images = document.querySelectorAll('.image__frame');
    let openFrame = null;
    let checkBox  = null;

    images.forEach(( img, index, array) => {
        
        document.addEventListener('click', (e) => {
            const frame = e.target.closest('.image__frame');

            if (frame !== null && frame.id === `image-${index+1}`) {
                if (openFrame !== frame) {
                    if (checkBox) checkBox.checked = false;
                    openFrame = frame;
                    checkBox  = document.getElementById(`image-checkbox-${index+1}`);            
                }
            } else if (frame === null) {
                if (checkBox) checkBox.checked = false;
            }
        });
    });

    document.addEventListener('keydown', (e) => {        
        if (e.key === 'Escape' && checkBox) checkBox.checked = false;
    });
}


