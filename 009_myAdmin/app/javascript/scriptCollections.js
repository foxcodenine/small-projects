"use strict";

// _____________________________________________________________________

collectionPageForm();
collentionPageList();

// _____________________________________________________________________

function collentionPageList() {
    const page = document.getElementById('sectionCollection');
    if (!page) return;

    const collectionList = document.querySelector('.group__list');

    collectionList.addEventListener('click', function(e) {
        
        if(e.target.closest('.group__item')){
            const collectionId = e.target.closest('.group__item').dataset.collectionitem;

            const collectionDelete = document.getElementById(`collectionDelete${collectionId}`);
            const collectionRename = document.getElementById(`collectionRename${collectionId}`);

            collectionDelete.selected = true;
            collectionRename.selected = true;
        }
    });

    
}


function collectionPageForm() {

    const page = document.getElementById('sectionCollection');
    if (!page) return;

    const submitBtns = document.querySelectorAll('.modalBtn');
    const modalSubmitBtn = document.querySelector('#modalSubmitBtn');

    const field1 = document.getElementById('modalField-1-js');
    const field2 = document.getElementById('modalField-2-js');     


    const modalForm = document.getElementById('modalForm');
   

    for (let btn of submitBtns) {

        btn.addEventListener('click', function(e) {
            const action = e.target.value;

            const inputDelete  = document.getElementById('collection-select-delete-js');
            const inputReplace = document.getElementById('collection-select-replace-js'); 

            const inputRename1 = document.getElementById('collection-select-rename1-js');
            const inputRename2 = document.getElementById('collection-select-rename2-js');

            const title = document.querySelector('.modal-title-js');
            const question = document.querySelector('.modal-question-js');
            const collectionType = document.querySelector('.modal-hidden-message-js').textContent;


            title.textContent = action + '  Confermation';
            question.textContent = `Are you sure you want to ${action} this ${collectionType}?`

            switch (action) {
                case 'delete':
                    field1.setAttribute('value', inputDelete.value)
                    field1.setAttribute('name',  inputDelete.name)
                    field2.setAttribute('value', inputReplace.value)
                    field2.setAttribute('name',  inputReplace.name)
                    
                    
                    break;

                case 'rename':
                    field1.setAttribute('value', inputRename1.value)
                    field1.setAttribute('name',  inputRename1.name)
                    field2.setAttribute('value', inputRename2.value)
                    field2.setAttribute('name',  inputRename2.name)

                    break;
            }

            modalSubmitBtn.value = action;
        })            
    }
}
