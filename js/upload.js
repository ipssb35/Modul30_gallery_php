/* кнопка загрузки изображения */
const uploadFile = document.querySelector('#uploadFile');
/* блок для вывода ошибок и успеха */
const errors = document.querySelector('.errors');
const success = document.querySelector('.success');

if (uploadFile) {
    uploadFile.addEventListener('change', () => {
        const files = uploadFile.files;
        const url = 'app/scripts/upload.php';
        const formData = new FormData();
        errors.style.display = 'none';

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(message => {
            errors.style.display = 'block';
            errors.innerHTML = message;

            if (message == '') {
                errors.style.display = 'none';
                success.style.display = 'block';
                success.textContent = 'photo uploaded successfully';

                setTimeout(() => success.style.display = 'none', 3000);
            }
        });
    });
}