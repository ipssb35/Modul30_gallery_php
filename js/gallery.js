document.addEventListener('click', e => {
    const classLink = e.target.parentNode.classList;

    /* если у нажатого элемента класс нашей ссылки */
    if (classLink == 'imgLink') {
        e.preventDefault();

        document.querySelector('.delButton__wrapper').textContent = '';
        const id = e.target.parentNode.id;
        const form = new FormData();
        form.append('hiddenId', id);

        /* fetch запрос с ID изображения для вывода комментариев */
        fetch('app/scripts/comments.php', {
            method: 'POST',
            body: form,
        })
        .then(response => response.json())
        .then(message => {
            document.querySelector('.comments').textContent = '';

            message.forEach(value => {
                if (value[0] !== id) return;

                const commentId = value[0];
                const user = value[1];
                const text = value[2];
                const commentDate = value[3];

                let comment = document.createElement('div');
                comment.classList = 'comment';
                comment.id = commentId;
                comment.innerHTML = '<small>' + user +
                    '</small> <br />' + text + '<br />' +
                    '<small>' + commentDate +'</small>';
                document.querySelector('.comments').append(comment);
            });
        });

        /* fetch запрос для добавления кнопки удалить */
        fetch('app/scripts/add_del_button.php', {
            method: 'POST',
            body: form,
        })
        .then(response => response.json())
        .then(message => {
            if (message.length > 0) {
                /* кнопка удаления фото */
                let delBtnImg = document.createElement('div');
                delBtnImg.classList = 'delButtonImage';
                delBtnImg.textContent = 'delete photo';
                document.querySelector('.delButton__wrapper').append(delBtnImg);

                delBtnImg.addEventListener('click', () => {
                    fetch('app/scripts/del_photo.php', {
                        method: 'POST',
                        body: form,
                    })
                    .then(response => response.text())
                    .then((message, e) => {
                        document.querySelector('.success').style.display = 'block';
                        document.querySelector('.success').textContent = message;
                        document.getElementById(id).remove();

                        setTimeout(() => {
                            document.querySelector('.success').style.display = 'none'
                        }, 3000);
                    });
                });

                /* кнопка удаления комментария */

                // аналогия с кнопкой удаления фото....
                // fetch запрос id комментария и поиск по user_id
                // если коммент залогиненного юзера, добавляем кнопку
                // вешаем обработчик удаления по id коммента
            }
        });

        /* ######################################################### */

        /* show, img */
        const showWrapper = document.querySelector('.show__wrapper');
        const showImg = document.querySelector('.showImg');
        const opacity = document.querySelector('.opacity');

        /* показывает всплывающее окно и затемненный фон */
        showWrapper.style.display = 'block';
        opacity.style.display = 'block';

        /* выводим текущее изображение в show */
        showImg.innerHTML = '<img src="' + e.target.src + '" class="sizeImg" />';

        if (document.querySelector('.hidden')) {
            document.querySelector('.hidden').value = id;
        }

        /* размеры рабочей области */
        const scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );

        const scrollWidth = Math.max(
            document.body.scrollWidth, document.documentElement.scrollWidth,
            document.body.offsetWidth, document.documentElement.offsetWidth,
            document.body.clientWidth, document.documentElement.clientWidth
        );

        /* максимальные ширина и высота show */
        showImg.style.maxHeight = document.documentElement.clientHeight - 40 + 'px';
        showWrapper.style.top = '20px';

        /* максимальные ширина и высота затемненного фона */
        opacity.style.width = scrollWidth + 'px';
        opacity.style.height = scrollHeight + 'px';

        /* максимальные ширина и высота изображения */
        const sizeImg = document.querySelector('.sizeImg');
        sizeImg.style.maxWidth = showImg.clientWidth - 6 + 'px';
        sizeImg.style.maxHeight = showImg.clientHeight - 6 + 'px';
    }
});

/* закрываем popup */
const closePopup = () => {
    /* прячем всплывающее окно и затемненный фон */
    document.querySelector('.show__wrapper').style.display = 'none';
    document.querySelector('.opacity').style.display = 'none';
}

document.querySelector('.opacity').addEventListener('click', closePopup);
document.querySelector('.close__wrapper').addEventListener('click', closePopup);

/* добавление коммента */
const commentbtn = document.querySelector('.commentbtn');

if (commentbtn) {
    commentbtn.addEventListener('click', (e) => {
        e.preventDefault();

        const url = 'app/scripts/add_comment.php';
        const form = new FormData(document.querySelector('#commentForm'));

        fetch(url, {
            method: 'POST',
            body: form,
        })
        .then(response => response.json())
        .then(message => {
            document.querySelector('.textarea').value = '';

            const user = message[0];
            const text = message[1];
            const commentDate = message[2];
            const commentId = message[3];

            if (text === '') return;

            let comment = document.createElement('div');
            comment.classList = `comment`;
            comment.id = commentId;
            comment.innerHTML = '<small>' + user +
                '</small> <br />' + text + '<br />' +
                '<small>' + commentDate + '</small>';
            document.querySelector('.comments').append(comment);
        });
    });
}