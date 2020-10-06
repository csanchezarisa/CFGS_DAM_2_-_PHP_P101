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

                session_start(); // S'inicia una sessió per poder emmagatzemar-hi variables de sessió

                require "clxmlllibres.php"; // Es vincula el fitxer amb la classe i s'inicialitza l'objecte amb el fitxer XML
                $fitxerXml = new clmxllibres();

                /* Es comprova si hi ha inicialitzada alguna de les variables de sessió que fan referència
                a l'obertura d'un fitxer diferent al predeterminat (s'assigna en el segon formulari) 
                
                Si s'ha inicialitzat alguna de les variables referents a un directori o un fitxer diferent
                al predeterminal es criden els mètodes pertinents */
                if ((isset($_SESSION["directori"]) && isset($_SESSION["fitxer"]))) {

                    $fitxerXml->canviarDirectoriIFitxer($_SESSION["directori"], $_SESSION["fitxer"]);

                }
                elseif (isset($_SESSION["directori"])) {

                    $fitxerXml->canviarDirectori($_SESSION["directori"]);

                }
                elseif (isset($_SESSION["fitxer"])) {

                    $fitxerXml->canviarFitxer($_SESSION["fitxer"]);

                }

                $fitxerXml->listXml(); // Es mostra el llistat amb els autors que hi ha en el XMLs

            ?>


        </div>
        <div id="llistanavegable">
        
            <h2>Informació dels llibres</h2>
            <hr align="left" />

            <?php

                /* S'executa quan es prem un dels botons de navegació del formulari inferior.
                Depenent quin botó es premi s'executarà un mètode o un altre */
                if (isset($_POST['btnprincipi'])) {
                    $_SESSION["pagina"] = 0;
                    $fitxerXml->mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnanterior'])) {
                    $_SESSION["pagina"] = $fitxerXml->paginaAnterior($_SESSION["pagina"]);
                    $fitxerXml->mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnseguent'])) {
                    $_SESSION["pagina"] = $fitxerXml->paginaSeguent($_SESSION["pagina"]);
                    $fitxerXml->mostrarPagina($_SESSION["pagina"]);
                }
                elseif (isset($_POST['btnfinal'])) {
                    $_SESSION["pagina"] = $fitxerXml->ultimaPagina();
                    $fitxerXml->mostrarPagina($_SESSION["pagina"]);
                }
                else {
                    $_SESSION["pagina"] = 0;
                    $fitxerXml->mostrarPagina($_SESSION["pagina"]);
                }

            ?>

            <!-- Formulari per navegar entre les pàgines del XML -->
            <div class="botonsnavegacio">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="btnprincipi" value="<<" class="botonavegacio" />
                    <input type="submit" name="btnanterior" value="<" class="botonavegacio" />
                    <input type="submit" name="btnseguent" value=">" class="botonavegacio" />
                    <input type="submit" name="btnfinal" value=">>" class="botonavegacio" />
                </form>
            </div>

        </div>
        <div id="formularicanvifitxer">
        
        <?php 

            /* S'executa quan es prem el botó submit del formulari inferior.
            Depenent què s'ha definit es canvia una variable de sessió o un altre */
            if (isset($_POST["btncarregarfitxernou"])) {

                if (isset($_POST["txtnoudirectori"]) && isset($_POST["txtnoufitxer"])) {

                    $_SESSION["directori"] = $_POST["txtnoudirectori"];
                    $_SESSION["fitxer"] = $_POST["txtnoufitxer"];

                }
                elseif (isset($_POST["txtnoudirectori"])) {

                    $_SESSION["directori"] = $_POST["txtnoudirectori"];

                }
                elseif (isset($_POST["txtnoufitxer"])) {
                    
                    $_SESSION["fitxer"] = $_POST["txtnoufitxer"];

                }

            }

        ?>

            <h2>Obrir un altre fitxer</h2>
            <hr align="left" />

            <!-- Formulari per obrir un altre fitxer/directori -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="taulacanviarfitxer">
                    <tr>
                        <td colspan="2" style="text-align:left">
                            Necessites obrir un altre fitxer?<br />
                            Omple el formulari per obrir-ne un altre.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Directori nou: <input type="text" name="txtnoudirectori" placeholder="Introdueix el nou directori" />
                        </td>
                        <td>
                            Fitxer nou: <input type="text" name="txtnoufitxer" placeholder="Introdueix el nou fitxer" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">
                            <input type="submit" name="btncarregarfitxernou" value="Carregar fitxer nou" class="botocarregarfitxer" />
                        </td>
                    </tr>
                </table>
            </form>

        </div>

    </div>
</body>
</html>