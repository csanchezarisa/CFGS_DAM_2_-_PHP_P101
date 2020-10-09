<?php

    include "header.php";
    
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

?>


<div id="llistanavegable">
        
        <h2>Informació dels llibres</h2>
        <hr align="left" />

        <?php

            /* S'executa quan es prem un dels botons de navegació del formulari inferior.
            Depenent quin botó es premi s'executarà un mètode o un altre */
            if (isset($_POST['btnprincipi'])) {
                $_SESSION["pagina"] = $fitxerXml->primerNode();
                $propietatsFitxerXml = $fitxerXml->getPropietatsNode();
            }
            elseif (isset($_POST['btnanterior'])) {
                $_SESSION["pagina"] = $fitxerXml->nodeAnterior($_SESSION["pagina"]);
                $propietatsFitxerXml = $fitxerXml->getPropietatsNode();
            }
            elseif (isset($_POST['btnseguent'])) {
                $_SESSION["pagina"] = $fitxerXml->nodeSeguent($_SESSION["pagina"]);
                $propietatsFitxerXml = $fitxerXml->getPropietatsNode();
            }
            elseif (isset($_POST['btnfinal'])) {
                $_SESSION["pagina"] = $fitxerXml->ultimNode();
                $propietatsFitxerXml = $fitxerXml->getPropietatsNode();
            }
            else {
                $_SESSION["pagina"] = $fitxerXml->primerNode();
                $propietatsFitxerXml = $fitxerXml->getPropietatsNode();
            }

            echo "<h3>" . ($_SESSION["pagina"] + 1) . " - " . $propietatsFitxerXml["title"] . "</h3>";

            echo "<ul>";
            foreach ($propietatsFitxerXml as $propietat => $valor) {
                if ($propietat != "#text")
                    echo "<li><strong>$propietat: </strong> $valor</li>";
            }
            echo "</ul>"

        ?>

        <!-- Formulari per navegar entre les pàgines del XML -->
        <div class="botonsnavegacio">
            <form id="navegaXML" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="submit" name="btnprincipi" value="<<" class="botonavegacio" />
                <input type="submit" name="btnanterior" value="<" class="botonavegacio" />
                <input type="submit" name="btnseguent" value=">" class="botonavegacio" />
                <input type="submit" name="btnfinal" value=">>" class="botonavegacio" />
            </form>
        </div>

    </div>

<?php

    include "formulariCanviarFitxer.php";

    include "footer.php";

?>