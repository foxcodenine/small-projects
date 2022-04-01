"use strict";


settingsModaleOpen();

function settingsModaleOpen() {

    const settingsContainer     = document.getElementById('settingsContainer');
    const settingsModal         = document.getElementById('settingsModal');
    const settingsModalContenters  = document.querySelectorAll('.modal__content');

    // _____________________________________________

    if (!settingsContainer) return;

    settingsContainer.addEventListener('click', function(e) {

        let linkClicked = e.target.closest('.settings__group').dataset['settingslink'];
        console.log(linkClicked);

        resetModalContenter ();
        setSelectedModalContener (linkClicked);

    });



    // _____________________________________________

    function resetModalContenter () {
        settingsModalContenters.forEach(container => {
            container.style.display = 'none';
        });
    }

    function setSelectedModalContener ($selected) {
        settingsModalContenters.forEach(container => {
           
            if (container.dataset.modalsettings === $selected) {
                container.style.display = 'flex'
            };
        });
    }

}