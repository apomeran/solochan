<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta name="description" content="Sitio de clasificados online de pequeños trabajos - Argentina" />
        <meta name="keywords" content="trabajo trabajar changa changuita clasificados argentina laburo laburar trabajito gratis" />
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="alan.pome[at]gmail.com" />
        <title>SoloChanguitas</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.css" />
        <link type="text/css" rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/image-effects.css"/>
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone4.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad3.png" />
        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
            <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	

    </head>
    <script>
        function scroll(element, parent) {
            $(parent).animate({scrollTop: $(parent).scrollTop() + $(element).offset().top - $(parent).offset().top}, {duration: 'slow', easing: 'swing'});
            $('html,body').animate({scrollTop: $(parent).offset().top}, {duration: 1000, easing: 'swing'});
        }
    </script>
    <body class="body-bg fadein">
        <div id="header" class="tabulated-content">
            <div class="logo">
                <a href="#/inicio" rel="address:/" class="bw">
                    <img width=55% src="img/logo2.png" alt="SoloChanguitas" />
                </a>
            </div>
            <div class="como-f">
                <span id="userPanel">
                    <?php
                    if (!isset($_SESSION[SesionId]) || $_SESSION[SesionId] == 0)
                        include_once("panel-login.php");
                    else
                        include_once("panel-logged.php");
                    ?>
                </span>
            </div>
        </div>
        <div class="content">
            <div class="container-div">

