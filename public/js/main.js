/* Camagru functions */

window.addEventListener('resize', function () {

});

/*function toggleLike(like) {
    if (like.classList.contains('active')) {
        like.classList.remove('active');
        like.innerHTML = parseInt(like.innerHTML) - 1;
    }
    else {
        like.classList.add('active');
        like.innerHTML = parseInt(like.innerHTML) + 1
    }
}*/

function checkLogin(form = '', login)
{
    let error = form.querySelector('span');
    error.onclick = function () {
        error.innerHTML = "";
    };
    if (!login)
    {
        error.innerHTML = "Поле не может быть пустым";
        return false;
    }
    if (login.length < 4) {
        error.innerHTML = "Минимальная длина логина - 4 символа";
        return false;
    }
    if (login.length > 16) {
        error.innerHTML = "Максимальная длина логина - 16 символов";
        return false;
    }
    return true;
}

function checkEmail(form = '', email)
{
    let error = form.querySelector('span');
    error.onclick = function () {
        error.innerHTML = "";
    };
    if (!email)
    {
        error.innerHTML = "Поле не может быть пустым";
        return false;
    }
    let reg = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    if (!reg.test(email)) {
        error.innerHTML = "Указан некорректный e-mail";
        return false;
    }
    return true;
}

function checkPassword(form = '', old_password, new_password)
{
    let error = form.querySelector('span');
    error.onclick = function () {
        error.innerHTML = "";
    };
    if (!old_password || !new_password)
    {
        error.innerHTML = "Поля не могут быть пустыми";
        return false;
    }
    if (old_password === new_password)
    {
        error.innerHTML = "Пароли должны быть разными";
        return false;
    }
    let hasUpperCase = /[A-Z]/.test(new_password);
    let hasLowerCase = /[a-z]/.test(new_password);
    let hasNumbers = /\d/.test(new_password);
    let hasNonalphas = /\W/.test(new_password);
    if (hasUpperCase + hasLowerCase + hasNumbers + hasNonalphas < 3) {
        error.innerHTML = "Пароль должен иметь хотя бы одну заглавную букву (буквы латинские) и одну цифру";
        return false;
    }
    return true;
}

function check_inputs(name, email, passwd)
{
    let error = document.getElementById('signin_form').querySelector('span');

    error.onclick = function () {
        error.innerHTML = "";
    };
    if (!name || !email || !passwd) {
        error.innerHTML = "Поля не могут быть пустыми";
        return false;
    }
    if (name.length < 4) {
        error.innerHTML = "Минимальная длина логина - 4 символа";
        return false;
    }
    if (name.length > 16) {
        error.innerHTML = "Максимальная длина логина - 16 символов";
        return false;
    }
    let reg = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    if (!reg.test(email)) {
        error.innerHTML = "Указан некорректный e-mail";
        return false;
    }
    if (passwd.length < 6) {
        error.innerHTML = "Минимальная длина пароля - 6 символов";
        return false;
    }
    let hasUpperCase = /[A-Z]/.test(passwd);
    let hasLowerCase = /[a-z]/.test(passwd);
    let hasNumbers = /\d/.test(passwd);
    let hasNonalphas = /\W/.test(passwd);
    if (hasUpperCase + hasLowerCase + hasNumbers + hasNonalphas < 3) {
        error.innerHTML = "Пароль должен иметь хотя бы одну заглавную букву (буквы латинские) и одну цифру";
        return false;
    }
    return true;
}

function successMessage(form, message) {
    form.remove();
    let a = document.getElementById("options").firstElementChild;
    a.innerHTML = message;
    a.style.fontSize = "18px";
    a.style.fontWeight = "bold";
}

function create_comment_element(comment) {
    let div = document.createElement('div');
    div.setAttribute('class', 'comment');
    let p1 = document.createElement('p');
    let p2 = document.createElement('p');
    let p3 = document.createElement('p');
    p1.setAttribute('class', 'author');
    p1.innerHTML = comment['login'];
    p2.setAttribute('class', 'date');
    p2.innerHTML = comment['date'];
    p3.setAttribute('class', 'text');
    p3.textContent = comment['comment'];
    div.appendChild(p1);
    div.appendChild(p2);
    div.appendChild(p3);
    return div;
}


function fill_comments(vars) {
    let comments = document.querySelector('div[class=modal_comments]');
    if (vars.length !== 0) {
        vars.forEach(function(comment) {
            let div = create_comment_element(comment);
            comments.appendChild(div);
        });
    }
    else {
        comments.textContent = "Нет комментариев";
    }
}

function addLike_ajax(i) {
    if (i.classList.contains('active')) {
        let photo_id = document.querySelector('img[class=modal_img]').getAttribute('id');
        let xhr = new XMLHttpRequest();
        let body = 'photo_id=' + photo_id;
        xhr.open("POST", '/functions/remove_like.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                i.textContent = parseInt(i.textContent) - 1;
                i.classList.remove('active');
            }
        };
    }
    else {
        let photo_id = document.querySelector('img[class=modal_img]').getAttribute('id');
        let xhr = new XMLHttpRequest();
        let body = 'photo_id=' + photo_id;
        xhr.open("POST", '/functions/add_like.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                i.textContent = parseInt(i.textContent) + 1;
                i.classList.add('active');
            }
        };
    }
}

function prepare_photo(vars, photo_id) {
    let modal = document.querySelector('div[class=modal]');
    modal.style.display = "flex";
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
            let b = modal.getElementsByTagName('textarea')[0];
            if (typeof b !== 'undefined')
                b.value = "";
            let a = modal.querySelector('div[class=modal_comments');
            while (a.firstChild) {
                a.removeChild(a.firstChild);
            }
            modal.querySelector('i').classList.remove('active');
        }
    };
    let data = JSON.parse(vars);
    document.querySelector('img[class=modal_img]').setAttribute('src', data['photo']['url']);
    document.querySelector('img[class=modal_img]').setAttribute('id', photo_id);
    document.querySelector('p[class=author]').innerHTML = "Автор: " + data['photo']['author'];
    modal.querySelector('i').textContent = data['photo']['likes'];
    if (data['photo']['status'] !== null) {
        modal.querySelector('i').classList.add('active');
    }
    fill_comments(data['comments']);
}

function open_photo(photo){
    let id = photo.firstElementChild.getAttribute('id');
    let xhr = new XMLHttpRequest();
    var body = 'photo_id=' + id;
    xhr.open("POST", '/functions/open_photo.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let a = JSON.parse(this.responseText);
            prepare_photo(this.responseText, id);
        }
    };
}

function signin_ajax(form){
    let name = form.querySelector('input[type="text"]').value;
    let email = form.querySelector('input[type="email"]').value;
    let passwd = form.querySelector('input[type="password"]').value;
    if (!check_inputs(name, email, passwd))
        return;
    let xhr = new XMLHttpRequest();
    var body = 'login=' + encodeURIComponent(name) +
        '&email=' + encodeURIComponent(email) + '&passwd=' + encodeURIComponent(passwd);
    xhr.open("POST", '/account/register', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "user_exists") {
                error.innerHTML = "Пользователь с таким именем уже существует";
            }
            else if (this.responseText === "email_exists") {
                error.innerHTML = "Этот e-mail уже использовался для регистрации";
            }
            else if (this.responseText === "OK") {
                let message = "Привет, " + name + "! " + "Чтобы подтвердить регистрацию, перейдите по ссылке в письме, отправленное на указанный e-mail.";
                successMessage(form, message);
                //window.location.replace("/account/login");
            }
        }
    };
}

function addComment_ajax(form){
    let comment = form.querySelector('textarea').value;
    if (comment.length) {
        let photo_id = document.querySelector('img[class=modal_img]').getAttribute('id');
        let xhr = new XMLHttpRequest();
        let body = 'comment=' + encodeURIComponent(comment) + "&photo_id=" + encodeURIComponent(photo_id);
        xhr.open("POST", '/functions/add_comment.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                form.querySelector('textarea').value = "";
                let div = document.createElement('div');
                div.setAttribute('class', 'comment');
                let p1 = document.createElement('p');
                let p2 = document.createElement('p');
                let p3 = document.createElement('p');
                p1.setAttribute('class', 'author');
                p1.textContent = document.querySelector('div[class="menuitem dropdown"]').getElementsByTagName('span')[0].textContent;
                p2.setAttribute('class', 'date');
                p2.textContent = new Date().toISOString().slice(0, 19).replace('T', ' ');
                p3.setAttribute('class', 'text');
                p3.textContent = comment;
                div.appendChild(p1);
                div.appendChild(p2);
                div.appendChild(p3);
                let comments = document.querySelector('div[class=modal_comments');
                if (comments.textContent === "Нет комментариев")
                    comments.textContent = "";
                document.querySelector('div[class=modal_comments').appendChild(div);
            }
        };
    }
    else
        alert("Поле комментария не может быть пустым.")
}

function changeLogin_ajax(form){
    let login = form.querySelector('input[type="text"]').value;
    if (!checkLogin(form, login))
        return;
    let xhr = new XMLHttpRequest();
    var body = 'login=' + encodeURIComponent(login);
    xhr.open("POST", '/functions/login_change.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "LOGIN_EXISTS") {
                error.innerHTML = "Пользователь с таким именем уже существует";
            }
            else {
                document.location.reload();
            }
        }
    };
}

function changeEmail_ajax(form){
    let email = form.querySelector('input[type="email"]').value;
    if (!checkEmail(form, email))
        return;
    let xhr = new XMLHttpRequest();
    var body = 'email=' + encodeURIComponent(email);
    xhr.open("POST", '/functions/email_change.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "EMAIL_EXISTS") {
                error.innerHTML = "Этот e-mail уже использовался для регистрации";
            }
            else {
                document.location.reload();
            }
        }
    };
}

function changePassword_ajax(form){
    let old_password = form.querySelectorAll('input[type="password"]')[0].value;
    let new_password = form.querySelectorAll('input[type="password"]')[1].value;
    if (!checkPassword(form, old_password, new_password))
        return;
    let xhr = new XMLHttpRequest();
    var body = 'new_pass=' + encodeURIComponent(new_password) + '&old_pass=' + encodeURIComponent(old_password);
    xhr.open("POST", '/functions/password_change.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "INVALID_PASSWORD") {
                error.innerHTML = "Введён неверный старый пароль";
            }
            else {
                error.innerHTML = "Пароль изменён";
                form.querySelectorAll('input[type="password"]')[0].value = '';
                form.querySelectorAll('input[type="password"]')[1].value = '';
            }
        }
    }
}

function changeInform_ajax(checkbox){
    let inform = checkbox.checked ? 1 : 0;
    let xhr = new XMLHttpRequest();
    var body = 'inform=' + inform;
    xhr.open("POST", '/functions/inform_change.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
}

function login_ajax(form){
    let name = form.querySelector('input[type="text"]').value;
    let passwd = form.querySelector('input[type="password"]').value;
    /*if (!check_inputs(name, email, passwd))
        return;*/
    let xhr = new XMLHttpRequest();
    var body = 'login=' + encodeURIComponent(name) + '&passwd=' + encodeURIComponent(passwd);
    xhr.open("POST", '/account/login', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "NO") {
                error.innerHTML = "Неправильный логин или пароль";
            }
            else if (this.responseText === "NOT_CNFRM") {
                error.innerHTML = "Неподтверждённая учетная запись";
            }
            else {
                window.location.replace("/");
            }
        }
    };
}

function newpass_ajax(form){
    let name = form.querySelector('input[type="text"]').value;
    /*if (!check_inputs(name, email, passwd))
        return;*/
    let xhr = new XMLHttpRequest();
    var body = 'login=' + encodeURIComponent(name);
    xhr.open("POST", '/account/newpass', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let error = form.querySelector('span');
            if (this.responseText === "NOT_EXIST") {
                error.innerHTML = "Пользователя с таким именем не существует";
            }
            else {
                let message = "Привет, " + name + "! " + "Новый пароль отправлен на твой e-mail.";
                successMessage(form, message);
            }
        }
    };
}

function logout_ajax(form){
    let xhr = new XMLHttpRequest();
    var body = '';
    xhr.open("POST", '/functions/logout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
                window.location.replace("/gallery");
            }
        };
}

function ImageToBase64(image, extension) {
    //let image_cs = getComputedStyle(image);
    let canvas = document.createElement('canvas');
    let context = canvas.getContext('2d');
    let type = 'image/' + extension;
    let dataURL;
    /*canvas.width = parseInt(image_cs.width);
    canvas.height = parseInt(image_cs.height);*/
    canvas.width = image.getBoundingClientRect()['width'];
    canvas.height = image.getBoundingClientRect()['height'];
    /*if (extension !== 'jpeg') {
        let rotate = document.getElementById('rotate').value;
        let scale = document.getElementById('scale').value;
        context.translate(canvas.width/2, canvas.height/2);
        context.rotate(Math.PI / 180 * rotate);
        context.scale(scale, scale);
        context.translate(-canvas.width/2, -canvas.height/2);
    }*/
    context.drawImage(image, 0, 0, canvas.width, canvas.height);
    dataURL = canvas.toDataURL(type);
    dataURL = dataURL.replace(/^data:image\/(png|jpeg|jpg);base64,/, '');
    return dataURL;
}

function makePhoto_ajax(){
    let image;
    if (document.querySelector('div[class="tab one active"]')) {
        image = document.getElementById('videoElement');
    }
    else {
        image = document.getElementsByClassName('custom_bg')[0].getElementsByTagName('img')[0];
    }
    if (image) {
        let sticker = document.getElementById('active_sticker');
        let left = parseInt(sticker.style.left);
        let top = parseInt(sticker.style.top);
        let image_data = ImageToBase64(image, 'jpeg');
        let sticker_data = ImageToBase64(sticker, 'png');
        let xhr = new XMLHttpRequest();
        let body = 'image=' + encodeURIComponent(image_data) + '&sticker=' + encodeURIComponent(sticker_data) + '&left=' + left
            + '&top=' + top;
        xhr.open("POST", '/functions/photo_make.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(body);
        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                refreshUserPhoto(JSON.parse(this.responseText));
            }
        };
    }
}

function deletePhoto_ajax(elem) {
    let url = elem.parentElement.firstElementChild.getAttribute('src');
    let xhr = new XMLHttpRequest();
    let body = 'url=' + url;
    xhr.open("POST", '/functions/photo_delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            elem.parentElement.remove();
        }
    };
}

function uploadImage(input) {
    if (input.files && input.files[0]) {
        let img = document.createElement('img');
        img.src = URL.createObjectURL(input.files[0]);
        img.setAttribute('width', '100%');
        img.setAttribute('height', '100%');
        input.parentElement.parentElement.append(img);
        input.parentElement.remove();
        if (document.getElementsByClassName('one')[0].style.pointerEvents == "none") {
            document.getElementsByClassName('custom_bg')[0].style.position = "relative";
            document.getElementsByClassName('webcam_bg')[0].style.display = "none";
        }
    }
}

function createPhotoNode() {
    let photocard = document.createElement('div');
    let first_img = document.createElement('img');
    let second_img = document.createElement('img');
    second_img.className = 'delete';
    second_img.setAttribute('alt', 'Удалить фотографию');
    second_img.setAttribute('title', 'Удалить фотографию');
    second_img.setAttribute('src', '/public/img/icons/delete.png');
    second_img.addEventListener('click', function () {
        deletePhoto_ajax(this);
    });
    photocard.className = 'photocard mb-10 mr-20';
    photocard.appendChild(second_img);
    return {'0':first_img, '1':photocard};
}

function refreshUserPhoto(urls) {
    let params = createPhotoNode();
    let img = params[0];
    let photo = params[1];
    let wrap = document.getElementsByClassName('photocards')[0];
    img.setAttribute('src', urls['thumb_url']);
    photo.insertBefore(img, photo.firstChild);
    if (wrap.hasChildNodes())
        wrap.prepend(photo);
    else
        wrap.append(photo);
}

function centerPosition(innerElem, outerElem) {
    let outer_cs = getComputedStyle(outerElem);
    let inner_cs = getComputedStyle(innerElem);
    innerElem.style.left = parseInt(outer_cs.width) / 2 - parseInt(inner_cs.width) / 2 + "px";
    innerElem.style.top = parseInt(outer_cs.height) / 2 - parseInt(inner_cs.height) / 2 + "px";
}

function setCarouselWidth() {
    let stick = document.getElementsByClassName('carousel_wrapper')[0];
    let width = getComputedStyle(stick).width;
    stick.style.maxWidth = (parseInt(width) - parseInt(width) % 200) + "px";
}

function getWidth(elem) {
    return parseInt(getComputedStyle(document.getElementsByClassName(elem)[0]).width);
}

function addStickerClickEvent() {
    let stickers = document.getElementsByClassName('sticker');
    let img = document.getElementById('active_sticker');
    let button = document.getElementById('makePhoto');
    for (let i = 0; i < stickers.length; i++)
    {
        stickers[i].addEventListener("click", function () {
            img.setAttribute('src', this.querySelector('img').getAttribute('src'));
            if (!img.hasAttribute('title'))
                img.setAttribute('title','Зажми левую кнопку мыши и двигай меня');
            let webcam = document.getElementsByClassName("background")[0];
            centerPosition(img, webcam);
            button.removeAttribute('disabled');
            for (let i = 0; i < stickers.length; i++) {
                stickers[i].classList.remove('active');
            }
            this.classList.add('active');
        });
    }
}

function addArrowsClickEvents() {
    let rightArrow = document.getElementsByClassName('slider_arrow_right')[0];
    let leftArrow = document.getElementsByClassName('slider_arrow_left')[0];

    let slider = document.getElementsByClassName('carousel')[0];
    let cs = getComputedStyle(slider);
    let matrix = new WebKitCSSMatrix(cs.transform);
    let step = 200;
    let stickersWidth = getWidth('stickers');
    let carouselWidth = getWidth('carousel');
    let limit = carouselWidth - (stickersWidth - 80);

    rightArrow.addEventListener('click', function () {
        if (matrix.m41 > -limit) {
            slider.style.transform = "translate(" + Math.round(matrix.m41 - step) + "px)";
            matrix.m41 -= 200;
        }
    });

    leftArrow.addEventListener("click", function() {
        if (matrix.m41 < 0) {
            slider.style.transform = "translate(" + Math.round(matrix.m41 + step) + "px)";
            matrix.m41 += 200;
        }
    });
}

function makeWebImageMovable() {
    let btn = document.getElementById('makePhoto');
    let img = document.getElementById('active_sticker');
    let scroll = {
        left: function(e) {
            return e.clientX + document.body.scrollLeft;
        },
        top: function(e) {
            return e.clientY + document.body.scrollTop;
        }
    };
    let x, y, drag;

    img.onmousedown = function(e){
        this.style.cursor = "move";
        x = scroll.left(e) - parseInt(this.style.left);
        y = scroll.top(e) - parseInt(this.style.top);
        drag = 1;
        btn.setAttribute("disabled", "on");
    };

    img.onmouseup = function() {
        this.style.cursor = "pointer";
        drag = 0;
        btn.removeAttribute("disabled");
    };

    document.onmousemove = function(e) {
        if (drag) {
            img.style.left = scroll.left(e) - x + "px";
            img.style.top = scroll.top(e) - y + "px";
        }
    };

    img.ondragstart = function() {
        return false;
    };
}