

let swiperNewsOne,
    swiperNewsTwo,
    swiperNewsThree;

const swiperOneRef = document.querySelector('.swiper-news-1');
const swiperTwoRef = document.querySelector('.swiper-news-2');
const swiperThreeRef = document.querySelector('.swiper-news-3');

if (swiperOneRef) {
    const swiperNewsOne = new Swiper('.swiper-news-1', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 16,
        simulateTouch: true,

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },


        breakpoints: {
            1240: {
                slidesPerGroup: 3,
                slidesPerView: 3,
                spaceBetween: 32,
            },
            768: {
                slidesPerGroup: 2,
                slidesPerView: 2,
                spaceBetween: 32,
            },
        },
    });

    swiperNewsOne.el.addEventListener('mouseenter', function () {
        swiperNewsOne.autoplay.stop();
    });

    // Включаем автопрокрутку при уходе мышки с слайдера
    swiperNewsOne.el.addEventListener('mouseleave', function () {
        swiperNewsOne.autoplay.start();
    });
}

if (swiperTwoRef) {
    swiperNewsTwo = new Swiper('.swiper-news-2', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        simulateTouch: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },


        breakpoints: {
            1240: {
                slidesPerGroup: 3,
                slidesPerView: 3,
                spaceBetween: 32,
            },
            768: {
                slidesPerGroup: 2,
                slidesPerView: 2,
                spaceBetween: 32,
            },
        },
    });

    swiperNewsTwo.el.addEventListener('mouseenter', function () {
        swiperNewsTwo.autoplay.stop();
    });

    // Включаем автопрокрутку при уходе мышки с слайдера
    swiperNewsTwo.el.addEventListener('mouseleave', function () {
        swiperNewsTwo.autoplay.start();
    });
}

if (swiperThreeRef) {
    swiperNewsThree = new Swiper('.swiper-news-3', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        simulateTouch: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    
    
        breakpoints: {
            1240: {
                slidesPerGroup: 3,
                slidesPerView: 3,
                spaceBetween: 32,
            },
            768: {
                slidesPerGroup: 2,
                slidesPerView: 2,
                spaceBetween: 32,
            },
        },
    
        navigation: {
            nextEl: '.swiper-news-3-button-next',
            prevEl: '.swiper-news-3-button-prev',
        },
    });
    
    swiperNewsThree.el.addEventListener('mouseenter', function () {
        swiperNewsThree.autoplay.stop();
    });
    
    // Включаем автопрокрутку при уходе мышки с слайдера
    swiperNewsThree.el.addEventListener('mouseleave', function () {
        swiperNewsThree.autoplay.start();
    });
}

export {
    swiperNewsOne,
    swiperNewsThree,
    swiperNewsTwo
}