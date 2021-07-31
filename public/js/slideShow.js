var itemClassName      = "carousel-img",
    imagesContentClass = "img-content",
    carouselDotClass   = 'carousel-dot',
    carouselItem       = document.getElementsByClassName(itemClassName),
    carouselContent    = document.getElementsByClassName(imagesContentClass),
    carouselDots       = document.getElementsByClassName(carouselDotClass),
    next               = document.getElementsByClassName('right-arrow')[0],
    prev               = document.getElementsByClassName('left-arrow')[0],
    totalItems         = carouselItem.length,
    slide              = 0,
    moving             = false;


// function to know if the user is on a mobile device
// replaced with the attribute "@media (pointer: coarse ou fine) {}"
// 
// function isMobile() {
//     if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
//         // true for mobile device
//         let hoverEffect = document.querySelectorAll(".hover");
//         for (let element of hoverEffect) {
//             element.classList.remove("hover");
//         }
//     }
// }

function disableInteraction() {    

    // Set 'moving' to true for the same duration as our transition.
    // (1s = 1000ms)
    
    moving = true;
    // setTimeout runs its function once after the given time
    setTimeout(function(){
        moving = false
    }, 1000);
}

function moveNext() {
    if (!moving) {
        if (slide === (totalItems - 1)) {
            slide = 0;
        } else {
            slide++;
        }
        moveCarouselTo(slide);
    }
}

function movePrev() {
    if (!moving) {
        if (slide === 0) {
            slide = (totalItems - 1);
        } else {
            slide--;
        }
        moveCarouselTo(slide);
    }
}

function moveCarouselTo(slide) {
    let next = slide + 1; 
    let prev = slide - 1;

    disableInteraction();

    if (slide === 0) {
        prev = (totalItems - 1);
    } else if (slide === (totalItems - 1)) {
        next = 0
    }

    // add next and prev class name for items of the carousel
    carouselItem[prev].className = itemClassName + ' prev';
    carouselItem[next].className = itemClassName + ' next';

    // add next and prev class name for the content of the carousel
    carouselContent[prev].className = imagesContentClass + ' prev';
    carouselContent[next].className = imagesContentClass + ' next';

    // reset class name for next and previous dot in the bottom of the carousel
    carouselDots[prev].className = carouselDotClass;
    carouselDots[next].className = carouselDotClass;

    carouselDots[slide].className    = carouselDotClass + ' active-dot';
    carouselItem[slide].className    = itemClassName + ' active';
    carouselContent[slide].className = imagesContentClass + ' active';
}

next.addEventListener('click', moveNext);
prev.addEventListener('click', movePrev);
