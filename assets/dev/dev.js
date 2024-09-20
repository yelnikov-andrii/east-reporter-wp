import '../css/style.css';

// toggle mobile menu
const toggleButton = document.querySelector('.header__toggle');
const headerList = document.querySelector('.header-list');

toggleButton.addEventListener('click', () => {
  headerList.classList.toggle('active');
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
