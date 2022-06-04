/* данные формы */
const registerLogin = document.querySelector('#registerLogin');
const registerPassword = document.querySelector('#registerPassword');
const registerConfirmPassword = document.querySelector('#registerConfirmPassword');
const registerForm = document.querySelector('#registerForm');

/* блок для вывода ошибок авторизации / регистрации */
const errors = document.querySelector('.errors');

/* фокус на поля ввода */
const formFocus = () => {
    if (registerForm) {
        if (registerConfirmPassword.value.trim() === '') {
            registerConfirmPassword.focus();
            registerConfirmPassword.value = '';
        }

        if (registerPassword.value.trim() === '') {
            registerPassword.focus();
            registerPassword.value = '';
        }

        if (registerLogin.value.trim() === '') {
            registerLogin.focus();
            registerLogin.value = '';
        }
    }
}

/* fetch запрос регистрации */
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    errors.style.display = 'none';

    const url = 'app/scripts/register.php';
    const form = new FormData(document.querySelector('#registerForm'));

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
            window.location.href = '/login';
        }
    });

    formFocus();
});

formFocus();