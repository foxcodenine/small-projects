"use strict";


// (A)  Is non-jQuery equivalent of `$(document).ready()`
//      `$(document).ready()` to make a function available after the document is loaded

document.onreadystatechange = function () {                    // <- (A)
    if (document.readyState == "interactive") {                // <- (A)
               
        // -------------------------------------------------------------
        // Calling functions:
      
        // toastrFunction();
        // mySwupFunction();
        
        passwordDisplayToggle();
        dropdownmenu1Toggle();
        sideMenuToggle();
        wysiwyg();
        formatDateInput();
        scrollTable();
        myTippyFunction();
        closeImagesMenu();
        myLoaderBtn(); 
        modalToggle();
        clientsRemoveFromLink();
        sortTables();
        sortTableAddArrow();


        // -------------------------------------------------------------        
    }
}

function clientsRemoveFromLink () {
    let clientsRemoveLinks = document.querySelectorAll('.client-remove-link');
    let clientsCheckboxs   = document.querySelectorAll('.client-checkbox');
    let modalQuestion      = document.querySelector('.modal-question-js');

    clientsRemoveLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {

            for( let checkbox of clientsCheckboxs) checkbox.checked = false;
        
            let id = (e.target.closest('a').id).split('-').at(-1);
            let checkbox = document.querySelector('#client-id-checkbox-' + id);
            checkbox.checked = 'on';

            modalQuestion.textContent = 'Are you sure you want to delete this Client?';        

            document.querySelector('.modalBtn').click();
            
        });
    });
}

//----------------------------------------------------------------------

function sortTables() {
    const tableHeadersAnchers = document.querySelectorAll('.table-sort-js');
    if (tableHeadersAnchers.length < 2) return;


    tableHeadersAnchers.forEach(ancher => {        
        
        ancher.addEventListener('click', (e)=>{
            // e.preventDefault()
      
            let link = ancher.href;

            console.log(link)

            if (link.endsWith('ASC') && window.location.search.endsWith('ASC') ) {
                link = link.replace('ASC', 'DESC');  
                                            
            } else {
                link = link.replace('DESC', 'ASC');                
            }
            ancher.href = link;              

        })
    });
}


function sortTableAddArrow() {
    
    let params;
    
    if (window.location.search) {
        params = window.location.search;
    }

    if (!params) return;
    
    let [sort, direction] = params.split('&');
    sort = sort.split('=')[1]
    direction = direction.split('=')[1]

    let element = document.querySelector(`#${sort}`)


    if(element) {
    
        if (direction == 'DESC') {
            element.innerHTML = element.textContent + ' &utrif;';

        } else {
            element.innerHTML = element.textContent + ' &dtrif;';
        }
    }
}


//----------------------------------------------------------------------

function modalToggle () {

    // ----- Elements

    const sidemenu     = document.querySelector('#sidemenu');
    const menubtn      = document.querySelector('.menu-btn');
    const modal        = document.querySelector('.modal');
    const modalBtns    = document.querySelectorAll('.modalBtn');
    const modalContent = document.querySelector('.modal__content');
    const modalCancel = document.querySelector('.modal__cancel');
    const modalClose = document.querySelector('.modal__close');
    const closeElements = [modalCancel, modalClose];
    let modalQuestion      = document.querySelector('.modal-question-js');

    if (!modal) return;

    // ----- Inner function to call in EventListeners

    function modalOn() {

        // --- properties to Fade In when displaying modal
        modalContent.style.opacity = 1;
        modal.style['background-color'] = 'rgba(1,1,1,0.15)'.replace(/[^,]+(?=\))/, '0.15');

        // --- Adjusting z-indexes
        sidemenu.style['z-index'] = 0;
        menubtn.style['z-index'] = 0;
        
        // --- Displaying Modal
        modal.style.display = 'grid';
    }


    function modalOff() {              
        

        // --- properties to Fade Out before removing modal
        modalContent.style.opacity = 0;
        modal.style['background-color'] = 'transparent';

        setTimeout(() => {
            // - Adjusting z-indexes
            sidemenu.style['z-index'] = 101;
            menubtn.style['z-index'] = 100;  
            // - Removing Modal          
            modal.style.display = 'none';
            modalQuestion.textContent = 'Are you sure you want to delete these Clients?';
        }, 400);
    }


    // ----- EventListeners

    modalBtns.forEach((btn) => {
        btn.addEventListener('click', function() {
            modalOn();
        })
    });

    modal.addEventListener('click', (e) => {
        if(! Boolean(e.target.closest(".modal__content"))) {
            modalOff();
        }
    });

    closeElements.forEach( (closeItem) => {
        closeItem.addEventListener('click', modalOff);
    })
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

    // useing ckeditor4
    if (document.querySelector('#editor_body')) {        
        CKEDITOR.replace( 'editor_body' );
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

    let scrollCurrentPosition;

    // --- When mouse pressed down over the table
    table.addEventListener('mousedown', (e) => {
        myMouse.down = e.clientX;
        myMouse.scroll = true;
        scrollCurrentPosition = table.scrollLeft;

    });  

    // --- When mouse is lifted over the table
    table.addEventListener('mouseup', (e) => {
        myMouse.scroll = false;
    }); 

    // --- When mouse is moving inside the table
    table.addEventListener('mousemove', (e) => {
        myMouse.position = e.clientX;

        if (myMouse.scroll) {            
            table.scrollLeft = scrollCurrentPosition + (myMouse.position - myMouse.down) * -1;            
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

//----------------------------------------------------------------------

// Interfiring with other scripts -- achiving same effect with sass

// function mySwupFunction() {
//     if (!document.querySelector('.transition-fade')) return;
    
//     const swup = new Swup(
//         {animationSelector: '[class*="transition-"]'}
//     );
// }

//----------------------------------------------------------------------

function myLoaderBtn() {

    const myLoader = document.querySelector('.myLoaderBtn');

    if (!myLoader) return;

    myLoader.addEventListener('click', ()=>{
        const div_box = document.createElement('div');


        div_box.innerHTML = '<div id="spinner"></div>';   
        document.body.prepend(div_box);   
    
        setTimeout(()=>{
            div_box.remove();
        }, 10000);
    });
};


//----------------------------------------------------------------------


