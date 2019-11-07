<section class="pt-30" id="content" >
    <div id="form">
        <form name="login" method="POST" novalidate autocomplete="on">
            <input type="text" name="login" value="<?php if (isset($_SESSION['login'])) echo $_SESSION['login'] ?>">
            <span id="error"></span>
            <button type="submit">Изменить логин</button>
        </form>
        <form name="email" method="POST" novalidate autocomplete="on">
            <input type="email" name="email" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email'] ?>">
            <span id="error"></span>
            <button type="submit">Изменить e-mail</button>
        </form>
        <form name="password" method="POST" novalidate autocomplete="on">
            <input type="password" name="passwd1" placeholder="Старый пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Пароль'" required>
            <input type="password" name="passwd2" placeholder="Новый пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Пароль'" required>
            <span id="error"></span>
            <button type="submit">Изменить пароль</button>
        </form>
        <input type="checkbox" id="inform" name="inform" <?php if (isset($_SESSION['inform']) && $_SESSION['inform'] == 1) echo "checked"?>><p style="display: inline"> Уведомления о новых комментариях</p>
    </div>
</section>

<script>
    document.querySelector('form[name=login]').addEventListener("submit", function (e) {
        e.preventDefault();
        changeLogin_ajax(this);
    });

    document.querySelector('form[name=email]').addEventListener("submit", function (e) {
        e.preventDefault();
        changeEmail_ajax(this);
    });

    document.querySelector('form[name=password]').addEventListener("submit", function (e) {
        e.preventDefault();
        changePassword_ajax(this);
    });
    document.querySelector('input[type=checkbox]').addEventListener("change", function (e) {
        changeInform_ajax(this);
    });
</script>