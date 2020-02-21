window.onload = function(){
    changeImageHeight()
};

window.onresize = function (e) {
    changeImageHeight()
};

function changeImageHeight(){
    let images = document.querySelectorAll(".carousel-item img");

    let windowWidth = window.innerWidth;


    if (windowWidth < 1200){
        images.forEach(v =>{
            v.style.height = windowWidth / 1.5 + "px";
        })
    }else{
        images.forEach(v =>{
            v.style.height = 900 + "px";
        })
    }
}
