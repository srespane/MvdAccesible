<!DOCTYPE html>
<!--[if IEMobile 7 ]> <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Accede Fácil</title>
    <meta name="description" content="Applicacion web dedicada a señalizar los puntos de reciclaje en Montevideo, Uruguay">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cleartype" content="on">
    
    <link rel="author" href="humans.txt">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#222222">

    <!-- For iOS web apps -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="AccedeFacil">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/modernizr-2.2.6.min.js"></script>
</head>
<body>
    <header class="header">
        <button id="pan-to-initial" class="icon icon-initial">
            <img src="img/btn-current-position.png" alt="Volver" width="16px" height="20px">
        </button>
        <h1>Accede Fácil</h1>
        <button id="toggle-page-info" class="icon icon-info">
            <i>i</i>
        </button>
    </header>
    <div id="map" class="map" role="main">
        <noscript>
            Necesitas tener JavaScript habilitado en tu navegador.
        </noscript>
    </div>
    <section id="info" class="page page-info">
                <article>
   
            <p>Mediante esta aplicación se podrá consultar la característica de aquellos lugares identificados como accesibles, desde el punto de vista de accesibilidad física, visual, auditiva o comunicacional, facilitando así el desplazamiento en la ciudad de aquellos ciudadanos con algún tipo de limitación.</p>
        </article>
        <article>
            <h4>Cómo utilizo la herramienta?</h4>
            <p>Utiliza los botones ubicados en la parte inferior para filtrar tu búsqueda. Por defecto tendrás todos los lugares accesibles de la capital, quita los filtros para reducir tu búsqueda.</p>
        </article>
        <article>
            <h4>¿Qué tipo de lugares puedo encontrar en el mapa?</h4>
            <p>Centros deportivos, Centros educativos, Centros comerciales, Teatros, Museos, Playas, Plazas y parques, entre otros.</p>
        </article>
                <article>
            <h4>¿De donde provienen los datos utilizados para el desarrollo de esta aplicación?</h4>
            <p>Para el desarrollo de esta aplicación se utilizan los datos abiertos que se disponen en el catálogo de datos publicado por el estado.</p>
        </article>
                <article>
            <h4>¿Cómo puedo contribuir con la aplicación?</h4>
            <p>Puedes enviar un lugar accesible que no esté en el mapa para que posteriormente pueda incorporarse.
Para reportar un nuevo lugar puedes acceder <a href="http://accesibilidad.montevideo.gub.uy/contacto" target="_blank">aquí</a> </p>
        </article>
        
        <article>
            <h4>
                Un proyecto de: 
                    <img class="logo-data" src="http://www.beta.montevideointeligente.uy/wp-content/uploads/2015/07/Logo_230_x_130-01.png" width="95px" height="53px">
            </h4>
            <p>Sitio web: <a target="_blank" href="http://www.montevideointeligente.uy" >www.montevideointeligente.uy</a></p>
            <p>
                Desarrollado por: <a href="mailto:santiago@montevideointeligente.uy">Santiago Respane</a> y <a href="mailto:maximiliano@montevideointeligente.uy">Maximiliano Alfonsín</a>
            </p>
            <p>
                Forked from: <a target="_blank" href="https://github.com/HiroAgustin/DondeReciclo">Donde Reciclo</a>
            </p>
            <p>
                Código disponible en <a target="_blank" href="https://github.com/srespane/mvdAccesible">Github</a>
            </p>
        </article>
        <article>
            <h4>Conocé también: <a target="_blank" href="http://donderetiro.uy">DondeRetiro</a> y <a target="_blank" href="http://dondereciclo.com.uy">DondeReciclo</a></h4>
        </article>
    </section>
    <footer class="footer">
        <ul id='controls' class="nav clearfix">
            <li>
                <button class="btn" data-type="ESPACIOS_DEPORTIVOS" data-is-active="true"></button>
            </li>
            <li>
                <button class="btn" data-type="MUSEO" data-is-active="true"></button>
            </li>
            <li >
                <button class="btn" data-type="CENTROS_COMERCIALES" data-is-active="true"></button>
            </li>
            <li>
                <button class="btn" data-type="PARQUES_Y_PLAZAS" data-is-active="true"></button>
            </li>
            <li>
                <button class="btn" data-type="TEATRO" data-is-active="true"></button>
            </li>
            <li>
                <button class="btn" data-type="PLAYA" data-is-active="true"></button>
            </li>
            <li>
                <button class="btn" data-type="CENTROS_EDUCATIVOS" data-is-active="true"></button>
            </li>            
            <li>
                <button class="btn" data-type="OTROS" data-is-active="true"></button>
            </li>
        </ul>
    </footer>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo_4srudJI1_8R7OLJn9LPtManJKBdbNo&sensor=true"></script>
    <script src="js/underscore-1.4.4.js"></script>
    <script src="js/donde.js"></script>
    <script src="js/helper.js"></script>
    <script>
        MBP.scaleFix();
        MBP.startupImage();

        var app = new Donde({
            zoom: 13, 
            markers: (<?php include 'accesibilidad_lugares.geojson' ?>).features, 
            errorMessage: 'No sabemos dónde estas :(', 
            defaultLocation: {
                latitude: -34.8937720817105, 
                longitude: -56.1659574508667
            }, 
            icons: {
                ESPACIOS_DEPORTIVOS: 'img/lugares_filtros-deportivos.png',
                MUSEO: 'img/lugares_filtros-museos.png',
                PLAYA: 'img/lugares_filtros-playas.png',
                PARQUES_Y_PLAZAS:'img/lugares_filtros-parques.png',
                TEATRO:'img/lugares_filtros-teatros.png',
                CENTROS_COMERCIALES:'img/lugares_filtros-comerciales.png',
                CENTROS_EDUCATIVOS:'img/lugares_filtros-deportivos.png',
                OTROS: 'img/lugares_filtros-otros.png',
            }, 
            mapping: {
                type: function (item) {
                    //return item.properties.TIPO_RESID;
                    return item.properties.TIPO;
                }, 
                latitude: function (item) {
                    return item.geometry.coordinates[1];
                }, 
                longitude: function (item) {
                    return item.geometry.coordinates[0];
                },
                titulo: function (item) {
                    return item.properties.TITULO;
                }
            },
            myLocationImgUrl:'img/btn-current-position.png'
        });

        app.init();
        app.listen(document.getElementById('controls'));
        
        document.getElementById('pan-to-initial').addEventListener('click', function (e) {
            app.panToInitialPosition();
        }, false);

        var infoPage = document.getElementById('info'), 
            className = '';

        document.getElementById('toggle-page-info').addEventListener('click', function (e) {
            className = infoPage.className
            infoPage.className = ~className.indexOf('page-active') ? className.replace('page-active', '') : className += ' page-active';
        }, false);

        // var _gaq=[['_setAccount','UA-39355299-1'],['_trackPageview']];
        // (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        // g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        // s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
</body>
</html>