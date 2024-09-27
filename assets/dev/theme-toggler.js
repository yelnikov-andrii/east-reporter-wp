// Theme toggler


export const themeToggleButton = document.querySelector('#theme-toggle'); // Кнопка для переключения темы
let currentTheme = getCookie('theme') || 'dark'; // Получаем сохранённую тему или задаем тему по умолчанию

// Функция для получения куки
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Устанавливаем тему при загрузке страницы
if (currentTheme === 'light') {
    document.body.classList.add('light-theme');
}

// Переключение темы
themeToggleButton.addEventListener('click', () => {
    if (currentTheme === 'light') {
        document.body.classList.remove('light-theme');
        currentTheme = 'dark'; // Обновляем переменную после переключения
    } else {
        document.body.classList.add('light-theme');
        currentTheme = 'light'; // Обновляем переменную после переключения
    }

    // Сохраняем новую тему в куки
    document.cookie = `theme=${currentTheme}; path=/; max-age=${24 * 60 * 60}`;
});