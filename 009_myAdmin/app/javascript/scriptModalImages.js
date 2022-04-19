"use strict";

// _____________________________________________________________________

modalImages ();

// _____________________________________________________________________

function modalImages () {
    const sidemenu     = document.querySelector('#sidemenu');
    const menubtn      = document.querySelector('.menu-btn');

    const containerModal  = document.querySelector('.images__form-js');
    const imageModal      = document.querySelector('.img-modal');
    if (!containerModal) return;

    const leftBtnModal    = document.querySelector('.img-modal__left');
    const rightBtnModal   = document.querySelector('.img-modal__right');

    const rootCss        = document.querySelector(':root');
    const containerDotes = document.querySelector('.img-modal__dotes');
    const dotes          = document.querySelectorAll('.img-modal__dote');
    
    let previousImageIndex;
    let currentImageIndex;
    let lastImageIndex  = document.querySelector('.last-modal-img-index').dataset.imgindexjs - 1;
    let modalState      = 'Close'  ;

    
    
    
    // ----- Functions -------------------------

    function modalOn() {
        sidemenu.style['z-index'] = 0;
        menubtn.style['z-index'] = 0;
        
        rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());
        activateDote();
        
        imageModal.style.display = 'grid';
        modalState = 'Open';

        setTimeout (function(){ imageModal.style.opacity = 1; }, 50);
    }

    // -------------------

    function modalOff() {
        imageModal.style.opacity = 0;
        modalState = 'Close';

        setTimeout (function(){ 
            sidemenu.style['z-index'] = 101;
            menubtn.style['z-index'] = 100;
            imageModal.style.display = 'none';
         }, 500);
    }

    // -------------------

    function changeSliderTransitionTime() {
        // change slider transition time
        let numberOfSlidesToSlides = Math.abs(Number(currentImageIndex) - Number(previousImageIndex));

        if (!numberOfSlidesToSlides) numberOfSlidesToSlides = 1;

        let seconds;

        switch (true) {
            case numberOfSlidesToSlides <= 3:
                seconds = 0.4;
                break;
            case numberOfSlidesToSlides <= 6:
                seconds = 0.25;
                break;
            case numberOfSlidesToSlides >  6:
                seconds = 0.15;
                break;
        }
        
        
        let sliderTransitionTime = (numberOfSlidesToSlides * seconds)
        rootCss.style.setProperty('--modal-image-slider-transition', `${sliderTransitionTime}s`); 

        // reset to original time
        setTimeout (function() {
            rootCss.style.setProperty('--modal-image-slider-transition', '.4s');
        }, (sliderTransitionTime * 1000) + 100);  
    }

    function activateDote() {
        dotes.forEach(dote => {               
            dote.style.setProperty('fill', 'rgba(255, 255, 255, 0.5)'); 
        });
  
        let currentDote = document.querySelector(`.img-modal__dote--${currentImageIndex}`)
        currentDote.style.setProperty('fill', 'rgba(231, 76, 60, 0.5)');
    }



    // -------------------

    function moveSliderBy () {
        const imageElement = document.querySelector('.img-modal__pic');
        const imageWidth = parseInt(getComputedStyle(imageElement).width);

        if (currentImageIndex > lastImageIndex) {
            previousImageIndex = Number(currentImageIndex);
            currentImageIndex = 0
        };
        if (currentImageIndex < 0) {
            previousImageIndex = Number(currentImageIndex);
            currentImageIndex = lastImageIndex;
        };
        changeSliderTransitionTime();
        activateDote();
        return (currentImageIndex * imageWidth * -1) + 'px';        
    }

    // -------------------



    // ----- Event Listeners -------------------

    const closeModalEventListener = imageModal.addEventListener('click', function(e) {
        
        if (e.target.closest('.img-modal__pic')) return;
        if (e.target.closest('.img-modal__dotes')) return;
        if (e.target.closest('.img-modal__left')) return;
        if (e.target.closest('.img-modal__right')) return;

        modalOff()
    });

    // -------------------

    const openModalEventListener = containerModal.addEventListener('click', function(e) {
        // e.preventDefault();

        currentImageIndex = e.target.dataset.imgindexjs;
        
        if (e.target.closest('.image__img')) {
            modalOn();
        } 
    });

    // -------------------

    const btnPressEventListener = window.addEventListener('keydown', function(e) {
        // e.preventDefault();

        // if (modalState !== 'Open') return;

        switch (e.key) {

            case 'Escape':
                modalOff();
                break;

            case 'ArrowLeft':
                previousImageIndex = Number(currentImageIndex);
                --currentImageIndex;
                rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());

                break;
            case 'ArrowRight':
                previousImageIndex = Number(currentImageIndex);
                ++currentImageIndex;
                rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());
                break;                
        }
    });

    // -------------------

    for (let btn of [ leftBtnModal, rightBtnModal]) {

        btn.addEventListener('click', function(e) {

            const imageElement = document.querySelector('.img-modal__pic');
            // const imageWidth = parseInt(getComputedStyle(imageElement).width);

            
            if (e.target.closest('.img-modal__left')) {
                // console.log('left');
                previousImageIndex = Number(currentImageIndex);
                --currentImageIndex;
                rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());
                

            }

            if (e.target.closest('.img-modal__right')) {
                // console.log('right');
                previousImageIndex = Number(currentImageIndex);
                ++currentImageIndex;
                rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());
            }
        });
    }

    containerDotes.addEventListener('click', function(e){
        const dote = e.target.closest('.img-modal__dote');
        if (dote) {
            previousImageIndex = Number(currentImageIndex);
            currentImageIndex = dote.dataset.doteindexjs;            
            rootCss.style.setProperty('--modal-image-slide-by', moveSliderBy());
        }
    });
}