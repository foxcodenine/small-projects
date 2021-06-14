// import smoothscroll from 'smoothscroll-polyfill'

// smoothscroll.polyfill();
// window.__forceSmoothScrollPolyfill__ = true;

// _____________________________________________________________________


window.document.addEventListener('scroll', ()=>{
    const {scrollTop} = document.documentElement;
    // console.log(scrollTop);

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

    // console.log({x, startX, walk, isDown});

    slider.scrollLeft = (scrollLeft - walk) * 1;
});


// _____________________________________________________________________

const btnNext = document.querySelector('.arrow__next-btn');

btnNext.addEventListener('click', (e)=>{



    console.log(slider.scrollLeft + slider.clientWidth);

    console.log(slider.clientWidth);
    console.log(slider.scrollLeft);


    slider.scroll({
        top: 0,
        left: slider.scrollLeft + slider.clientWidth + 50 ,
        behavior: 'smooth'
      });

});

const btnPrev = document.querySelector('.arrow__prev-btn');

btnPrev.addEventListener('click', (e)=>{

    const rowWidth = document.querySelector('.arrow')

    console.log(slider.clientWidth - slider.scrollLeft)
    console.log(slider.clientWidth);
    console.log(slider.scrollLeft);
    
    slider.scrollTo({
        top: 0,
        left: (slider.clientWidth - slider.scrollLeft + 50 ) * -1,
        behavior: 'smooth'
      });

});

// _____________________________________________________________________

// Initialize and add the map

// api_key = 'AIzaSyAfXrmWPKvCXAArFY95A85i1OibkPIRDyk';
// google.maps.Map(mapDiv[,opts])
// google.maps.Marker([opts])

// Chris2021BillAccount

function initMap() {
    // The location of Uluru
    let uluru = {lat: 35.899, lng: 14.485};
    // The map, centered at Uluru
    let map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: uluru});
    // The marker, positioned at Uluru
    let marker = new google.maps.Marker({position: uluru, map: map});
  }


// _____________________________________________________________________



// API_key_Joe_Falzon_Website
api_key = 'AIzaSyAfXrmWPKvCXAAr4FY95A85i1OibkPIR22Dyk';

Chris2021BillAccount
