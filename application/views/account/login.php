<section id="content">
    <a href="/"><img title="Camagru" alt="webcam" src="/public/img/icons/camera.png"></a>
    <div id="login_form">
        <form method="POST" name="login" autocomplete="off" novalidate>
            <input type="text" name="login" placeholder="Логин" onfocus="this.placeholder=''" onblur="this.placeholder='Логин'" required>
            <input type="password" name="passwd" placeholder="Пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Пароль'" required>
            <span id="error"></span>
            <button type="submit">Вход</button>
        </form>
    </div>
    <div id="options">
        <p><a id="left_link" href="/account/newpass">Забыли пароль?</a> / <a id="" href="/account/register">Регистрация</a></p>
        <p style="margin-top: 10px;"><a href="/">На главную страницу</a></p>
    </div>
</section>

<script>
    document.getElementById('login_form').addEventListener("submit", function (e) {
        e.preventDefault();
        login_ajax(this);
    });
</script>