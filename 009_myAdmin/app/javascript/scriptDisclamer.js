"use strict";

// _____________________________________________________________________

disclamer();

// _____________________________________________________________________

function disclamer() {

    
    let contents = document.querySelectorAll('.sign__transition');
    let close_btns = document.querySelectorAll('.sign--close');
    let close_dis_btns = document.querySelectorAll('.sign__disclaimer--close');

    contents.forEach(function(item){
        
        item.style.transition = 'all .5s ease';
        
        setTimeout(function() {
            item.style.opacity =  1;
        } , 200);
        
    })

    close_btns.forEach(function(item){
        
        item.addEventListener("click", function(e) {

            e.preventDefault();
            
            contents.forEach(function(d){
                
                d.style.transition = 'all .5s ease';
                d.style.opacity =  0;
            })
            
            setTimeout(function() {            
                let href = e.target.closest('a').href;            
                window.location.href = href;
            } , 200);
        });
    });
}