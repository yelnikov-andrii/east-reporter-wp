
// toggle mobile menu
const toggleButton = document.querySelector('.header__toggle');
const headerList = document.querySelector('.header-list');
const headerWrapper = document.querySelector('.header__wrapper-list');

toggleButton.addEventListener('click', () => {
    headerList.classList.toggle('active');
    headerWrapper.classList.toggle('active');
    toggleButton.classList.toggle('active');
});

// header list svg plus icon to open a dropdown

const svgPlusArr = document.querySelectorAll('.header-list__svg');

for (let i = 0; i < svgPlusArr.length; i++) {
    svgPlusArr[i].addEventListener('click', () => {

        const listItem = svgPlusArr[i].closest('.header-list__item');
        listItem.classList.toggle('active');
        const dropdownEl = listItem.querySelector('.dropdown');
        dropdownEl.classList.toggle('active');
    })
}

// AOS

AOS.init();

// scroll top button

const scrollTopBtn = document.querySelector('.button-scrolltop');
let lastScrollY = window.scrollY;

window.addEventListener('scroll', function() {
    scrollFunction();
});

function scrollFunction() {
    const currentScrollY = window.scrollY; // Текущая позиция скролла

    if (currentScrollY > 1000 && lastScrollY > currentScrollY) {
        // Если скролл больше 300px и мы скроллим вверх
        scrollTopBtn.classList.add("visible");
    } else {
        // Если скроллим вниз или меньше 300px
        scrollTopBtn.classList.remove("visible");
    }

    // Обновляем последнее значение скролла
    lastScrollY = currentScrollY;
}

scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    scrollTopBtn.classList.remove('visible')
});

// Adjust min height of main section

document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const footer = document.querySelector('footer');
    const main = document.querySelector('main');

    const headerHeight = header.offsetHeight;
    const footerHeight = footer.offsetHeight;

    const totalHeight = window.innerHeight - headerHeight - footerHeight;

    main.style.minHeight = `${totalHeight}px`;
});
