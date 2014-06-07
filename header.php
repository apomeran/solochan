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
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone4.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad3.png" />
        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
            <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	
            <!--[if lt IE 9]>
                    <script src="js/respond.min.js"></script>
                    <script src="js/html5shiv.js"></script>
            <![endif]-->
    </head>
    <script>

        function scroll(element, parent) {
            $(parent).animate({scrollTop: $(parent).scrollTop() + $(element).offset().top - $(parent).offset().top}, {duration: 'slow', easing: 'swing'});
            $('html,body').animate({scrollTop: $(parent).offset().top}, {duration: 1000, easing: 'swing'});
        }

    </script>
    <body class="body-bg fadein">

        <div id="header" >
            <div class="row">
                <div class="span6" style="margin-left:10%">
                    <div class="row">
                        <div class="span6">
                            <a href="#/inicio" rel="address:/" class="logo"><img width=30% src="img/logo1.png" alt="SoloChanguitas" /></a>

                            <div class="slogan givemefont">

                                <div class="social" style="">
                                    Trabajos por los que and&aacute;s preguntando

                                    <a href="http://www.facebook.com/solochanguitas" style="margin-left:3px;" target="_blank"><img width=6% src="img/social/fb.png" alt="facebook" /></a>
                                    <a href="https://twitter.com/solochanguitas" target="_blank"><img  width=6% src="img/social/tw.png" alt="twitter" /></a>
                                    <a href="#" target="_blank"><img width=6% src="img/social/g+.png" alt="google plus" /></a>
                                    <a href="#" target="_blank"><img width=6% src="img/social/li.png" alt="linkedin" /></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="span6" style="position: absolute; right: 5%; margin-top: -40px;">
                    <p class="como-f">
						<a class="menucontainer"  style="color: #000000; " href="#/changuitas" rel="address:/changuitas">
                            Ver todas las changuitas
                        </a>
						<?php
						if(!isset($_SESSION[SesionId]) || $_SESSION[SesionId] == 0)
							include("panel-login.php");
						else
							include("panel-logged.php");
						?>
							
						
                    </p>
                </div>
            </div>
        </div>
		<!--<script type="text/javascript">//<![CDATA[
		$(function(){
			$('#slider div:gt(0)').hide();
			setInterval(function(){
			  $('#slider div:first-child').fadeOut(0)
				 .next('div').fadeIn(1300)
				 .end().appendTo('#slider');}, 8000);
		});
		//]]></script>!-->
		<div id="slider" class="slider">
			<div class="slider-pic">
				<img src="img/slider/1.png"/>
			</div>
		</div>
        <div class="container-div" >
            
