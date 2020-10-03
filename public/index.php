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

                session_start();

                require "./lstxml.php";
                require "./navegaxml.php";

                listXml();

            ?>


        </div>
        <div id="llistanavegable">
        
            <h2>Informació dels llibres</h2>
            <hr align="left" />

            <?php

                if (isset($_POST['btnprincipi'])) {
                    $_SESSION["pagina"] = 0;
                    mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnanterior'])) {
                    $_SESSION["pagina"] = paginaAnterior($_SESSION["pagina"]);
                    mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnseguent'])) {
                    $_SESSION["pagina"] = paginaSeguent($_SESSION["pagina"]);
                    mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnfinal'])) {
                    $_SESSION["pagina"] = ultimaPagina();
                    mostrarPagina($_SESSION["pagina"]);
                }
                else {
                    $_SESSION["pagina"] = 0;
                    mostrarPagina($_SESSION["pagina"]);
                }

            ?>

            <div class="botonsnavegacio">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="btnprincipi" value="<<" />
                    <input type="submit" name="btnanterior" value="<" />
                    <input type="submit" name="btnseguent" value=">" />
                    <input type="submit" name="btnfinal" value=">>" />
                </form>
            </div>

        </div>

    </div>
</body>
</html>