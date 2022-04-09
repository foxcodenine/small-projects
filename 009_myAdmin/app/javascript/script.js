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
        projectsRemoveFromLink();
        sortTables();
        sortTableAddArrow();
        dashboardDatetime();
        lazyStyles ();

        // -------------------------------------------------------------        
    }
}

//----------------------------------------------------------------------

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

function projectsRemoveFromLink () {
    let projectsRemoveLinks = document.querySelectorAll('.project-remove-link');
    let projectsCheckboxs   = document.querySelectorAll('.project-checkbox');
    let modalQuestion      = document.querySelector('.modal-question-js');



    projectsRemoveLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {

            for( let checkbox of projectsCheckboxs) checkbox.checked = false;
        
            let id = (e.target.closest('a').id).split('-').at(-1);
            let checkbox = document.querySelector('#project-id-checkbox-' + id);
            checkbox.checked = 'on';

            modalQuestion.textContent = 'Are you sure you want to delete this project?';        

            document.querySelector('.modalBtn').click();
            
        });
    });
}


//----------------------------------------------------------------------



function modalToggle () {

    // ----- Elements

    const sidemenu      = document.querySelector('#sidemenu');
    const menubtn       = document.querySelector('.menu-btn');
    const modal         = document.querySelector('.modal');
    const modalBtns     = document.querySelectorAll('.modalBtn');
    const modalContents = document.querySelectorAll('.modal__content');
    const modalCancel   = document.querySelectorAll('.modal__cancel');
    const modalClose    = document.querySelectorAll('.modal__close');
    const closeElements = [...modalCancel, ...modalClose];
    let   modalQuestion = document.querySelector('.modal-question-js');

    if (!modal) return;

    // ----- Inner function to call in EventListeners

    function modalOn() {

        // --- properties to Fade In when displaying modal
        modalContents.forEach((modalContent)=>{ modalContent.style.opacity = 1; });
        modal.style['background-color'] = 'rgba(1,1,1,0.15)'.replace(/[^,]+(?=\))/, '0.15');

        // --- Adjusting z-indexes
        // sidemenu.style['z-index'] = 0;
        // menubtn.style['z-index'] = 0;
        sidemenu.style['pointer-events'] = 'none';  
        menubtn.style['pointer-events'] = 'none';
        
        // --- Displaying Modal
        modal.style.display = 'grid';
    }


    function modalOff() {              
        

        // --- properties to Fade Out before removing modal        
        modalContents.forEach(( modalContent)=>{modalContent.style.opacity = 0; });
        modal.style['background-color'] = 'transparent';

        setTimeout(() => {
            // - Adjusting z-indexes
            sidemenu.style['z-index'] = 1010;
            menubtn.style['z-index'] = 1000; 
            sidemenu.style['pointer-events'] = 'Auto';  
            menubtn.style['pointer-events'] = 'Auto'; 
            // - Removing Modal          
            modal.style.display = 'none';
            if (modalQuestion) {
                modalQuestion.textContent = document.querySelector('.modal-hidden-message-js').textContent;
            }
            
        }, 400);
    }


    // ----- EventListeners

    modalBtns.forEach((btn) => {
        btn.addEventListener('click', function(e) {
            modalOn();
            
            const deleteLink = e.target.getAttribute('deletelink');
            const deleteHref = document.getElementById('modalDeleteLink-js');

            if (deleteLink && deleteHref) {
                deleteHref.href = deleteLink;
            }
        })
    });

    modal.addEventListener('click', (e) => {
        if (closeItem.classList.contains('.doNotCloseJs')) return
        if(! Boolean(e.target.closest(".modal__content"))) {
            modalOff();
        }
    });

    closeElements.forEach( (closeItem) => {
        closeItem.addEventListener('click', modalOff);      
    })
}


//----------------------------------------------------------------------

function sortTables() {
    const tableHeadersAnchers = document.querySelectorAll('.table-sort-js');
    if (tableHeadersAnchers.length < 2) return;


    tableHeadersAnchers.forEach(ancher => {        
        
        ancher.addEventListener('click', (e)=>{
            // e.preventDefault()
      
            let link = ancher.href;


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
    
    let [ sort, table, direction] = params.split('&');
    sort = sort.split('=')[1]
    direction = direction.split('=')[1]

    if (sort === '' || !direction === '') return;

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
    const signPassword = document.querySelector('#sign-password');
    const resetPassword1 = document.querySelector('#reset-password1');
    const resetPassword2 = document.querySelector('#reset-password2');
   
    const passwordFields = [signPassword, resetPassword1, resetPassword2];

    passwordFields.forEach(passwdField => {
        
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
    });
    


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

    
    const tables = document.querySelectorAll('.table__container'); 
    
    if (!tables) return;


    tables.forEach(function(table){
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
            if (! e.target.closest(".table__container")) {
                myMouse.scroll = false;
            }
        });
    })
};

//----------------------------------------------------------------------


function myTippyFunction () {
    tippy('#table-icon-update',    { content: 'Update'});
    tippy('#table-icon-details', { content: 'Details'});
    tippy('#table-icon-remove',  { content: 'Remove'});
    tippy('#table-images',       { content: 'Images'});
}

//----------------------------------------------------------------------


function closeImagesMenu () {

    const images = document.querySelectorAll('.image__frame');
    let openFrame = null;
    let checkBox  = null;

    images.forEach(( img, index, array) => {

        let id = img.id.split('-').at(-1);    
        
        document.addEventListener('click', (e) => {
            const frame = e.target.closest('.image__frame');
            
            if (frame !== null && frame.id === `image-${id}`) {
                if (openFrame !== frame) {
                    if (checkBox) checkBox.checked = false;
                    openFrame = frame;
                    checkBox  = document.getElementById(`image-checkbox-${id}`);  
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

    const myLoaders = document.querySelectorAll('.myLoaderBtn');

    myLoaders.forEach(myLoader => {
        
        if (!myLoader) return;
        
        myLoader.addEventListener('click', ()=>{
            const div_box = document.createElement('div');            
            
            // --- useing spinner animation
            // div_box.innerHTML = '<div id="spinner"></div>';  
            
            // --- useing loding animation
            div_box.innerHTML = `        
            <div class="loading">
            <div class="loading-text">
            <span class="loading-text-words">L</span>
            <span class="loading-text-words">O</span>
            <span class="loading-text-words">A</span>
            <span class="loading-text-words">D</span>
            <span class="loading-text-words">I</span>
            <span class="loading-text-words">N</span>
            <span class="loading-text-words">G</span>
            </div>
            </div>
            `;   
            document.body.prepend(div_box);   
            
            setTimeout(()=>{
                div_box.remove();
            }, 600000);
        });

    });
};


//----------------------------------------------------------------------

function dashboardDatetime() {

    const dateElement = document.querySelector('.dashboardDate-js');

    if (!dateElement) return;

    // _____________________________________

    innerfunction ();

    // _____________________________________

    setInterval(function(){

        innerfunction ();        
    }, 1000*15);

    // _____________________________________

    function innerfunction () {
        const today = new Date();

        let options = { weekday: 'short'};
        const dayOfWeek = new Intl.DateTimeFormat('en-US', options).format(today)

        options = { month: 'short'};
        const month = new Intl.DateTimeFormat('en-US', options).format(today);

        const day = today.getDate();

        let houre = today.getHours();

        let minute = today.getMinutes().toString().padStart(2, '0');        
        minute = minute.toString().padStart(2, '0');

        const meridiem = houre < 12 ? 'AM' : 'PM';
        houre = houre > 12 ? houre - 12 : houre;

        let dateMarkup = `${dayOfWeek}, ${day} ${month} <b>${houre}:${minute}${meridiem}</b>`;

        dateElement.innerHTML = dateMarkup;
    }
    // _____________________________________


    
};



function lazyStyles() {

    let dashfames = document.querySelectorAll('.lazy_dash_js');

    let timer = 100;

    dashfames.forEach(function(famer) {

        famer.style.opacity = 0;
        famer.style.transition = 'opacity 2.5s';

        timer += 200;
        setTimeout(()=>{

            famer.style.opacity = 1;

        }, timer);
    });

    // ______________________________________________

    let imgs = document.querySelectorAll('.lazy_img_js');

    imgs.forEach(function(img) {

        img.style.opacity = 0;
        img.style.transition = 'all 1s';


        // timer += 200;
        setTimeout(()=>{

            img.style.opacity = 1;

        }, 100);

       

    });


}




//----------------------------------------------------------------------


