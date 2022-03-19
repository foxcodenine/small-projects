"use strict";

searchTabToggle();

function searchTabToggle () {
    
    const tabs = document.getElementById('search-tabs');
    const clientTab  = document.getElementById('search-client-tab');
    const projectTab = document.getElementById('search-project-tab');

    const clientForm = document.getElementById('serch-query-form-client');
    const projectForm = document.getElementById('serch-query-form-project');

    const clientError = document.getElementById('search-errors-client');
    const projectError = document.getElementById('search-errors-project');
    
    const clientTable = document.getElementById('table-container-client');
    const projectTable = document.getElementById('table-container-project');

    if (!tabs) return;

    // _________________________________________________________________

    

    let params;

    
    if (window.location.search) {
        params = window.location.search;
    }

    let sort, table, direction;

    if (params) {

        [ sort, table, direction] = params.split('&');
    } 

    
    

    if (table === 'sortTable=Project') {

        clientTable.classList.add('search__hidden');        
        clientTab.classList.remove('search__tab--active');
        clientForm.classList.add('search__hidden');
        projectForm.classList.remove('search__hidden');

    } else {

        projectTable.classList.add('search__hidden');
        projectTab.classList.remove('search__tab--active');
        projectForm.classList.add('search__hidden');
        clientForm.classList.remove('search__hidden');
        
    }


    

    // _________________________________________________________________
    

    function removeAvtiveClass () {
        clientTab.classList.remove('search__tab--active');
        projectTab.classList.remove('search__tab--active');
       
    }

    function addHiddenClass() {

        clientForm.classList.add('search__hidden');
        projectForm.classList.add('search__hidden');

        clientError.classList.add('search__hidden');
        projectError.classList.add('search__hidden');

        clientTable.classList.add('search__hidden');
        projectTable.classList.add('search__hidden');
    }


    // _________________________________________________________________

    tabs.addEventListener('click', function (e) {

        let tab = e.target.closest('a');

        
        
        if (!tab)  return;

        removeAvtiveClass ();
        addHiddenClass();


        if (tab.id === 'search-client-tab') {

            clientTab.classList.add('search__tab--active');
            clientForm.classList.remove('search__hidden');
            clientError.classList.remove('search__hidden');

            clientTable.classList.remove('search__hidden');
            


        } else if (tab.id === 'search-project-tab') {

            projectTab.classList.add('search__tab--active');
            projectForm.classList.remove('search__hidden');
            projectError.classList.remove('search__hidden');
            projectTable.classList.remove('search__hidden');

        }       

    });
}


