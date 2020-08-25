window.document.addEventListener('scroll', ()=>{
    const {scrollTop} = document.documentElement;
    console.log(scrollTop);

    if (scrollTop > 50) {
        // "navigation--background"
        document.getElementById('navbar-1').classList.add('navigation--background')
    }
});

window.document.addEventListener('scroll', ()=>{
    const {scrollTop} = document.documentElement;


    if (scrollTop <= 50) {
        // "navigation--background"
        document.getElementById('navbar-1').classList.remove('navigation--background')
    }
});

// _____________________________________________________________________

const slider = document.querySelector('.card2__scroll');

let isDown = false;
let startX;
let scrollLeft;




slider.addEventListener('mousedown', (e) => {

    event.preventDefault();

    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');

});

slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');

});

slider.addEventListener('mousemove', (e) => {

    event.preventDefault();
    if(!isDown) return;
    

    const x = e.pageX - slider.offsetLeft;
    

    const walk = x - startX;

    console.log({x, startX, walk, isDown});

    slider.scrollLeft = (scrollLeft - walk) * 1;
});
