"use strict";


settingsModaleOpen();

function settingsModaleOpen() {

    const settingsContainer = document.getElementById('settingsContainer');
    const settingsModal = document.getElementById('settingsModal');

    // _____________________________________________

    if (!settingsContainer) return;

    settingsContainer.addEventListener('click', function(e) {

        let linkClicked = e.target.closest('.settings__group').dataset['settingslink'];
        console.log(linkClicked);


    });

    // _____________________________________________



}