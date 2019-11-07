<section id="content">
    <a href="/"><img title="Camagru" alt="webcam" src="/public/img/icons/camera.png"></a>
    <div id="passwd_form">
        <form name="parol" autocomplete="off" novalidate>
            <input type="text" name="login" placeholder="Логин" onfocus="this.placeholder=''" onblur="this.placeholder='Логин'" minlength="4" required>
            <span id="error"></span>
            <button type="submit">Сбросить пароль</button>
        </form>
    </div>
    <div id="options">
        <p><a id="left_link" href="/account/login">Вход</a> / <a id="right_link" href="/account/register">Регистрация</a></p>
        <p style="margin-top: 10px;"><a href="/">На главную страницу</a></p>
    </div>
</section>

<script>
    document.getElementById('passwd_form').addEventListener("submit", function (e) {
        e.preventDefault();
        newpass_ajax(this);
    });
</script>