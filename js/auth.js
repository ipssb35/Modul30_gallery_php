/* данные формы */
const authlogin = document.querySelector('#authLogin');
const authPassword = document.querySelector('#authPassword');
const loginForm = document.querySelector('#loginForm');

/* блок для вывода ошибок авторизации / регистрации */
const errors = document.querySelector('.errors');

/* фокус на поля ввода */
const formFocus = () => {
    if (loginForm) {
        if (authPassword.value.trim() === '') {
            authPassword.focus();
            authPassword.value = '';
        }

        if (authlogin.value.trim() === '') {
            authlogin.focus();
            authlogin.value = '';
        }
    }
}

/* fetch запрос авторизации */
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    errors.style.display = 'none';

    const url = 'app/scripts/auth.php';
    const form = new FormData(document.querySelector('#loginForm'));

    fetch(url, {
        method: 'POST',
        body: form,
    })
    .then(response => response.text())
    .then(message => {
        errors.style.display = 'block';
        errors.textContent = message;

        if (message === 'redirect') {
            errors.style.display = 'none';
            window.location.href = '/';
        }
    });

    formFocus();
});

formFocus();