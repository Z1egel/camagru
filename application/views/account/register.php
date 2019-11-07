<section id="content">
    <a href="/"><img title="Camagru" alt="webcam" src="/public/img/icons/camera.png"></a>
    <div id="signin_form">
        <form name="signin" method="POST" novalidate autocomplete="on">
            <input type="text" name="login" placeholder="Логин" onfocus="this.placeholder=''" onblur="this.placeholder='Логин'" required>
            <input type="email" name="email" placeholder="E-mail" onfocus="this.placeholder=''" onblur="this.placeholder='E-mail'" required>
            <input type="password" name="passwd" placeholder="Пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Пароль'" required>
            <span id="error"></span>
            <button type="submit">Регистрация</button>
        </form>
    </div>
    <div id="options">
        <p><a id="left_link" href="/account/newpass">Забыли пароль?</a> / <a id="" href="/account/login">Вход</a></p>
        <p style="margin-top: 10px;"><a href="/">На главную страницу</a></p>
    </div>
</section>

<script>
    document.getElementById('signin_form').addEventListener("submit", function (e) {
        e.preventDefault();
        signin_ajax(this);
    });
</script>