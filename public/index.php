<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P101 - Cristóbal Sánchez Arisa</title>
    <link rel="stylesheet" href="estil.css" type="text/css">
</head>
<body>

    <div id="main">

        <header>
            <h1>P101 - Lectura de fitxer XML</h1>
            <cite>Cristóbal Sánchez Arisa</cite>
        </header>

        <div id="llistatautors">

            <h2>Autors</h1>
            <hr align="left" />

            <?php

                require "./lstxml.php";
                require "./navegaxml.php";

                listXml();

            ?>


        </div>
        <div id="llistanavegable">
        
            <h2>Informació dels llibres</h2>
            <hr align="left" />

            <?php

                mostrarPagina($pagina);

            ?>

            <div class="botonsnavegacio">
                <button id="btnprincipi" onClick="<?php 

                ?>"><<</button>
                <button id="btnanterior"><</button>
                <button id="btnseguent" onClick="<?php 
                    paginaSeguent();
                ?>">></button>
                <button id="btnfinal">>></button>
            </div>

        </div>

    </div>
</body>
</html>