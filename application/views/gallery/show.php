<section id="main">
    <main class="full-width">
        <div class="gallery">
            <?php foreach ($photos as $photo) {?>
                <div class="photocard nonselectable" onclick="open_photo(this)">
                    <img id="<?php echo $photo['photo_id']; ?>" src="<?php echo $photo["thumb_url"]; ?>">
                    <div class="info">
                        <i class="fas fa-thumbs-up"><?php echo $photo['likes']; ?></i>
                        <i class="fas fa-comment-alt"><?php echo $photo['comments']; ?></i>
                        <i class="fas fa-share">0</i>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</section>
<div class="modal">
    <div class="modal_content">
        <div class="modal_photo">
            <img class="modal_img" src="">
            <p class="author" style="margin-top: 5px; font-style:italic; align-self: center;"></p>
            <i class="fas fa-thumbs-up" style="align-self: center;"<?php if (isset($_SESSION['login'])) { ?> onclick="addLike_ajax(this)"<?php } ?>></i>
            <form name="comment_form" style="margin-top:auto;">
                <?php if (isset($_SESSION['login'])) { ?>
                    <textarea style="resize: none; height: 50px; width: 100%; color: black;" maxlength="300" placeholder="Максимальная длина комментария - 300 знаков" onfocus="this.placeholder='';"></textarea>
                    <button type="submit" style="color:black;">Оставить комментарий</button>
                <?php } else { ?><p style="margin-bottom: 5%; width: 100%; text-align: center;">Войдите в учетную запись, чтобы оставить комментарий.</p><?php }; ?>
            </form>
        </div>
        <div class="modal_comments">
            <!--<div class="comment">
                <p class="author"></p>
                <p class="date"></p>
                <p class="text"></p>
            </div>-->
        </div>
        <!--<span class="close">&times;</span>-->
    </div>
</div>

<script>

    document.querySelector('form').addEventListener("submit", function (e) {
        e.preventDefault();
        addComment_ajax(this);
    });

    window.addEventListener('scroll', function() {
        if (document.documentElement.scrollTop + document.documentElement.clientHeight >= document.documentElement.scrollHeight) {
            pagination_ajax();
        }
    });

    function pagination_show(values) {
        values = JSON.parse(values);
        let photo = document.getElementsByClassName('photocard')[0];
        let gallery = document.querySelector('div[class=gallery]');
        let angle;
        for (const [key, value] of Object.entries(values)) {
            let div = document.createElement('div');
            div = photo.cloneNode(true);
            div.firstElementChild.setAttribute('id', value['photo_id']);
            div.firstElementChild.setAttribute('src', value['thumb_url']);
            div.querySelector("i[class='fas fa-thumbs-up']").textContent = value['likes'];
            div.querySelector("i[class='fas fa-comment-alt']").textContent = value['comments'];
            angle = Math.random() * (10 + 10) - 10;
            div.style.transform = "rotate(" + angle + "deg)";
            div.addEventListener("mouseover", function () {
                this.style.transform = "rotate(0deg) scale(1.1)";
                this.style.zIndex = "1";
            });
            div.addEventListener("mouseout", function () {
                this.style.transform = "rotate(" + angle + "deg)";
                this.style.zIndex = "";
            });
            gallery.appendChild(div);
        }
    }

    function pagination_ajax() {
        let id = document.querySelector('div[class=gallery]').lastElementChild.firstElementChild.getAttribute('id');
        let xhr = new XMLHttpRequest();
        let body = 'id=' + encodeURIComponent(id);
        xhr.open("POST", '/functions/gallery_expand.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                pagination_show(this.responseText)
            }
        };
    }

    document.addEventListener("DOMContentLoaded", function () {
        var img = document.getElementsByClassName('photocard');
        var angle = [];
        for (let i = 0; i < img.length; i++) {
            angle[i] = Math.random() * (10 + 10) - 10;
            img[i].style.transform = "rotate(" + angle[i] + "deg)";
            img[i].addEventListener("mouseover", function () {
                this.style.transform = "rotate(0deg) scale(1.1)";
                this.style.zIndex = "1";
            });
            img[i].addEventListener("mouseout", function () {
                this.style.transform = "rotate(" + angle[i] + "deg)";
                this.style.zIndex = "";
            });
        }
    });

    /*window.addEventListener('click', function () {
        let id = document.getElementsByClassName('photocard');
        id = id[id.length - 1];
        id = id.querySelector('img').getAttribute('id');

        let xhr = new XMLHttpRequest();
        let body = 'id=' + id;
        xhr.open("POST", '/gallery/show', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            }
        };
    })*/
</script>