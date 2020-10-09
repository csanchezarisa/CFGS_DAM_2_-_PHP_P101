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
                $_SESSION["pagina"] = 0;
                $fitxerXml->nodeXML($_SESSION["pagina"]);
            }
            elseif (isset($_POST['btnanterior'])) {
                $_SESSION["pagina"] = $fitxerXml->paginaAnterior($_SESSION["pagina"]);
                $fitxerXml->nodeXML($_SESSION["pagina"]);
            }
            elseif (isset($_POST['btnseguent'])) {
                $_SESSION["pagina"] = $fitxerXml->paginaSeguent($_SESSION["pagina"]);
                $fitxerXml->nodeXML($_SESSION["pagina"]);
            }
            elseif (isset($_POST['btnfinal'])) {
                $_SESSION["pagina"] = $fitxerXml->ultimaPagina();
                $fitxerXml->nodeXML($_SESSION["pagina"]);
            }
            else {
                $_SESSION["pagina"] = 0;
                $fitxerXml->nodeXML($_SESSION["pagina"]);
            }

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