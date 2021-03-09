// (A)  Is non-jQuery equivalent of $(document).ready()
//      Ready() to make a function available after the document is loaded


document.onreadystatechange = function () {                    // <- (A)
    if (document.readyState == "interactive") {                // <- (A)
        // Initialize your application or run some code.
        
        passwordDisplayToggle();
        sidebarOpenClose();
        closeUserDropdown();
        wysiwyg();
        sortTable();
        sortTableArrow();
        
    }
}

function sortTable() {
    const tableHeaders = document.querySelectorAll('.clients__item--header');

    // console.log(tableHeaders);

    tableHeaders.forEach(th => {
        
        
        th.addEventListener('click', (e)=>{
            // e.preventDefault()
            let a = th.childNodes[0];  
           
            if (th.childNodes.length >= 2) {

                

                let link = a.getAttribute('href');            
                
                if (link.endsWith('ASC') && window.location.search.endsWith('ASC') ) {
                    link = link.replace('ASC', 'DESC');                              
                } else {
                    link = link.replace('DESC', 'ASC');                
                }
                a.href = link;
            }
        })
    });
}

function sortTableArrow() {
    // i.classList.add('fa-chevron-down');
    // i.classList.add('fa-chevron-up');
    
    let params = '?sort=id&dirc=DESC'
    
    if (window.location.search) {
        params = window.location.search;
    }
    let [sort, dirc] = params.split('&');
    sort = sort.split('=')[1]
    dirc = dirc.split('=')[1]

    element = document.querySelector('.clients__item--header--' + sort)

    if(element) {

    
        if (dirc == 'DESC') {
            element.childNodes[1].classList.add('fa-chevron-down')
        } else {
            element.childNodes[1].classList.add('fa-chevron-up')
        }
    }
    


}

// _____________________________________________________________________
// _____________________________________________________________________
// Editor function 

function wysiwyg() {


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
// Open and Close Sidebar 

function sidebarOpenClose() {

    const sidebar = document.querySelector('#sidebar'); 
    const sidebarBtn = document.querySelector('#sidebar__btn'); 
    const sidebarMenu = document.querySelector('#sidebar__menu'); 



    const allElements = document.documentElement.style
    if(sidebar) {


        sidebar.addEventListener('click', (e)=>{

            if (!e.target.closest('.sidebar__item')) {
            
                sidebarBtn.classList.toggle('fa-angle-double-right');
                sidebarBtn.classList.toggle('fa-angle-double-left');

                sidebarMenu.classList.toggle('sidebar__off')

                const sidebarWidth = allElements.getPropertyValue('--sidebar-width');
                if (sidebarWidth == '22rem') {
                    allElements.setProperty('--sidebar-width', '5rem');
                }else {
                    allElements.setProperty('--sidebar-width', '22rem');
                }
            }
        });
    }
    document.addEventListener('click', (e)=>{
            if (e.target.closest(".main")) {
            sidebarBtn.classList.remove('fa-angle-double-right');
            sidebarBtn.classList.add('fa-angle-double-right');
            sidebarBtn.classList.remove('fa-angle-double-left');


            const sidebarWidth = allElements.getPropertyValue('--sidebar-width');
            if (sidebarWidth == '22rem') {
                allElements.setProperty('--sidebar-width', '5rem');
                sidebarMenu.classList.add('sidebar__off')
            }
        }
    })
}
// _____________________________________________________________________
// Close user dropdown and clicking in main section
function closeUserDropdown() {
    const userDropDown =  document.querySelector('#user-dropdown');

    document.addEventListener('click', (e)=>{
        if (e.target.closest(".main") ||e.target.closest(".sidebar")) {
            userDropDown.checked = true;
        }
    });   
}
// _____________________________________________________________________