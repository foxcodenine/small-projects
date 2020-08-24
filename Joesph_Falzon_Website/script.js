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
    console.log(scrollTop);

    if (scrollTop <= 50) {
        // "navigation--background"
        document.getElementById('navbar-1').classList.remove('navigation--background')
    }
});