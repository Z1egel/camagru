<section class="container">
    <aside>
        <div class="user_photo">
            <div class="photocards">
                <?php foreach ($photos as $photo) {?>
                    <div class="photocard mb-10 mr-20">
                        <img src="<?php echo $photo["thumb_url"]; ?>">
                        <img class="delete" src="/public/img/icons/delete.png" onclick="deletePhoto_ajax(this)" alt="Delete photo" title="Удалить фотографию">
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
    <main>
        <div class="editor ml-20 mt-20">
            <div class="image">
                <div class="tabs">
                    <div class="tab one active"><span>Изображение с камеры</span></div>
                    <div class="tab two"><span>Загрузить изображение</span></div>
                </div>
                <div class="background">
                    <div class="webcam_bg">
                        <video autoplay="autoplay" id="videoElement"></video>
                    </div>
                    <div class="custom_bg">
                        <form method="POST" name="file_form" enctype="multipart/form-data">
                            <label for="file">Выберите картиночку.</label>
                            <input type="file" id="file" name="file" accept="image/jpeg">
                        </form>
                    </div>
                    <img id="active_sticker" src="">
                </div>
                <form name="makephoto" method="POST">
                    <button id="makePhoto" type="submit" style="background-color: black" disabled>Сделать фото</button>
                </form>
            </div>
            <!--<div class="tools">
                <h3>Настройки</h3>
                <div class="settings">
                    <label>Поворот <input type="number" style="color: black;" id="rotate"></label>
                    <label>Размер <input type="number" min="0.1" max="2" value="1" step="0.01" style="color: black;" id="scale"></label>
                </div>
            </div>-->
        </div>
        <div class="stickers ml-20 mr-20">
            <span>Выбор категории: </span>
            <select style="background-color: black" size="1" name="hero[]">
                <option selected value="common">Разное</option>
                <option value="animals">Животные</option>
                <option value="games">Игры</option>
                <option value="memes">Мемы</option>
            </select>
            <div class="slider_wrapper">
                <div class="slider_arrow_left"></div>
                <div class="carousel_wrapper">
                    <div class="carousel">
                        <?php foreach ($stickers as $sticker) { if ($sticker['category'] === "common") {?>
                            <div class="sticker">
                                <img src="<?php echo baseStickerURL().$sticker['url']; ?>">
                            </div>
                        <?php }}?>
                    </div>
                </div>
                <div class="slider_arrow_right"></div>
            </div>
        </div>
    </main>

</section>
<script>

    document.querySelector('input[type=file]').addEventListener("change", function () {
        uploadImage(this);
    });

    document.getElementsByName('makephoto')[0].addEventListener("submit", function (e) {
        e.preventDefault();
        makePhoto_ajax();
    });

    document.addEventListener("DOMContentLoaded", function () {

        /*let main = document.getElementsByClassName('container')[0];
        let header_height = parseInt(getComputedStyle(document.getElementsByTagName('header')[0]).height);
        let footer_height = parseInt(getComputedStyle(document.getElementsByTagName('footer')[0]).height);
        main.style.height = document.documentElement.clientHeight - header_height - footer_height + "px";*/

        let video = document.getElementById("videoElement");

        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: {width: {min: 1280}, height: {min: 720}} })
                .then(function (stream) {
                    video.srcObject = stream;
                })
                .catch(function (e) {
                    let a = document.getElementsByClassName('tab one')[0];
                    a.classList.remove('active');
                    a.style.pointerEvents = "none";
                    document.getElementsByClassName('tab two')[0].classList.add('active');
                    document.getElementsByClassName('custom_bg')[0].style.zIndex = '1';
                });
        }

        let a = document.getElementsByClassName('background')[0];
        a = a.getElementsByTagName('div');
        let b = document.getElementsByClassName('tab');
        for (let i = 0; i < b.length; i++)
        {
            b[i].onclick = function () {
                setTabActive(a, b, i);
            };
        }

        function setTabActive(images, tabs, index) {
            if (!tabs[index].classList.contains('active')) {
                tabs[index].classList.add('active');
                a[index].style.zIndex = "1";
                if (!index) {
                    tabs[index + 1].classList.remove('active');
                    a[index + 1].style.zIndex = "-1";
                }
                else {
                    tabs[index - 1].classList.remove('active');
                    a[index - 1].style.zIndex = "-1";
                }
            }
        }

        addStickerClickEvent();
        setCarouselWidth();
        addArrowsClickEvents();
        makeWebImageMovable();

        /*let rotate = document.getElementById('rotate');
        let img = document.getElementById('active_sticker');
        rotate.oninput = function () {
            img.style.transform = "rotate(" + rotate.value + "deg)";
        };

        let scale = document.getElementById('scale');
        scale.oninput = function () {
            img.style.transform = "scale(" + scale.value + ")";
        };*/

        var categories = document.querySelector('select');
        categories.addEventListener("change", function () {
            let carousel = document.getElementsByClassName('carousel')[0];
            carousel.innerHTML = "";
            <?php foreach ($stickers as $sticker) {?>
                if ('<?php echo $sticker['category'];?>' == this.value)
                {
                    let div = document.createElement('div');
                    div.setAttribute('class', 'sticker');
                    let img = document.createElement('img');
                    img.setAttribute('src', '<?php echo baseStickerURL().$sticker['url'];?>');
                    div.appendChild(img);
                    carousel.appendChild(div);
                    carousel.style.transform = "translate(0px)";
                }
            <?php } ?>
            addStickerClickEvent();
            /*addArrowsClickEvents();*/
        });

    });
</script>