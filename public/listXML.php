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

    <div id="llistatautors">

        <h2>Títols</h2>
        <hr align="left" />

            <form id="listXML">
                <ul>

                <?php 

                    foreach ($fitxerXml->listXml() as $title) {
                        echo "<li>$title</li>";
                    }

                ?>

                </ul>
            </form>
        </div>

<?php

    include "formulariCanviarFitxer.php";

    include "footer.php";

?>