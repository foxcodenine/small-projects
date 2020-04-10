






var testFunction = function(){
    console.log('this work to')
}




var openImage = function(event) {
    var img =  {src: event.target.src ,  id: event.target.id};
    
    if (img.id === '$$$') {

        document.getElementById('image_model').style.display = 'inline-block'
        document.getElementById('image_display').src = img.src
        
        console.log(img.src)
    }
}


var closeImage = function(event) {

    closeBtn = event.target.id
    if (closeBtn === 'imageCloseBtn') {
        document.getElementById('image_model').style.display = 'none';
    }
}




var controler = (function() {    
    console.log('Hello Javascript')

    document.addEventListener('click', openImage);
    document.addEventListener('click', closeImage);


})();