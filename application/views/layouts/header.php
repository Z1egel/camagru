<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="/public/css/main.css?v1.12">
        <link rel="stylesheet" href="/public/css/media.css?v1.13">
        <link rel="icon" type="image/png" href="/public/img/icons/favicon.ico" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="/public/js/main.js?v1.7"></script>
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="/"><span><img src="/public/img/icons/camera.png" alt="logo" title="Camagru">Camagru</span></a>
            </div>
            <div class="gallery_link"><a href="/gallery" style="font-size: 20px;">ГАЛЕРЕЯ</a></div>
            <div class="userarea">
                <?php if (isset($_SESSION['login'])) {?>
                    <div class="menuitem dropdown"><i class="fas fa-user fa-1x"></i><span><?php echo $_SESSION['login'];?></span>
                        <div class="dropmenu">
                            <div class="menuitem"><a href="/account/profile">Профиль</a></div>
                            <div class="menuitem"><span onclick="logout_ajax()">Выход</span></div>
                        </div>
                    </div>
                <?php } else {?>
                    <p><a href="/account/login">Вход</a> / <a href="/account/register">Регистрация</a></p>
                <?php } ?>
            </div>
        </header>