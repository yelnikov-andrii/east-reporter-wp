// swiper top

const swiperEl = document.querySelector('.swiper');

let swiper;

if (swiperEl) {
    swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 16,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },


        breakpoints: {
            1024: {
                direction: 'vertical',
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 32,
                autoHeight: true,
            },
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        watchSlidesVisibility: true, // Отслеживать видимость слайдов
        watchSlidesProgress: true, // Отслеживать прогресс слайдов
    });

    swiper.el.addEventListener('mouseenter', function () {
        swiper.autoplay.stop();
    });

    // Включаем автопрокрутку при уходе мышки с слайдера
    swiper.el.addEventListener('mouseleave', function () {
        swiper.autoplay.start();
    });
}

export default swiper;