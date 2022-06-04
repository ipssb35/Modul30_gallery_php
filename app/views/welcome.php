<?php
    session_start();
?>

<div class="opacity"></div>

<!--popup-->
<div class="show__wrapper">
    <div class="close__wrapper">

        <div class="delButton__wrapper"></div>

        <div class="close">
            <div class="closeIcon"></div>
            <div class="closeIcon"></div>
        </div>
    </div>

    <div class="showImg"></div>


    <div class="comment__wrapper">
        <div class="comments"></div>

        <?php if (isset($_SESSION['login'])): ?>
            <div class="addComment">
                <form action="" id="commentForm">
                    <textarea name="comment" class="textarea" placeholder="Ваш коментарий"></textarea> <br/>
                    <input type="hidden" name="hiddenId" class="hidden" value="" />
                    <input type="submit" class="commentbtn" value="Отправить" />
                </form>
            </div>
        <?php endif; ?>
    </div>

</div>

<main class="main">
    <div class="main__wrapper">

        <div class="errors errors__upload"></div>
        <div class="success"></div>

        <?php if (isset($_SESSION['login'])): ?>
            <div class="upload__form">
                <form action="" id="uploadForm">
                    <label for="uploadFile" class="uploadFile"> Загрузить </label>
                    <input type="file" name="files[]" id="uploadFile" multiple />
                </form>
            </div>
        <?php endif; ?>

        <?php
            if (count($data['images']) == 0) echo 'no photos uploaded yet';
            else {
                $images = $data['images'];
                $images = array_reverse($images);

                foreach ($images as $image) {
                    $id = $image['id'];
                    $file = 'uploads/' . $image['file'];
                    $userId = $image['user_id'];

                    echo '
                        <a href="" class="imgLink" id="' . $id . '">
                            <img src="' . $file . '" class="imgGallery" />
                        </a>
                    ';
                }
            }
        ?>

    </div>
</main>

<script src="../js/gallery.js"></script>
<script src="../js/upload.js"></script>